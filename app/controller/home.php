<?php
require_once 'app/model/home_model.php';

$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
  case 'index':
    listAllBook();
    break;
  case 'detail':
  	detailBook();
  	break;
}
// code chỗ này đéo ổn get hết ra 1 lúc, trường hợp nhiểu data vỡ mồm
function listAllBook(){
	$page = isset($_GET['page'])?$_GET['page']:1;
  	$dataBook = get_list_all_book_model(); // xu ly doan nay bang cach viet ham count trong model
  
	$link = createLink(BASE_URL,array("cn"=>"home", "m"=>"index","page"=>'{page}'));
	$dataPaging = paging($link, count($dataBook),$page, ROW_LIMIT);
	$dataAllBook = getDataBookByPage($dataPaging['start'],$dataPaging['limit']);


  require_once 'app/view/home/index_view.php';
}



function detailBook(){
	$idString = isset($_GET['name'])?$_GET['name']:'';
	$arrString = explode("-",$idString);
	$id = end($arrString);
	$infodata = get_info_data_book_byId($id);
	if (!empty($infodata)) {
		$dataTypeBook = get_typebook($infodata['id_loai'],$infodata['id']);
		$updateView = update_viewer_model($id,$infodata['SoLuotXem']);
		require_once "app/view/home/detail_view.php";
	}
	else{
		require_once "app/view/errors_view.php";
	}
}
?>