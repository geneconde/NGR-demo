<?php 
	require_once 'session.php';
	// require_once 'libraries/fpdf.php';
	// require_once 'php/pdfmc.class.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/ModuleMeta.Controller.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/MetaAnswer.Controller.php';
	require_once 'locale.php';
	include_once 'header.php';
?>
<!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
<?php
	$mid = $_GET['m'];
	$userid = $user->getUserid();
	$students = $uc->loadUserType(2, $userid);
	
	$mc = new ModuleController();
	$m = $mc->loadModule($mid);
	
	$mmc = new ModuleMetaController();
	$problem = $mmc->getModuleProblem($mid);
	$smc = new StudentModuleController();
	$mac = new MetaAnswerController();

	//variables -> labels/contents
	$review = _('REVIEW: ');
	$problem_label = _('PROBLEM: ');
	$student_answers = _('STUDENT ANSWERS');
	$get_module_name = _($m->getModule_name());
	$get_problem = _($problem['meta_desc']);
	// //end
?>
<!-- <img src="images/pdf_header.png"> -->
<div id="container">
<a class="link print-no" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
<h1><a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a></h1>
<br/>
<?php foreach ($eq as $question) { ?>
<h3>Question <?php echo _($question['section']); ?> - <?php echo _($question['title']); ?></h3>
<?php echo _("Correct Answer"); ?>: <span class="green bold upper"><?php echo _($question['correct_answer']); ?> </span><br/>
<div id="<?php echo 'q1_'.$question['section'].$question['title']; ?>" class="pchart"></div>
<div id="<?php echo 'q2_'.$question['section'].$question['title']; ?>" class="pchart"></div>
<div class="clear"></div>
<?php } ?>
</div>
<div id="container">
	<h2><?php echo ($review . ' ' . $get_module_name . '<br/><br/>'); ?></h2>
	<h2><?php echo ($problem_label . ' ' . $get_problem . '<br/><br/>'); ?></h2>
	<h2><?php echo ($student_answers . '<br/><br/>'); ?></h2>
	<?php
	foreach ($students as $student) {
		$ctr = 0;
		$studentmodules = $smc->loadAllStudentModule($student['user_ID'],$mid);
		echo ('<p>' . $student['first_name'] . ' ' .$student['last_name'].': ' . '</p>');
		if ($studentmodules) {
			$sm = $studentmodules[0];
			$lastscreen = $sm['last_screen'];
			if ($lastscreen == 0) {
				$answer = $mac->getProblemAnswer($sm['student_module_ID'],$problem['meta_ID']);
				echo ('<p>' . $answers . '</p>' . '<br/><br/>');
			}
		}
	}
	?><br>
	<h3 class="pf-footer"><?php echo _("CONFIDENTIAL"); ?></h3>
</div>
