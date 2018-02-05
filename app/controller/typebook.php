<?php
require_once 'app/model/typebook_model.php';
$method= isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    getListTypeBook();
    break;
}

function getListTypeBook(){
  $idtypeBook = isset($_GET['id']) ? $_GET['id'] : 0;
  $dataTypeBook = get_list_book_by_type($idtypeBook);
  if(!empty($dataTypeBook)){
    require_once 'app/view/typebook/index_view.php';
  }else
  {
    require_once 'app/view/errors_view.php';
  }
}
?>