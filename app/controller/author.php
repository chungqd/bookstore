<?php
require_once 'app/model/author_model.php';
$method= isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    getListAuthorBook();
    break;
}

function getListAuthorBook(){
  $idAuthorBook = isset($_GET['id']) ? $_GET['id'] : 0;
  $dataAuthorBook = get_list_book_by_author($idAuthorBook);
  if(!empty($dataAuthorBook)){
    require_once 'app/view/author/index_view.php';
  }else
  {
    require_once 'app/view/errors_view.php';
  }
}
?>