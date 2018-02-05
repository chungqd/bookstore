<?php
	require_once "../model/publisher_model.php";
	$method = isset($_GET['m'])?$_GET['m']:'index';
	switch ($method) {
		case 'index':
			listAllPublisher();
			break;
		case 'add':
			addPublisher();
			break;
		case 'edit':
			editPublisher();
			break;
		case 'delete':
			deletePublisher();
			break;
		default:
			# code...
			break;
	}

	function listAllPublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		$page = isset($_GET['page'])?$_GET['page']:1;
		$keyword = isset($_GET['keyword'])?$_GET['keyword']:"";

		$dataPb = getAllDataPublisher($keyword);
		$link = createLink(BASE_URL,array("sk"=>"publisher", "m"=>"index","page"=>'{page}',"keyword"=>$keyword));
		$dataPaging = paging($link, count($dataPb),$page, ROW_LIMIT, $keyword);
		$dataPublisher = getDataPublisherByPage($dataPaging['start'],$dataPaging['limit'],$dataPaging['keyword']);

		
		require_once "../view/publisher/index_view.php";
	}

	function addPublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once "../view/publisher/addPublisher_view.php";
		if (isset($_POST['btnSubmit'])) 
		{
			$name = isset($_POST['txtName'])?$_POST['txtName']:'';
			$name = strip_tags($name);
			$phone = isset($_POST['txtPhone'])?$_POST['txtPhone']:'';
			$phone = strip_tags($phone);
			$address = isset($_POST['txtAddress'])?$_POST['txtAddress']:'';
			$address = strip_tags($address);
			$logo = "";
			$type = 1;
			if (isset($_FILES['txtFile'])) 
			{
				$logo = uploadFiles($_FILES,$type);
			}


			$check = validate_data($name, $phone, $address, $logo);
			$flag = TRUE;
			foreach ($check as $key => $value) 
			{
				if (!empty($value))
				{
					$flag = FALSE;
					break;
				}
			}

			if ($flag) 
			{
				$checkpub = checkPublisher($name); // check xem co trung ten nxb đã có trong db ko
				if ($checkpub) {
					$add = add_info_publisher_model($name, $phone, $address, $logo);
					if ($add) 
					{
						$msg->success('Thêm thành công');
						header("Location: home.php?sk=publisher&m=index");
					}else
					{
						$msg->error('Thêm thất bại');
					}
				}
				else
				{
					$msg->error('Trùng nhà xuất bản');
				}
			}
			else
			{
				$msg->error('Dữ liệu nhập sai');
			}
		}
		//require_once "../view/publisher/addPublisher_view.php";
	}


	function validate_data($name, $phone, $address, $logo){
		$errors = array();
		$errors['name'] = (empty($name) OR strlen($name)<3)?"Tên ko hợp lệ":""; // dùng mb_strlen để đếm tiếng việt
		$errors['phone'] = (empty($phone))?"Phone ko hợp lệ":"";
		$errors['address'] = (empty($address))?"Address ko hợp lệ":"";
		$errors['logo'] = (empty($logo))?"Logo ko đc trống":"";
		return $errors;
	}

	function editPublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		$idPb = isset($_GET['id'])?$_GET['id']:0;
		$dataInfo = getDataInfoPublisher($idPb);

		if (empty($dataInfo)) {
			require_once "../view/notfound_view.php";
		}
		else
		{
			
			require_once "../view/publisher/editPublisher_view.php";
			if (isset($_POST['btnSubmi'])) 
			{
				$checkPb = isset($_POST['hddNamPB'])?$_POST['hddNamPB']:'';
				$checkPb = strip_tags($checkPb);
				$name = isset($_POST['txtName'])?$_POST['txtName']:'';
				$name = strip_tags($name);
				$phone = isset($_POST['txtPhone'])?$_POST['txtPhone']:'';
				$phone = strip_tags($phone);
				$address = isset($_POST['txtAddress'])?$_POST['txtAddress']:'';
				$address = strip_tags($address);
				$hddLogo = isset($_POST['hddFile'])?$_POST['hddFile']:'';
				$hddLogo = strip_tags($hddLogo);
				$logo = "";
				$type = 1;
				if (isset($_FILES['txtFile'])) 
				{
					$logo = uploadFiles($_FILES,$type);
				}
				$logonxb = (empty($logo))?$hddLogo:$logo;

				$check = validate_data($name, $phone, $address, $logonxb);
				$flag = TRUE;
				foreach ($check as $key => $value) 
				{
					if (!empty($value))
					{
						$flag = FALSE;
						break;
					}
				}
				if ($flag) {
					$checkName = TRUE;
					if($name !== $checkPb){
						$checkName = checkPublisher($name);
					}
					//$checkpub = checkPublisher($name);
					
					if ($checkName) 
					{
						$edit = editDataInfoPublisher($idPb,$name,$phone,$address,$logonxb);
						if ($edit) {
							$msg->success('sửa thành công');
							//header("Location: home.php?sk=publisher&m=index");
							header("Location: ?sk=publisher");
						}
						else{
							$msg->error('Sửa thất bại');
          					header("Location: ?sk=publisher&m=edit&id={$idPb}");
						}	
					}
					else
					{
						$msg->error('Trùng nhà xuất bản');
						header("Location: ?sk=publisher&m=edit&id={$idPb}");
					}
				}
				else
				{
					$msg->error('Dữ liệu nhập sai');
      				header("Location: ?sk=publisher&m=edit&id={$idPb}");
				}
			}
		}
	}

	function deletePublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		$idPb = isset($_GET['id'])?$_GET['id']:0;
		$idPb = is_numeric($idPb)?$idPb:0;
		$dataInfo = getDataInfoPublisher($idPb);
		if (empty($dataInfo)) {
			require_once "../view/notfound_view.php";
		}
		else
		{
			$delete = deletePublisher_model($idPb);
			if ($delete) {
				$msg->success('Xóa thành công');
				header("Location: ?sk=publisher");
			}
			else{
				$msg->error('Xóa Thất bại');
				header("Location: ?sk=publisher");
			}
		}
	}

 ?>