<?php 
	require_once '../config/database.php';
	
	function get_all_data_author_model(){
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM tacgia";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function get_all_data_publisher_model(){
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM nhaxuatban";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function get_all_data_typebook_model(){
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM loaisach";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function add_book_model($name,$id_nxb,$id_tg,$img,$giasach,$id_loai,$soluong,$sotrang){
		$checkFlag = FALSE;
		$conn = connection();
		$status = 1;
		$create_time = date('Y-m-d H:i:s');
		$update_time = date('Y-m-d H:i:s');
		$sql = "INSERT INTO sach(TenSach, id_nxb, id_tg, status, HinhAnh, GiaCu, id_loai, SoLuong, SoTrang, create_time, update_time) VALUES (:TenSach, :id_nxb, :id_tg, :status, :HinhAnh, :GiaCu, :id_loai, :SoLuong, :SoTrang, :create_time, :update_time)";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":TenSach", $name, PDO::PARAM_STR);
			$stmt->bindPARAM(":id_nxb", $id_nxb, PDO::PARAM_INT);
			$stmt->bindPARAM(":id_tg", $id_tg, PDO::PARAM_INT);
			$stmt->bindPARAM(":status", $status, PDO::PARAM_INT);
			$stmt->bindPARAM(":HinhAnh", $img, PDO::PARAM_STR);
			$stmt->bindPARAM(":GiaCu", $giasach, PDO::PARAM_INT);
			$stmt->bindPARAM(":id_loai", $id_loai, PDO::PARAM_INT);
			$stmt->bindPARAM(":SoLuong", $soluong, PDO::PARAM_INT);
			$stmt->bindPARAM(":SoTrang", $sotrang, PDO::PARAM_INT);
			$stmt->bindPARAM(":create_time", $create_time, PDO::PARAM_STR);
			$stmt->bindPARAM(":update_time", $update_time, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$checkFlag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	function check_name_book_model($name){
		$checkFlag = TRUE;
		$conn  = connection();
		$sql = "SELECT s.TenSach FROM sach AS s WHERE s.TenSach = :TenSach";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":TenSach", $name, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$checkFlag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	// lấy sách ra // theo tu khóa tìm kiếm
	function get_all_data_book_model($keyword){
		$data = array();
		$conn = connection();
		$key = "%".$keyword."%";
		$sql = "SELECT a.id, a.status, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
		b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
		FROM sach AS a INNER JOIN nhaxuatban AS b ON a.id_nxb = b.id_nxb 
		INNER JOIN tacgia AS c ON a.id_tg = c.id_tg
		INNER JOIN loaisach AS d ON a.id_loai = d.id_loai
		WHERE a.TenSach LIKE :keyword OR c.TenTG LIKE :keyword OR b.TenNXB LIKE :keyword OR d.TenLoai LIKE :keyword
		ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":keyword",$key,PDO::PARAM_STR);
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

	function get_info_data_book_model($id){
		$data = array();
		$conn = connection();
		$sql = "SELECT a.id, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
		b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
		FROM sach AS a INNER JOIN nhaxuatban AS b ON a.id_nxb = b.id_nxb 
		INNER JOIN tacgia AS c ON a.id_tg = c.id_tg
		INNER JOIN loaisach AS d ON a.id_loai = d.id_loai WHERE a.id = :id ORDER BY a.create_time DESC LIMIT 1";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':id', $id, PDO::PARAM_INT);
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

	// Hàm edit
	function update_info_data_model($id,$nameBook, $author, $Publisher, $TypeBook, $GiaCu, $GiaMoi, $soluong, $sotrang, $Img){
		$checkFlag = FALSE;
		$conn = connection();
		$update_time = date("Y-m-d H:i:s");
		$sql = "UPDATE sach SET TenSach = :TenSach, id_nxb = :id_nxb, id_tg = :id_tg, id_loai =:id_loai, GiaCu = :GiaCu,
		GiaMoi = :GiaMoi, SoLuong =:SoLuong, SoTrang = :SoTrang, HinhAnh = :HinhAnh, update_time =:update_time WHERE id = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":id",$id,PDO::PARAM_INT);
			$stmt->bindPARAM(":TenSach",$nameBook,PDO::PARAM_STR);
			$stmt->bindPARAM(":id_nxb",$Publisher,PDO::PARAM_INT);
			$stmt->bindPARAM(":id_tg",$author,PDO::PARAM_INT);
			$stmt->bindPARAM(':id_loai',$TypeBook,PDO::PARAM_INT);
			$stmt->bindPARAM(':GiaCu',$GiaCu, PDO::PARAM_INT);
			$stmt->bindPARAM(':GiaMoi',$GiaMoi, PDO::PARAM_INT);
			$stmt->bindPARAM(':SoLuong',$soluong, PDO::PARAM_INT);
			$stmt->bindPARAM(':SoTrang',$sotrang, PDO::PARAM_INT);
			$stmt->bindPARAM(':HinhAnh',$Img, PDO::PARAM_STR);
			$stmt->bindPARAM(':update_time',$update_time, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$checkFlag  = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $checkFlag;
	}

	 // Phan Xóa
	function delete_book_model($id){
		$conn = connection();
		$flag = FALSE;
		$sql = "DELETE FROM sach WHERE id = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":id",$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconection($conn);
		return $flag;
	}

	// phan trang // theo từ khóa
	function getDataBookByPage_model($start, $limit, $keyword=""){
		$conn = connection();
		$data = array();
		$key = "%".$keyword."%";
		$sql = "SELECT a.id, a.status, a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
		b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
		FROM sach AS a INNER JOIN nhaxuatban AS b ON a.id_nxb = b.id_nxb 
		INNER JOIN tacgia AS c ON a.id_tg = c.id_tg
		INNER JOIN loaisach AS d ON a.id_loai = d.id_loai
		WHERE a.TenSach LIKE :keyword OR c.TenTG LIKE :keyword OR b.TenNXB LIKE :keyword OR d.TenLoai LIKE :keyword
		ORDER BY a.create_time DESC  LIMIT :start, :limmit";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":keyword",$key,PDO::PARAM_STR);
			$stmt->bindPARAM(":start",$start,PDO::PARAM_INT);
			$stmt->bindPARAM(":limmit",$limit,PDO::PARAM_INT);
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
?>