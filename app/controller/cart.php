<?php  
	require_once "app/model/home_model.php";
	$method = isset($_GET['m'])?trim($_GET['m']):'index';
	switch ($method) {
		case 'index':
			view_Cart();
			break;
		case 'add':
			add_Cart();
			break;
		case 'delete':
			delete_cart();
			break;
		case 'remove':
			removeAllCart();
			break;
		case 'edit':
			updateCart();
			break;
		case 'orders':
			ordersCustomer();
			break;

	}

	function view_Cart(){
		$mess = isset($_GET['mess'])?$_GET['mess']:'';
		$mess1 = (!empty($mess) && $mess == 'fail')?'Vui long chon sp':'';
		$mess2 = (!empty($mess) && $mess == 'err')?'Vui long dien thong tin mua hang':'';
		$mess3 = (!empty($mess) && $mess == 'not')?'Co loi xay ra':'';
		$mess4 = (!empty($mess) && $mess == 'ok')?'Cam on ban da mua hang! Chung toi se lien he voi ban trong thoi gian som nhat':'';
		require_once 'app/view/cart/index_view.php';
	}
// dat hang
	function ordersCustomer(){
		if (isset($_POST['bnSubmit'])) {
			if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
			{
				$fullname = isset($_POST['txtHoTen'])?$_POST['txtHoTen']:'';
				$fullname = strip_tags($fullname);
				$phone = isset($_POST['txtSoDienThoai'])?$_POST['txtSoDienThoai']:'';
				$phone = strip_tags($phone);
				$email = isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
				$email = strip_tags($email);
				$address = isset($_POST['txtDiaChi'])?$_POST['txtDiaChi']:'';
				$address = strip_tags($address);
				$note = isset($_POST['txtGhiChu'])?$_POST['txtGhiChu']:'';
				$note = strip_tags($note);

				$checkData = validate_data($fullname, $phone, $email, $address);
				$flag = TRUE;
				foreach ($checkData as $key => $value) {
					if (!empty($value)) {
						$flag = FALSE;
						break;
					}
				}

				if ($flag) {
					$chkAdd = FALSE;
					// FALSE: insert từng sách 1 vào table
					foreach ($_SESSION['cart'] as $k => $value) 
					{
						$money = ($value['qty']*$value['cost']);
						// insert vafo db ham nay dc viet trong home_model
						$chkAdd = insert_order_customer_model($value['idBook'], $fullname, $phone, $email, $address, $note, $value['qty'],$money);
					}
					if ($chkAdd) 
					{
						unset($_SESSION['cart']);
						header("Location: ?cn=cart&m=index&mess=ok");
					}
					else
					{
						header("Location:?cn=cart&m=index&mess=not");
					}
				}
				else{
					header("Location:?cn=cart&m=index&mess=err");
				}
			}
			else{
				header("Location:?cn=cart&m=index&mess=fail");
			}
		}
	}

	function validate_data($fullname, $phone, $email, $address){
		$errors = array();
		$errors['fullname'] = (empty($fullname))?'Err fullname':'';
		$checkPhone = '/^[0][9]\d{8}$|^[0][1]\d{9}$/';
		$check = (preg_match($checkPhone,$phone) == TRUE)?TRUE:FALSE;
		$errors['phone'] = ($check)?'':'Err Phone';
		$checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
		$errors['email'] = ($checkEmail = TRUE)?'':'Err email';
		$errors['add'] = (empty($address))?'Err Address':'';
		return $errors;
	}
// hàm cập nhật số lượng
	function updateCart(){
		if (isset($_POST['btnSubmit'])) {
			$qty = isset($_POST['txtSoLuong'])?$_POST['txtSoLuong'] : array();
			// print_r($qty); die();
			foreach ($qty as $key => $value) {
				if (isset($_SESSION['cart'][$key])) {
					$_SESSION['cart'][$key]['qty'] = $value;
				}
			}
			
			header("Location:?cn=cart&m=index");
		}
	}

// ham xoa hang trong gio hang
	function delete_cart(){
		$idCart = isset($_GET['id'])?trim($_GET['id']):'';
		$idCart = is_numeric($idCart)?$idCart:0;

		// check xem co ma sach do trong gio hang khong
		if (isset($_SESSION['cart'][$idCart])) {
			unset($_SESSION['cart'][$idCart]);
		}
		header("Location:?cn=cart&m=index");
	}

// ham xoa tat ca hang trong gio
	function removeAllCart(){
		if (isset($_SESSION['cart'])) 
		{
			unset($_SESSION['cart']);
		}
		header("Location: ?cn=cart&m=index");
	}

	function add_Cart(){
		$idBook = isset($_GET['id'])?trim($_GET['id']):0;
		$idBook = is_numeric($idBook)?$idBook:0;
		$infoBook = get_info_data_book_byId($idBook);
		// echo "<pre/>";
		// print_r($infoBook);
		// die();
		if (!empty($infoBook)) 
		{
			$qty = isset($_POST['txtSoLuong'])?$_POST['txtSoLuong']:1;
			$qty = is_numeric($qty)?$qty:1;

			// kiểm tra xem có giỏ hàng chưa
			if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
			{
				// ktra xem quyển sách đó có trong giỏ chưa 
				if (isset($_SESSION['cart'][$idBook]) && $_SESSION['cart'][$idBook]['idBook'] == $idBook) 
				{
					$_SESSION['cart'][$idBook]['qty'] += $qty;
				}
				else
				{
					$_SESSION['cart'][$idBook]['idBook'] = $infoBook['id'];
					$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
					$_SESSION['cart'][$idBook]['imageBook'] = $infoBook['HinhAnh'];
					$_SESSION['cart'][$idBook]['cost'] = ($infoBook['GiaMoi'] > 0)?$infoBook['GiaMoi']:$infoBook['GiaCu'];
					$_SESSION['cart'][$idBook]['qty'] = $qty;
				}
				// TODO: doan if trong nay co the gop de bo phan else
			}
			else
			{
				// case: add sp vao gio hang tu home or detal sp khi sp chua co trong gio hang
				$_SESSION['cart'][$idBook]['idBook']  = $infoBook['id'];
				$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
				$_SESSION['cart'][$idBook]['imageBook'] = $infoBook['HinhAnh'];
				$_SESSION['cart'][$idBook]['cost'] = ($infoBook['GiaMoi'] > 0)?$infoBook['GiaMoi']:$infoBook['GiaCu'];
				$_SESSION['cart'][$idBook]['qty'] = $qty;
			}
			// REPLACE: doan tren thay bang doan nay
			// if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$idBook]))
			// {
			// 	$_SESSION['cart'][$idBook]['idBook']  = $infoBook['id'];
			// 	$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
			// 	$_SESSION['cart'][$idBook]['imageBook'] = $infoBook['HinhAnh'];
			// 	$_SESSION['cart'][$idBook]['cost'] = ($infoBook['GiaMoi'] > 0)?$infoBook['GiaMoi']:$infoBook['GiaCu'];
			// 	$_SESSION['cart'][$idBook]['qty'] = $qty;
			// }
			// else {
			// 	$_SESSION['cart'][$idBook]['qty'] += $qty;
			// }
		}
		
		header("Location: ?cn=cart&m=index");

	}
?>