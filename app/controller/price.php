<?php
require_once 'app/model/price_model.php';
$method= isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
  case 'index':
    getListPriceBook();
    break;
}

function getListPriceBook(){
  $idPriceBook = isset($_GET['id']) ? $_GET['id'] : 0;
  $idPriceBook = (is_numeric($idPriceBook) && in_array($idPriceBook,array('1','2','3'))) ? $idPriceBook : 0;
  $dataPriceBook = !empty($idPriceBook) ? get_list_book_by_price($idPriceBook) : 0;
  if(!empty($dataPriceBook)){
    require_once 'app/view/price/index_view.php';
  }else
  {
    require_once 'app/view/errors_view.php';
  }
}