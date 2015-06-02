<?php
	require_once 'controller/StudentCt.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
	
	$scc	= new StudentCtController();
	$dtq	= new DtQuestionController();
	
	$sctid	= $_GET['sctid'];
	$qid	= $_GET['qid'];
	$index	= $_GET['index'];
	$fin	= $_GET['fin'];
	$type	= $_POST['type'];
	$ans	= $_POST['choice'];
	$choice = '';
	
	echo $type;

	if($type == 'radio'):
		$choice	= $ans;
	elseif($type == 'checkbox'):
		foreach($ans as $ch):
			$choice .= $ch;
		endforeach;
	endif;
	
	echo "1";

	$qset	= $dtq->getTargetQuestion($qid);
	$answer	= $qset[0]['answer'];
	
	echo "2";

	$mark	= ($choice == $answer? 1 : 0);
	echo 'mark'.$mark;
	$sc		= $scc->getStudentCtByID($sctid);
	print_r($sc);
	$ctid	= $sc->getCTID();

	echo "3";

	$sa		= $scc->getCTStudentAnswerByQuestion($sctid, $qid);

	if($sa):
		$scc->updateAnswer($sctid, $qid, $choice, $mark);
	else:
		$values = array(
			"student_ct_id"	=> $sctid,
			"qid"			=> $qid,
			"answer"		=> $choice,
			"mark"			=> $mark
		);
		$scc->addStudentAnswer($values);
	endif;
	
	$index++;
	
	if($fin):
		$startdate	= $sc->getStartDate();
		$scc->finishCumulativeTest($sctid, $startdate);
		// header("Location: ct-results.php?sctid={$sctid}");
		header("Location: confirm-ct.php?sctid={$sctid}&ctid={$ctid}&i={$index}");
	else: 
		header("Location: ct.php?ctid={$ctid}&i={$index}");
	endif;
?>