<?php
	require_once 'session.php';
	include_once 'controller/StudentCt.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';
	
	$redirect 	= $_GET['in'];
	$sdtid		= $_GET['sdtid'];
	$ctc		= new CumulativeTestController();
	$sct 		= new StudentCtController();
	$sct_set	= $sct->getStudentCtByID($sdtid);
	
	$dt_set		= $ctc->getCumulativeTestByID($sct_set->getCTID());
	$questions	= explode(',', $dt_set->getQid());
	
	$sa_set		= $sct->getAnsweredQuestions($sdtid);

	$sanswers		= array();
	
	foreach($sa_set as $sa)
		array_push($sanswers, $sa['qid']);
	
	foreach($questions as $row):
		if(!in_array($row, $sanswers)):
			$sctavalues = array(
				"student_ct_id" 	=> $sdtid,
				"qid"				=> $row,
				"answer"			=> "None",
				"mark"				=> 0,
			);
			
			$sct->addStudentAnswer($sctavalues);
		endif;
	endforeach;
	
	$startdate	= $sct_set->getStartDate();
	$sct->finishCumulativeTest($sdtid, $startdate);
	if($redirect==1){
		header("location: ct-results.php?sctid=$sdtid");
	}
?>