<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentCt.Controller.php';
	
?>
	<style>
	<?php if($language == "ar_EG") {  ?>
		iframe table { direction: rtl; }
	<?php } ?>
	</style>

<?php
	$userid 	= $user->getUserid();
	$ctid 		= $_GET['ctid'];
	$qid		= $_GET['qid'];
	
	$students 	= $uc->loadUserType(2, $userid);
	
	$dtq		= new DtQuestionController();
	$question	= $dtq->getTargetQuestion($qid);
	$answer		= $question[0]['answer'];
	$choices	= $dtq->getQuestionChoices($qid);
	
	$correct 	= 0;
	$wrong 		= 0;
	
	$scc		= new StudentCtController();
	$answers	= array();
	
	foreach($choices as $choice):
		$answers[$choice['order']] = 0;
	endforeach;
	
	$arr = array(
			array('','')
		);
	
	foreach($students as $student):
		$sid	= $student['user_ID'];
		$st		= $scc->getStudentCt($sid, $ctid);

		if($st):
			$sanswer = $scc->getCTStudentAnswerByQuestion($st->getSCTID(), $qid);
			$sa 	 = $sanswer[0]['answer'];
			$found = false;
			
			foreach($answers as $key => $value):
				if($sanswer[0]['answer'] == $key):
					$answers[$key]++;
					$found = true;
					break;
				endif;
			endforeach;
			
			if(!$found):
				$answers[$sa] = 1;
				$sta = array($sa, $answers[$sa]);
				array_push($arr, $sta);
			endif;
			
			if($answer == $sanswer[0]['answer']) $correct++;
			else $wrong++;
		endif;
	endforeach;
?>
<style> #dbguide { display: none; } </style>
<div id="container">
<a class="link" href="all-students-ct-results.php?ctid=<?=$ctid?>">&laquo; <?php echo _("Go Back to Students Cumulative Results"); ?></a>
<?php

if($language == "ar_EG") {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 1;
		var pfCustomCSS = 'printfriendly.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
} else {
	echo "
	<script>
		var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 1;
		var pfCustomCSS = 'printfriendly2.php'
		var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
	</script>";
}

?>
<h1><?php echo _("Question Item Statistics"); ?>
	<a href="http://www.printfriendly.com" style="float: right; color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
	<img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
</h1>
<h3 id="fh3"><?php echo _("Question Item Information"); ?></h3>
<br/>
<table border="0" class="result morepad">
	<tr>
		<td class="bold"><?php echo _("Test Title"); ?>:</td>
		<td>
			<?php echo _("Cumulative Test"); ?>
		</td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Question"); ?></td>
		<td>
			<?php echo _($question[0]['question']); ?>
		</td>
	</tr>
	<tr>
		<td class="bold vtop"><?php echo _("Choices"); ?></td>
		<td>
			<?php
				foreach($choices as $choice):
					echo $choice['order'].". "._($choice['choice'])."<br/>";
				endforeach;
			?>
		</td>
	</tr>
	<tr>
		<td class="bold"><?php echo _("Answer"); ?></td>
		<td><?php echo $answer; ?></td>
	</tr>
</table>

<div class="sas">
<h3><?php echo _("Student Answer Statistics"); ?></h3>
<br/>
<p><?php echo _("The pie chart below shows the students' answers to the question and the percentage for each selected letter choice."); ?></p>
</div>

<div id="piechart1" style="width: 100%; height: 350px;"></div>
<br>
<div id="piechart2" style="width: 100%; height: 350px;"></div>
<br/>
</div>
<?php	   
foreach($choices as $choice):
	$ch = array($choice['order'].". "._($choice['choice']), $answers[$choice['order']]);
	array_push($arr, $ch);
endforeach;

$piedata1 = json_encode($arr);
$piedata1 = str_replace("&deg;","°",$piedata1);

$arr	= 	array(
				array('',''),
				array(_('Correct'), $correct),
				array(_('Wrong'), $wrong)
			);
		
$piedata2 = json_encode($arr);
?>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data1 = google.visualization.arrayToDataTable(<?php echo $piedata1; ?>);
		var data2 = google.visualization.arrayToDataTable(<?php echo $piedata2; ?>);
        var options1 = { is3D: true };
		var options2 = { is3D: true, colors: ['green', 'firebrick'] }
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
		var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
		
        chart1.draw(data1, options1);
		chart2.draw(data2, options2);
      }
</script>
<?php require_once "footer.php"; ?>