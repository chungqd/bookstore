<?php 
	session_start();
	setcookie("admin", "admin", time()+3600,"/","",0);
	require_once 'model/login_model.php';
	require_once 'controller/login.php';
	require_once 'view/index_view.php';
?>