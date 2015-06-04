<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	require_once 'header.php';
	require_once 'controller/StudentCt.Controller.php';
	$scc	= new StudentCtController();
	
	
	$sctid		= $_GET['sctid'];
	$ctid 		= $_GET['ctid'];
	$index		= $_GET['i'];
	$qid 		= $_GET['qid'];
	$choice 	= $_GET['c'];
	$mark 		= $_GET['m'];

	
	// $mark = $_GET['mark'];
	// $fin = $_GET['fin'];
	
	// $index		= $_GET['index'] - 1;
	// $qid	= $_GET['qid'];
	// $index	= $_GET['index'];
	// $fin	= $_GET['fin'];
	// $type	= $_POST['type'];
	// $ans	= $_POST['choice'];

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

	$sc		= $scc->getStudentCtByID($sctid);
	$startdate	= $sc->getStartDate();
	$scc->finishCumulativeTest($sctid, $startdate);

	// echo '</br>' . $sctid . '</br>' . $ctid . '</br>' . $index . '</br>' . $qid . '</br>' . $choice . '</br>' . $mark;
?>	
<div id="container">
	<div id="confirm-box">
		<div>
			<p><?php echo _('You are about to submit this test. You can still go back and check your answer. Do you really want to submit this test?'); ?></p>
			<a href="ct-results.php?sctid=<?php echo $sctid; ?>" class="button1">Submit</a>
			<!-- <a href="save-ct.php?sctid=<?php echo $sctid; ?>&qid=<?php echo $qid; ?>&index=<?php echo $index; ?>&fin=<?php echo $fin; ?>" class="button1">Submit</a> -->
			<?php $i = $index - 1; ?>
			<a href="ct.php?ctid=<?php echo $ctid ?>&i=<?php echo $i; ?>" class="button1">Back</a>
		</div>
	</div>
</div>

<?php require_once "footer.php"; ?>