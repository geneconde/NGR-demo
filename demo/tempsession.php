<?php
	session_start();
	
	if(!((isset($_SESSION['uname-demo'])) || (isset($_SESSION['admin'])))){
		header("Location: index.php");
	}
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/demo/controller/User.Controller.php'); 
	
	$user = null;
	
	$uc = new UserController();
	if(isset($_SESSION['uname-demo'])){
		$user = $uc->loadUser($_SESSION['uname-demo']);
	}
	
	$name = $user->getFirstname();
	$gender = strtolower($user->getGender());
?>
