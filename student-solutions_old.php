<?php 
	require_once 'session.php';
	include_once 'header.php';
	require_once 'libraries/fpdf.php';
	require_once 'php/pdfmc.class.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/ModuleMeta.Controller.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/MetaAnswer.Controller.php';
	require_once 'locale.php';
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

	//variables -> labels/contents
	$review = _('REVIEW: ');
	// $review = iconv('UTF-8', 'windows-1252', $review);
	$review = utf8_decode ($review);

	$problem_label = _('PROBLEM: ');
	$problem_label = utf8_decode ($problem_label);

	$student_answers = _('STUDENT ANSWERS');
	$student_answers = utf8_decode ($student_answers);

	$get_module_name = _($m->getModule_name());
	$get_module_name = utf8_decode ($get_module_name);

	$get_problem = _($problem['meta_desc']);
	$get_problem = utf8_decode ($get_problem);

	$pdf = new FPDF();
	$pdf->SetAutoPageBreak(true);
	$pdf->AddPage();
 	$pdf->SetFont('Arial','',12);

	// $pdf->AddFont('aealarabiya','','aealarabiya.php');
	// if($language == "ar_EG") {
	// 	$pdf->SetFont('aealarabiya','',12);
	// }

	$pdf->MultiCell(0,5,$review.$get_module_name);
	$pdf->Ln();
	$pdf->MultiCell(0,5,$problem_label.$get_problem);//
	$pdf->Ln();
	$pdf->MultiCell(0,5,$student_answers);
	$pdf->Ln();
	
	$smc = new StudentModuleController();
	$mac = new MetaAnswerController();
	
	foreach ($students as $student) {
		$ctr = 0;
		$studentmodules = $smc->loadAllStudentModule($student['user_ID'],$mid);
		
		// $pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,5,$student['first_name'] . ' ' .$student['last_name'].': ');
		if ($studentmodules) {
			$sm = $studentmodules[0];
			$lastscreen = $sm['last_screen'];
			if ($lastscreen == 0) {
				// $pdf->SetFont('Arial','',12);
				$answer = $mac->getProblemAnswer($sm['student_module_ID'],$problem['meta_ID']);
				$pdf->MultiCell(0,5,$answer);
				$pdf->Ln();
			}
		}
	}
	ob_end_clean();
	$pdf->Output(_($m->getModule_name()).'-Student Solutions.pdf','I');
?>