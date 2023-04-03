<?php 
require_once 'app/config/database.php';
	function add_member_model($username,$password,$email,$name,$address,$phone,$authenkey){
		$flag = 0;
		$role = 0;
		$status = 0;
		$create_time = date('Y-m-d H:i:s');
		$update_time = date('Y-m-d H:i:s');
		try {
			$conn = connection();
			$sql = "INSERT INTO taikhoan(TenDangNhap, MatKhau,TenHienThi, DiaChi, SDT, Email, Quyen, Trang_thai, authen_key, create_time, update_time) VALUES(:TenDangNhap, :MatKhau, :TenHienThi, :DiaChi, :SDT, :Email, :Quyen, :Trang_thai, :authen_key, :create_time, :update_time)";
			$stmt = $conn->prepare($sql);
			if ($stmt) {
				$stmt->bindPARAM(":TenDangNhap",$username,PDO::PARAM_STR);
				$stmt->bindPARAM(":MatKhau",$password,PDO::PARAM_STR);
				$stmt->bindPARAM(":TenHienThi",$name,PDO::PARAM_STR);
				$stmt->bindPARAM(":DiaChi",$address,PDO::PARAM_STR);
				$stmt->bindPARAM(":SDT",$phone,PDO::PARAM_INT);
				$stmt->bindPARAM(":Email",$email,PDO::PARAM_STR);
				$stmt->bindPARAM(":Quyen",$role,PDO::PARAM_INT);
				$stmt->bindPARAM(":Trang_thai",$status,PDO::PARAM_INT);
				$stmt->bindPARAM(":authen_key",$authenkey,PDO::PARAM_STR);
				$stmt->bindPARAM(":create_time",$create_time,PDO::PARAM_STR);
				$stmt->bindPARAM(":update_time",$update_time,PDO::PARAM_STR);
				if ($stmt->execute()) {
					$flag = $conn->lastInsertId();
				}
				$stmt->closeCursor();
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		
		disconnection($conn);
		return $flag;
	}

	function get_info_user($id_decode){
		$conn = connection();
		$data = array();
		$sql = "SELECT * FROM taikhoan AS a WHERE a.id_tk = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":id",$id_decode,PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconnection($conn);
		return $data;
	}

	// kích hoạt tài khoản
	function active_account_member_model($id_decode){
		$flag = FALSE;
		$conn = connection();
		$status = 1;
		$sql = "UPDATE taikhoan SET Trang_thai = :status WHERE  id_tk = :id";
		$stmt= $conn->prepare($sql);
		if ($stmt) 
		{
			$stmt->bindPARAM(":status", $status, PDO::PARAM_INT);
			$stmt->bindPARAM(":id", $id_decode, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnection($conn);
		return $flag;
	}

	function check_exist_account_model($name)
	{
		$conn = connection();
		$flag = TRUE;
		$sql = "SELECT a.TenDangNhap FROM taikhoan AS a WHERE a.TenDangNhap = :TenDangNhap";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":TenDangNhap",$name, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$flag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnection($conn);
		return $flag;
	}


	function check_exist_email_model($email)
	{
		$conn = connection();
		$flag = TRUE;
		$sql = "SELECT a.Email FROM taikhoan AS a WHERE a.Email = :Email";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(":Email",$email, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$flag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnection($conn);
		return $flag;
	}
 ?>