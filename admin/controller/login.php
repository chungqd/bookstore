<?php 
	function validate_data($username,$password){
		$errors = array();
		$errors['user'] = (empty($username) OR strlen($username)<3)?'khong duoc trong hoac lon hon 3 ki tu':'';
		$errors['pass'] = (empty($password) OR strlen($password)<5)?'password ko dc de trong va lon hon 5 ki tu':'';
		return $errors;
	}

	if (isset($_POST['btnSubmit'])) {
		$username = isset($_POST['txtTenDangNhap'])?trim($_POST['txtTenDangNhap']):"";
		$username = strip_tags($username);
		$password = isset($_POST['txtMatKhau'])?trim($_POST['txtMatKhau']):"";
		$password = strip_tags($password);

		$checkData = validate_data($username,$password);
		$checkFlag = TRUE;
		foreach ($checkData as $key => $val) {
			if (!empty($val)) {
				$checkFlag = FALSE;
				break;
			}
		}
		if ($checkFlag) {
			$login = checkLogin_model($username,md5($password));
			if (!empty($login)) {
				$_SESSION['username'] = $login['username'];
				$_SESSION['email'] = $login['email'];
				$_SESSION['role_admin'] = $login['role_admin'];
				$_SESSION['status'] = $login['status'];
				header("Location: controller/home.php");
			}
			else{
				$mess = "Username hoac mat khau khong ton tai";
			}
		}
	}
?>