<?php
	require_once 'session.php';
	include_once 'controller/User.Controller.php'; 
	require_once 'controller/StudentGroup.Controller.php';
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/User.class.php');

	$uc = new UserController();
	$userid = $user->getUserid();

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);

	$stds = $uc->getAllStudents($userid);
	$groupName = $_POST['group'];
	$teacherID = $stds[0]["teacher_id"];
	$groupHolder = $sgc->getGroups($teacherID);
	$groupID = $groupHolder[0]['group_id'];
	$sgc->updateGroupName($groupID, $groupName);
	// echo $groupID;
	// echo "<pre>";
	// print_r($groupID);
	// echo "</pre>";
	// echo $group . " " . $userid;
	// echo "<pre>";
	// print_r($stds);
	// echo "</pre>";
	// echo $teacherID;
	// foreach ($stds as $key) {
	// 	echo $key->user_ID;
	// }
	// echo $stds;

	// $update_account_result = $uc->updateUser($userid, $username, $password, $first_name, $last_name, $gender);

	// // echo "success";
	header("Location: modules.php");
?>