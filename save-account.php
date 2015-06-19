<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'controller/User.Controller.php';
	require_once 'controller/Security.Controller.php';
	include_once 'controller/Language.Controller.php';
	
	$userid		= $user->getUserid();
	if (isset($_GET['user_id'])) 
		$userid		= $_GET['user_id'];
		
	$type = null;
	if (isset($_GET['type'])) 
		$type		= $_GET['type'];
	
	$uname 		= $_POST['username'];
	$password 	= trim($_POST['password']);
	$fname		= $_POST['fname'];
	$lname		= $_POST['lname'];
	$gender		= strtoupper($_POST['gender']);
	$level		= null;

	$uc			= new UserController();
	$sc 		= new SecurityController();
	$lc 		= new LanguageController();

	if($_GET['ret'] = "lgs" && $user->getFirstLogin() == 1) {
		$userid = $user->getUserid();
		if (isset($_POST['level'])) {
			$level = $_POST['level'];
		}
		$uc->updateUser($userid, $uname, $fname, $lname, $gender, $level);
		if(!empty($password)){ $uc->updatePassword($userid, $password); }
		if (isset($_GET['ut'])) {
			if($_GET['ut'] == "2"){
				$uc->updateUserFL($userid);
				header("Location: student.php?ft=1");
			} else{
				$squestion	= $_POST['squestion'];
				$sanswer	= $_POST['sanswer'];
				
				$securityRecord = $sc->getSecurityRecord($userid);
				if(sizeof($securityRecord) == 1){
					$sc->updateSecurityQuestion($squestion, $sanswer, $userid);
				} else {
					$sc->setSecurityQuestion($squestion, $sanswer, $userid);
				}
				if(isset($_POST['dlang'])){	
					$dlang_id = $_POST['dlang'];
					$lc->deleteTeacherLanguage($userid);
					$langs = $lc->getLanguage($dlang_id);
					$lc->setDefaultLanguage($userid, $dlang_id);
					$lang = $langs->getLanguage_code();
					header("Location: phpgrid/student-information.php?lang=$lang");
				}
			}
		}
		$_SESSION['uname-demo'] = $uname;
	} else{
		$uc->updateUser($userid, $uname, $fname, $lname, $gender, $level);
		$squestion	= $_POST['squestion'];
		$sanswer	= $_POST['sanswer'];
		$securityRecord = $sc->getSecurityRecord($userid);
		if(sizeof($securityRecord) == 1){
			$sc->updateSecurityQuestion($squestion, $sanswer, $userid);
		} else {
			$sc->setSecurityQuestion($squestion, $sanswer, $userid);
		}
		if($type == 0) $_SESSION['uname-demo'] = $uname;
		header("Location: edit-account.php?user_id={$userid}&f=1");
	}
?>