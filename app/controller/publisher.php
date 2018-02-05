<?php
require_once 'app/model/publisher_model.php';
$method= isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    getListPublisherBook();
    break;
}

function getListPublisherBook(){
  $idPublisherBook = isset($_GET['id']) ? $_GET['id'] : 0;
  $dataPublisherBook = get_list_book_by_publisher($idPublisherBook);
  if(!empty($dataPublisherBook)){
    require_once 'app/view/publisher/index_view.php';
  }else
  {
    require_once 'app/view/errors_view.php';
  }
}
?>