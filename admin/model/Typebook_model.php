<?php  
	require_once '../config/database.php';

	// ham lay tat ca loai sach ra theo tu khoa
	function getAllDataTypeBook($keyword="")
	{
		$conn = connection();
		$data = array();
		$key = "%".$keyword."%";
		$sql = "SELECT * FROM loaisach as a WHERE a.TenLoai LIKE :keyword";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":keyword", $key, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	// ham lay loai sach ra de phan trang
	function getDataTypeBookByPage($start, $limit, $keyword = '')
	{
		$conn = connection();
		$data = array();
		$key = "%".$keyword."%";
		$sql = "SELECT * FROM loaisach AS a WHERE a.TenLoai LIKE :keyword ORDER BY a.create_time DESC LIMIT :start, :limmit";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":start", $start, PDO::PARAM_INT);
			$stmt->bindParam(":limmit", $limit, PDO::PARAM_INT);
			$stmt->bindParam(":keyword", $key, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	function getDataInfoTypeBook($idTb)
	{
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM loaisach as ls WHERE ls.id_loai = :id_loai";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id_loai",$idTb, PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $data;
	}

	function deleteTypeBook_model($idTb)
	{
		$conn = connection();
		$flag = false;
		$sql = "DELETE FROM loaisach WHERE id_loai = :id_loai";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id_loai", $idTb, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = true;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	function checkTypeBook($name)
	{
		$conn = connection();
		$flag = true;
		$sql = "SELECT * FROM loaisach WHERE TenLoai = :TenLoai";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":TenLoai", $name, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$flag = false;
				}
			}
			$stmt->closeCursor();
		}
		disconection($sql);
		return $flag;
	}

	function addInfoTypeBook_model($name)
	{
		$conn = connection();
		$flag = false;
		$create_time = date("Y-m-d H:i:s");
		$update_time = "";
		$sql = "INSERT INTO loaisach(TenLoai, create_time, update_time) VALUES(:TenLoai, :create_time, :update_time)";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":TenLoai", $name, PDO::PARAM_STR);
			$stmt->bindParam(":create_time", $create_time, PDO::PARAM_STR);
			$stmt->bindParam(":update_time", $update_time, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = true;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	function editDataInfoTypeBook($idTb, $name)
	{
		$flag = false;
		$conn = connection();
		$update_time = date("Y-m-d H:i:s");
		$sql = "UPDATE loaisach SET TenLoai = :TenLoai, update_time = :update_time WHERE id_loai = :id_loai";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":TenLoai", $name, PDO::PARAM_STR);
			$stmt->bindParam(":update_time", $update_time, PDO::PARAM_STR);
			$stmt->bindParam(":id_loai", $idTb, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = true;
			}
			$stmt->closeCursor();
		}
		disconection($sql);
		return $flag;
	}
?>