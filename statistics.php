<?php 
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Exercise.Controller.php';
	require_once 'controller/Question.Controller.php';
	require_once 'controller/StudentAnswer.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
?>
<?php
	$userid = $user->getUserid();
	$mid 	= $_GET['mid'];
	$gid	= $_GET['gid'];
	$e 		= $_GET['e'];
	
	$sgc		= new StudentGroupController();
	$stg		= $sgc->getUsersInGroup($gid);
	
	$students = $uc->loadUserType(2, $userid);
	$smid = [];
	
	$smc = new StudentModuleController();
	
	foreach($students as $student):
		if(in_array($student['user_ID'], $stg)):
			$student_module = [];
			$student_module = $smc->loadStudentModuleByUser($student['user_ID'], $mid);
			if($student_module) array_push($smid, $student_module[0]['student_module_ID']);
		endif;
	endforeach;
/*
	echo '<pre>';
	print_r($smid);
	echo '</pre>';
	*/
	$ec = new ExerciseController();
	$exercise = $ec->getExercise($e);
	
	$qc = new QuestionController();
	$eq = $qc->loadQuestions($e);
	
	$sac = new StudentAnswerController();

	if($_SESSION["lang"] == 'en_US') $curlang = "english";
	else if($_SESSION["lang"] == "ar_EG") $curlang = "arabic";
	else if($_SESSION["lang"] == "es_ES") $curlang = "spanish";
	else if($_SESSION["lang"] == "zh_CN") $curlang = "chinese";	
?>
<div id="container">
<a class="link" href="all-students-results.php?gid=<?php echo $gid; ?>&mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>

<?php

if($language == "ar_EG") {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;
		var pfCustomCSS = 'printfriendly.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
} else {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;
		var pfCustomCSS = 'printfriendly2.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
}

?>

<script>
	// var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;
	// var pfCustomCSS = 'printfriendly.php'
	// var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
</script>

<h1><?php echo _("Exercise Statistics"); ?>
	<a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
</h1>

<h3 id="fh3"><?php echo _($exercise['title']); ?> <?php echo _("Screenshot"); ?></h3>
<?php echo _("The image below is an actual screenshot of the exercise in the review. It shows the question items and the correct answers."); ?><br/><br/>
<?php
	$arr = explode('/', $exercise['screenshot']);
	array_splice($arr, 5, 0, $curlang );
	$ex_screenshot = implode("/", $arr);
	
?>
<center><img id="xshot" src="<?php echo $ex_screenshot;?>" width="80%"></center>
<br/>
<?php foreach ($eq as $question) { ?>
<h3><?php echo _("Question") . " " . _($question['section']); ?> - <?php echo _($question['title']); ?></h3>
<?php echo _("Correct Answer"); ?>: <span class="green bold upper"><?php echo _($question['correct_answer']); ?> </span><br/>
<div style="padding-top: 11px;">
	<div id="<?php echo 'q1_'.$question['section'].$question['title']; ?>" class="pchart p1"></div>
	<div id="<?php echo 'q2_'.$question['section'].$question['title']; ?>" class="pchart p2"></div>
</div>
<div class="clear"></div>
<?php } ?>
</div>
<script>
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawPie);	  
	function drawPie(){
		var data, options,chart;
		<?php 
			foreach ($eq as $question):
			
				if($question['correct_answer']) $correct = _($question['correct_answer']);
				else $correct = "None";
				
				$values = [];
				
				foreach($smid as $sm):
					$answers = $sac->getQuestionAnswersByStudent($question['question_ID'], $sm);
					if (isset($answers[0]['answer'])) {
						array_push($values, _($answers[0]['answer']));
					}
				endforeach;
				
				$c = 0;
				$w = 0;
				
				foreach ($values as $v):
					if ($v == $correct) $c++;
					else $w++;
				endforeach;
				
				$arr = array(array('Tst','t'),array(_('Correct'), $c),array(_('Wrong'), $w));
				$cwpie = json_encode($arr);
		?>
			data = google.visualization.arrayToDataTable(<?php echo $cwpie; ?>);
			options = { is3D: true, colors: ['green', 'red'], title: '<?php echo _("Correct and Wrong Statistics"); ?>' }
			chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q1_'.$question['section'].$question['title']; ?>'));
			chart.draw(data, options);
		<?php 
				$uniques = array_count_values($values);
				$arr = array(array('',''));
				foreach ($uniques as $key => $value):
					$temparr = array("$key",$value);
					array_push($arr,$temparr);
				endforeach;
				$cwpie = json_encode($arr);
		?>
		data = google.visualization.arrayToDataTable(<?php echo $cwpie; ?>);
		options = { is3D: true, title: '<?php echo _("Student Answers Statistics"); ?>' }
		chart = new google.visualization.PieChart(document.getElementById('<?php echo 'q2_'.$question['section'].$question['title']; ?>'));
		chart.draw(data, options);	
		<?php endforeach; ?>
  }
</script>
      <!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="xshot" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>This page shows the information and statistics of a question or activity. This is the screenshot of the activity in the actual module.</p>
		</li>
		<li data-class="p1" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>This pie chart shows the percentage of the correct and wrong answers (for this item) of all the students who took the test.</p>
		</li>
		<li data-class="p2" 		data-text="Close" data-options="tipLocation:top;tipAnimation:fade">
			<p>This pie chart shows the percentage of the students who selected the same answer for this question (Example: Out of 5 students, 2 answered A and 3 answered B. Pie chart will show 40% for A and 60% or B)</p>
		</li>
    </ol>

    <script>
      function guide() {
	  	$('#joyRideTipContent').joyride({
	      autoStart : true,
	      postStepCallback : function (index, tip) {
	      if (index == 10) {
	        $(this).joyride('set_li', false, 1);
	      }
	    },
	    // modal:true,
	    // expose: true
	    });
	  }
    </script>
<?php require_once "footer.php"; ?>