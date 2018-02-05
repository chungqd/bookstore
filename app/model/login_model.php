<?php  
	require_once 'app/config/database.php';
	function check_login_user_model($user, $pass){
		$data = array();
		$conn = connection();
		$sql = "SELECT * FROM taikhoan AS tk WHERE tk.TenDangNhap =:TenDangNhap AND tk.MatKhau = :MatKhau LIMIT 1";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindPARAM(':TenDangNhap',$user,PDO::PARAM_STR);
			$stmt->bindPARAM(':MatKhau',$pass,PDO::PARAM_STR);
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
?>