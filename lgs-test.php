<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestion.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	
	$userid = $user->getUserid();
	$action = $_GET['action'];
	
	if($action == "new"):
		$mid 	= $_GET['module_id'];
		$mode 	= ($_GET['mode'] == 'pre' ? 1 : 2 );
		
	elseif($action == "edit"):
		$dtid		= $_GET['dtid'];
		$dtc 		= new DiagnosticTestController();
		$dt_set		= $dtc->getDiagnosticTestByID($dtid);
		$questions 	= $dt_set->getQid();
		$qid		= explode(',', $questions);
		$mid		= $dt_set->getModuleid();
		$mode		= $dt_set->getMode();
		$testname	= $dt_set->getTestName();
	endif;
	
	$dtq 			= new DtQuestionController();
	$question_set 	= $dtq->getDTPool($mid);
	$letters 		= range('a','z');
	
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
?>
<div id="container">
<a class="link" href="modules.php">&laquo <?php echo _("Go Back"); ?></a>

<?php if ($mode == 1): ?>
<h1><?php echo $display = ($action == "edit"? "Edit" : _("Create")); ?> <?php echo _("Pre-Diagnostic Test"); ?></h1>
<?php echo _("A pre-diagnostic test will be taken by the students before they work on any of the modules available to them. This test should be completed within the specified time limit. Only the answers that are completed within the time limit will be recorded."); ?>
<?php else: ?>
<h1><?php echo $display = ($action == "edit"? "Edit" : "Create"); ?> <?php echo _("Post-Diagnostic Test"); ?></h1>
<?php echo _("A post-diagnostic test will be taken by the student after they finished all available reviews. This test should be finished within a time limit. If the student exceeds the time limit, whatever he finishes will be recorded."); ?>
<?php endif; ?>
<br><br>
<span class="bold"><?php echo _('Test name:'); ?>  </span><input type="text" id="test-name" value="<?php if(isset($testname)) echo $testname; ?>">
<table border="0" class="result morepad">
	<tr>
		<td colspan="2">
			<span class="bold"><?php echo _("Choose Questions"); ?></span><br/>
			<?php echo _("This is the pool of questions you can choose from."); ?><br/>
			<span class="rvw"><?php echo "(*) - "._("questions with asterisk are from the review itself"); ?></span>
		</td>
	</tr>
	<tr>
		<td>
			<center>
				<input type="checkbox" id="select-all">
			</center>
		</td>
		<td>
			<p id="select-text"><?php echo _("Select all questions"); ?></p>
		</td>
	</tr>
	<br>
	<?php
		$ctr = 1;
		foreach($question_set as $row):
	?>
	<tr class="trline">
		<td style="position: relative">
			<input type="checkbox" style="position: absolute; top: 12px;" name="onoffswitch<?php echo $ctr;?>" class="q-cb" id="myonoffswitch<?php echo $ctr;?>" value="<?php echo $row['qid']; ?>" <?php if(isset($qid)): if(in_array($row['qid'], $qid)): echo "checked"; endif; endif; ?>>
		</td>
		<td>
		<?php 
			if($row['from_review']) echo _("<span class='ask'>* </span>");
			echo _($row['question']);
			echo '<br/>';
			
			if($row['image'])
				echo '<img src="'.$row['image'].'" class="dtq-image">';
			
			$choices = $dtq->getQuestionChoices($row['qid']);
		?>
		<br/>
		<small><?php echo _("Choices"); ?>:<br/>
		<?php foreach($choices as $choice): ?>
			<span class='letters'><?php echo $choice['order']; ?></span>. <?php echo _($choice['choice']); ?><br>
		<?php endforeach; ?>
		<br/><?php echo _("Answer"); ?>: <?php echo $row['answer']; ?>
		</small>
		</td>
	</tr>
	<?php 
			$ctr++;
		endforeach; 
	?>
</table>
<div class="clear"></div>
<br/>
<a href="#" class="button1" id="save"><?php echo _("Save Changes"); ?></a>
</form>
</div>
<script>
var action 		= '<?php echo $action; ?>';
var	moduleid 	= '<?php echo $mid; ?>';
var	md 			= '<?php echo $mode; ?>';
var selected 	= [];
var dtid		= '<?php if(isset($dtid)) echo $dtid; ?>';
$(document).ready(function() {
	$('#select-all').click(function(){
		if($(this).is(':checked')) {
			$('.q-cb').each(function(){
				$(this).prop('checked', true);
				$('#select-text').html('Deselect all questions');
			});
		} else {
			$('.q-cb').each(function(){
				$(this).prop('checked', false);
				$('#select-text').html('Select all questions')
			});
		}
	});

	$('#save').click(function(e) {
		selected = [];
		$('.q-cb').each(function() {
			if($(this).is(':checked')) {
				selected.push($(this).attr('value'));
			}
		});
		
		var questions 	= selected.join(',');
		var name 		= $('#test-name').val();

		if(questions == ''){
			alert('<?php echo _("Please select questions for this test."); ?>');
			e.preventDefault();
		} else if($.trim($('#test-name').val()) == '') {
			alert('<?php echo _("Please enter a name for this test."); ?>');
			e.preventDefault();
		} else {
			$.ajax({
				type	: "POST",
				url		: "update-test.php",
				data	: {	mid: moduleid, mode: md, qid: questions, act: action, tname: name, dtid: dtid },
				success	: function(data) {
					if(data == 0) {
						$('#test-name').focus();
						$('#test-name:focus').css({
							'outline': 'none',
							'box-shadow': '0px 0px 5px rgb(230, 0, 0)',
							'border': '1px solid rgb(219, 90, 90)'
						});
						
						alert("A same test name already exists. Please change the name of the test.");
					} else window.location.href = "modules.php";
				}
			});
		}
	});
});
</script>
      <!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="test-name" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Enter a title for your test.</p>
		</li>
		<li data-id="select-all" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Select questions to include in your test by clicking the checkbox beside each question. You can click the first checkbox to select all the questions.</p>
		</li>
		<li data-id="save" 			data-text="Close" data-options="tipLocation:top;tipAnimation:fade">
			<p>Click this button to save your changes.</p>
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