<?php
session_start();
require_once "../config/constant.php";
require_once "../helper/helper.php";
checkLogin_admin();
require_once "../libs/thirdparty/FlashMessages.php";
$cn = isset($_GET['sk']) ? $_GET['sk'] : 'index'; // neu ko chon thi mac dinh là home_view.php

// kiem tra neu ko phai requset ajax thi load header va sidebar
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    require_once '../view/partials/header_view.php';
    require_once '../view/partials/aside_view.php';
}


switch ($cn) {
    case 'book':
        require_once 'book.php';
        break;
    case 'index':
        require_once '../view/home_view.php';
        break;
    case 'publisher':
        require_once 'publisher.php';
        break;
    case 'orders':
        require_once 'orders.php';
        break;
    case 'typebook':
        require_once 'Typebook.php';
        break;
    case 'author':
        require_once 'Author.php';
        break;
    case 'member':
        require_once 'Member.php';
        break;
    case 'detail_order':
        require_once 'DetailOrder.php';
        break;
    default:
        require_once '../view/home_view.php';
        break;
}
//require_once '../view/home_view.php';

// kiem tra xem la request ajax thi ko load footer
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    require_once '../view/partials/footer_view.php';
}
?>