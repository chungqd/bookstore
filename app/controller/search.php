<?php
require_once 'app/model/search_model.php';
require_once 'app/model/home_model.php';
$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
  case 'index':
    listDataSearch();
    break;
}

function listDataSearch(){
  $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
  $page = isset($_GET['page'])?$_GET['page']:1;
  $data = get_databook_by_keyword($keyword);
  $link = createLink(BASE_URL, array("cn"=>"search","m"=>"index", "page"=>"{page}", "keyword"=>$keyword));
  $dataPaging = paging($link, count($data),$page, ROW_LIMIT, $keyword);
  $dataAllBook = getDataBookByPage($dataPaging['start'],$dataPaging['limit'],$dataPaging['keyword']);
  require_once 'app/view/search/index_view.php';
}
?>