<?php
	session_start();
	
	if(!((isset($_SESSION['uname-demo'])) || (isset($_SESSION['admin'])))){
		header("Location: index.php");
	}
	
	include_once('controller/User.Controller.php');
	include_once('controller/StudentModule.Controller.php');
	include_once('controller/StudentAnswer.Controller.php');	
	include_once('controller/ModuleMeta.Controller.php'); 
	include_once('controller/MetaAnswer.Controller.php');
	include_once('controller/Module.Controller.php');
	include_once('controller/StudentCt.Controller.php');
	
	$user = null;
	
	$uc = new UserController();
	if(isset($_SESSION['uname-demo'])){
		$user = $uc->loadUser($_SESSION['uname-demo']);
	}
	
	$name = $user->getFirstname();
	
	$smc = new StudentModuleController();
	$sac = new StudentAnswerController();
	$mmc = new ModuleMetaController();
	$mac = new MetaAnswerController();
	$mc = new ModuleController();
	$scc = new StudentCtController();

	/*
	if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
		// last request was more than 30 minutes ago
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
		header("Location: index.php");
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	
	if (!isset($_SESSION['CREATED'])) {
		$_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 1800) {
		// session started more than 30 minutes ago
		session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
		$_SESSION['CREATED'] = time();  // update creation time
	}
	*/
?>