<?php  
	require_once 'app/model/login_model.php';
	$method = isset($_GET['m'])?trim($_GET['m']):'index';
	switch ($method) {
		case 'index':
			loginView();
			break;
		
		case 'dangnhap':
			login_account();
			break;
	}

	function loginView(){
		// if (isset($_SESSION['err1']) && !empty($_SESSION['err1'])) {
		// 	unset($_SESSION['err1']);
		// }
		// if (isset($_SESSION['err']) && !empty($_SESSION['err'])) {
		// 	unset($_SESSION['err']);
		// }
		require_once 'app/view/login/index_view.php';
	}

	function validate_login($user, $pass){
		$errors = array();
		$errors['username'] = (empty($user))?"Nhập tài khoản":"";
		$errors['password'] = (empty($pass) OR strlen($pass)<8)?"Nhập mật khẩu hoặc mk phải lớn hơn 8 kí tự":"";
		return $errors;
	}

	function login_account(){
		if (isset($_POST['btnSubmit'])) {
			$username = isset($_POST['txtTenDangNhap'])?trim($_POST['txtTenDangNhap']):'';
			$username = strip_tags($username);
			$password = isset($_POST['txtMatKhau'])?trim($_POST['txtMatKhau']):'';
			$password = strip_tags($password);

			$flag = TRUE;
			$check = validate_login($username, $password);
			foreach ($check as $key => $value) {
				if (!empty($value)) {
					$flag = FALSE;
					break;
				}
			}
			if ($flag) 
			{
				if(isset($_SESSION['err']))
				{
					unset($_SESSION['err']);
				}
				$ckLogin = check_login_user_model($username, md5($password));
				if (!empty($ckLogin)) {
					$_SESSION['username'] = $ckLogin['TenDangNhap'];
					$_SESSION['email'] = $ckLogin['Email'];
					$_SESSION['phone'] = $ckLogin['SDT'];
					$_SESSION['address'] = $ckLogin['DiaChi'];
					$_SESSION['fullname'] = $ckLogin['TenHienThi'];
					unset($_SESSION['err1']);
					header("Location: ?cn=index");
				}
				else{
					$_SESSION['err1'] = "Sai tên đăng nhập hoặc mật khẩu";
					header("Location: ?cn=login&m=index");
				}
			}
			else{
				unset($_SESSION['err1']);
				$_SESSION['err'] = $check;
				header("Location: ?cn=login&m=index");
			}
		}
	}
?>