<?php
	require_once 'session.php';
	include_once 'controller/User.Controller.php'; 
	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/includes/User.class.php');

	$uc = new UserController();

	$userid = $user->getUserid();
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$first_name = $_POST['FirstName'];
	$last_name = $_POST['LastName'];
	$gender = $_POST['gender'];

	// echo "data to be inserted = " . $userid . "; " . $username . "; " . $password . "; " . $first_name . " " . $last_name . "; " . $gender;

	$update_account_result = $uc->updateUser($userid, $username, $password, $first_name, $last_name, $gender);

	// echo "success";
	if($_GET['ut'] == "2"){
		$uc->updateUserFL($userid);
		header("Location: student.php?ft=1");
	} else {
		header("Location: phpgrid/student-information.php");
	}
?>