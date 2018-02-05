<?php 
require_once "app/model/signup_model.php";
$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
  case 'index':
    signupView();
    break;
case 'register':
	registerUser();
	break;
case 'active':
	active_member();
	break;

}

	function signupView(){
		if(isset($_SESSION['errors'])){
			unset($_SESSION['errors']);
		}
		$mess = isset($_GET['mess'])?$_GET['mess']:"";
		$dialog = ($mess == 'success')?"Đk thành công vào email active":($mess == "fail"?"Đk ko thành công":'');
		require_once 'app/view/signup/index_view.php';
	}

	function validate_data($username,$password,$email,$name,$address,$phone){
		$errors = array();
		$errors['username'] = (empty($username))?"lỗi tk":'';
		$errors['password'] = (empty($password) OR strlen($password)<8)?"lỗi mk":'';
		$checkMail = filter_var($email,FILTER_VALIDATE_EMAIL);
		$errors['email'] = ($checkMail == TRUE)?"":'lỗi email';
		$errors['name'] = (empty($name))?"lỗi họ tên":'';
		$errors['add'] = (empty($address))?"lỗi họ dịa chi":'';
		$checkPhone = preg_match('/^[0][9]\d{8}$|^[0][1]\d{9}$/',$phone);
		$errors['phone'] = ($checkPhone == TRUE)?'':"Lỗi sđt";
		$errors['existemail'] = (check_exist_email($email)==TRUE)?'':"Email này đã được đăng kí";
		$errors['existaccount'] = (check_exist_account($username)==TRUE)?'':"Tên tài khoản đã có vui lòng đặt tên tk khác!";
		return $errors;
	}

	function registerUser(){
		if (isset($_POST['btnSubmit'])) {
			$username = isset($_POST['txtTenDangNhap'])?$_POST['txtTenDangNhap']:'';
			$username = strip_tags($username);

			$password = isset($_POST['txtMatKhau'])?$_POST['txtMatKhau']:'';
			$password = strip_tags($password);

			$email = isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
			$email = strip_tags($email);

			$name = isset($_POST['txtHoTen'])?$_POST['txtHoTen']:'';
			$name = strip_tags($name);

			$address = isset($_POST['txtAddress'])?$_POST['txtAddress']:'';
			$address = strip_tags($address);

			$phone = isset($_POST['txtPhone'])?$_POST['txtPhone']:'';
			$phone = strip_tags($phone);

			$checkData = validate_data($username,$password,$email,$name,$address,$phone);
			$checkFlag = TRUE;
			foreach ($checkData as $key => $value) {
				if (!empty($value)) {
					$checkFlag = FALSE;
					break;
				}
			}
			if ($checkFlag) {
				if(isset($_SESSION['errors'])){
        			unset($_SESSION['errors']);
      			}
      			// $checkExistEmail = check_exist_email($email);
      			// $checkExistAccount = check_exist_account($username);
      			// if ($checkExistAccount == FALSE) {
      			// 	$mess1 = "Trùng tài khoản";
      			// }
      			// if ($checkExistEmail == FALSE) {
      			// 	$mess2 = "Trùng email";
      			// }else{

				$authenkey = encode(date('Y-m-d H:i:s', strtotime("+3days")));
				$add = add_member_model($username,md5($password),$email,$name,$address,$phone,$authenkey);
				if ($add>0) {
					$id = encode($add);
					$subject = "Active your acc";
					$link = "localhost:8080/booksto/?cn=signup&m=active&id={$id}&au=$authenkey";
					// $link = "http://cucai.tk/?cn=signup&m=active&id={$id}&au=$authenkey";
					$send = xl_sendmail($email,$subject,$link);
					if ($send) {
						header("Location:?cn=signup&m=index&mess=success");
					}
					else{
						header("Location:?cn=signup&m=index&mess=fail");
					}
				}
				else
				{
					header("Location:?cn=signup&m=index&mess=fail");
				}

			//}

			}
			else{
				$_SESSION['errors'] = $checkData;
				// header("Location:?cn=signup&m=index");
				require_once 'app/view/signup/index_view.php';
			}
		}
		//require_once 'app/view/signup/index_view.php';
	}

	function active_member(){
		$idMember = isset($_GET['id'])?$_GET['id']:'';
		$mess = "";
		$authenkey = isset($_GET['au'])?$_GET['au']:'';

		$id_decode = decode($idMember);
		$id_decode = is_numeric($id_decode)?$id_decode:0;
		$check = get_info_user($id_decode);
		if (!empty($check)) {
			if ($authenkey == $check['authen_key']) {
				$today = date("Y-m-d H:i:s");
				$au = decode($authenkey);
				if (strtotime($today)>strtotime($au)) {
					$mess="Mã đã hết hạn";
				}
				else
				{
					if ($check['Trang_thai']!=1) 
					{
						$activeUser = active_account_member_model($id_decode);
						if ($activeUser) 
						{
							$mess = "Kích hoạt TK thành công!";
						}
						else
						{
							$mess = "Kích hoạt ko TK thành công!";
						}
					}
					else
					{
						$mess = "TK đã được kích hoạt!";
					}
				}
			}
			else{
				$mess = "Mã kích hoạt ko hợp lệ";
			}
		}
		else {
			$mess = "Mã kích hoạt ko hợp lệ";
		}
		require_once "app/view/signup/active_view.php";
	}

	// Ham check xem da ton tai ten tk chua
	function check_exist_account($name)
	{
		$checkExistAccount = check_exist_account_model($name);
		return $checkExistAccount;
	}

	// ham check email ton tai chua

	function check_exist_email($email)
	{
		$checkExistEmail = check_exist_email_model($email);
		return $checkExistEmail;
	}
?>
