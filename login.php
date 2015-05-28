<?php
	session_start();

	ini_set('display_errors', '1');

	include_once 'controller/User.Controller.php'; 
	include_once 'controller/Language.Controller.php';
	require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/demo/includes/User.class.php');

	$lc = new LanguageController();
	$uc = new UserController();

	if (isset($_POST['username'])) {

		$password = $_POST['password'];

		// $salt = sha1(md5($password));

		// $password = md5($password.$salt);

		$retObj = $uc->loginUser($_POST['username'],$password);
		if ((is_object($retObj)) && ($retObj instanceof User)) {	

			if($retObj->getType() == '0' || $retObj->getType() == '4') {

				$_SESSION['uname-demo'] = $_POST['username'];

				//added for language
					$teacher = $uc->loadUser($_SESSION['uname-demo']);
					
					$gdl = $lc->getDefaultLanguage($teacher->getUserid(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}
					
					// print_r ($retObj);
					if($teacher->getFirstLogin() == 1){
						header("Location: account-update.php?ut=0");
					} else {
						header("Location: teacher.php?lang=$lang"); exit;	
					}

			} elseif($retObj->getType() == '1'){

				$_SESSION['uname-demo'] = $_POST['username'];	  

				header("Location:parent/parent.php");exit;

			} elseif($retObj->getType() == '2') {

				$_SESSION['uname-demo'] = $_POST['username'];

					//added for language
					$student = $uc->loadUser($_SESSION['uname-demo']);
								
					$gdl = $lc->getDefaultLanguage($student->getTeacher(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}

					if($student->getFirstLogin() == 1){
						header("Location: account-update.php?ut=2");
					} else {
						header("Location: student.php?lang=$lang"); exit;	
					}

			} elseif($retObj->getType() == '3') {
				header("Location: index.php?error=Expired%20Account");exit;
			}	
		} 

		else{

			header("Location: index.php?err=$retObj");exit;
		}
	}
?>