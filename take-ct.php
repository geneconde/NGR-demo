<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/User.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentCt.Controller.php';
	
	$userid		= $user->getUserid();
	$ctid		= $_GET['ctid'];
	$ctc		= new CumulativeTestController();
	$scc		= new StudentCtController();
	
	$ctest		= $ctc->getCumulativeTestByID($ctid);
	$qid 		= explode(',', $ctest->getQid());
	$count 		= count($qid);
	$tl			= explode(':', $ctest->getTimelimit());
	$hour		= ltrim($tl[0], '0');
	$min		= ltrim($tl[1], '0');
	$timelimit 	= $hour * 60 + $min;
	
	$scc_set	= $scc->getStudentCt($userid, $ctid);
	
	if($scc_set):
		$sctid 		= $sdt_set->getSCTID();		
		$sa_set		= $scc->getCTAnsweredQuestions($sctid);

		$sanswers		= array();
		
		foreach($sa_set as $sa)
			array_push($sanswers, $sa['qid']);
			
		foreach($qid as $row):
			if(!in_array($row, $sanswers)):
				$index = array_search($row, $qid);
				break;
			endif;
		endforeach;
	endif;

?>
<style> #dbguide { display: none; } </style>
<div id="container">
<a class="link" href="student.php">&laquo <?php echo _("Go Back"); ?></a>
<h1><?php echo _("Cumulative Test"); ?></h1>
<p><?php echo _("This cumulative test consists of"); ?> <strong><?php echo $count; ?> <?php echo _("questions"); ?></strong> <?php echo _("from different modules. You have"); ?> <strong><?php echo $timelimit; ?> <?php echo _("minutes"); ?></strong> <?php echo _(" to answer all these questions. <strong>The timer</strong> will start as soon as you click the <strong>Start Test</strong> button below. Before clicking <strong>Finish</strong> at the end of the test and if you still have time, you can review all your answers by clicking the <strong>Back</strong> and <strong>Next</strong> buttons at the bottom of the page. Only the answers that are completed within the time limit will be recorded."); ?></p>
<br/><br/><br/><br/>
<div class="center">
	<a class="take-box" href="ct.php?ctid=<?php echo $ctid; if(isset($index)) { ?>&i=<?php echo $index; } ?>"><?php echo _("START TEST"); ?></a></div>
</div>	
<?php require_once "footer.php"; ?>