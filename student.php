<?php
	require_once 'session.php';	
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'php/functions.php';
	require_once 'controller/StudentModule.Controller.php';
	require_once 'controller/Module.Controller.php';
	require_once 'controller/StudentGroup.Controller.php';
	require_once 'controller/GroupModule.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';
	require_once 'controller/StudentCt.Controller.php';
	include_once 'controller/Language.Controller.php';
	
	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php?ut=2"); }

	$teacherid 			= $user->getTeacher();
	$userid				= $user->getUserid();

	$gmc				= new GroupModuleController();
	$sgc				= new StudentGroupController();
	$teacher_group		= $sgc->getActiveGroups($teacherid);
	
	foreach($teacher_group as $tgroup):
		$users = $sgc->getUsersInGroup($tgroup['group_id']);

		if(in_array($userid, $users)):
			$usergroup = $tgroup['group_id'];
			$_SESSION['group'] = $usergroup;
			break;
		else:
			$usergroup = 0;
		endif;
	endforeach;

	$scc				= new StudentCtController();
	$ctg				= $scc->getActiveCT($usergroup);
	$ctid 				= 0;

	if($ctg) {
		$ctid = $ctg[0]['ct_id'];
	}

	$ctc 				= new CumulativeTestController();
	$ct 				= $ctc->getCumulativeTestByID($ctid);
	
	$mc					= new ModuleController();
	$modules 			= $mc->getAllModules();

	$tmc				= new TeacherModuleController();
	$tm_set				= $tmc->getTeacherModule($teacherid);
	
	if($ct):
		$st				= $scc->getStudentCt($userid, $ct->getCTID());
	endif;

	$smc				= new StudentModuleController();
	$student_modules	= $smc->loadAllStudentModule($userid);

	$_SESSION['modules'] = array();
	
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($teacherid);
?>
<style>
	.tguide { margin-top: 9px; }
	.first-timer {
		background-color: #D6E3BC;
		border-radius: 25px;
		width: 95%;
		margin: 0 auto;
		margin-bottom: 10px;
	}
	.first-timer p{
		padding: 15px;
		line-height: 1.4rem;
		font: 18px;
	}
	.first-timer button{
		padding: 5px;
		font-family: inherit;
		margin: 0 2px;
	}
	.fleft { margin: 0; }
	#gm-language {
		margin-left: -54px;
  		margin-top: -16px;
  	}
  	.module-nav { margin-right: 5px; }
  	<?php if($language == "ar_EG") { ?>
		#gm-language {
			float: right;
		  	margin-right: -54px;
		}
	<?php } ?>
	.fleft.language { margin-top: 10px !important; }
	div#dbguide {
	    margin-top: -28px;
	    float: left;
	}
</style>

<div class="fleft language" id="gm-language">
	<?php echo _("Language"); ?>:
	<?php
		if(!empty($teacher_languages)) :
			foreach($teacher_languages as $tl) : 
				$lang = $lc->getLanguage($tl['language_id']);
	?>
				<a class="uppercase manage-box" href="student.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getLanguage(); ?></a>
	<?php 
			endforeach; 
		else :
	?>
		<a class="uppercase manage-box" href="student.php?lang=en_US"/><?php echo _("English"); ?></a>
	<?php endif; ?>
<!-- 	<select id="language-menu">
		<?php
			if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']);
		?>
					<option value="<?php echo $lang->getLanguage_code(); ?>" <?php if($language == $lang->getLanguage_code()) { ?> selected <?php } ?>><?php echo $lang->getLanguage(); ?></option>
		<?php 
				endforeach; 
			else :
		?>
			<option value="en_US" <?php if($language == "en_US") { ?> selected <?php } ?>><?php echo _("English"); ?></option>
		<?php endif; ?>
	</select> -->
</div>
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<?php
	if(isset($_GET["ft"])):
		if($_GET["ft"]==1): ?>
			<div class="first-timer">
				<p>It looks like this is your first time to visit your dashboard...<br/>
				Here at NexGenReady, we place great emphasis on making our interface easy for you to use. To help you learn how to get the most out of all the features of our site, you can click on the <button class="uppercase guide" onClick="guide()">Guide Me</button>button on each page. This will help you navigate and utilize all the things you can do in each section.</p>
			</div>
		<?php
		endif;
	endif;
?>
<p><?php echo _("This is your Dashboard. On this page, you can select a module to work on and view the results of the modules you have taken."); ?></p></br>
<p id="new_note"><?php echo _("<b>NOTE:</b> We are in the process of adding an��English language voice-over� to all the modules. The voice-over will allow students to hear the module read to them in English as they�read the module in any of the four language options. The��Heating & Cooling� module is a sample of how the voice-over works."); ?></p>

<div id="dash"></div>
<br/>

<?php 
	if($ct): ?>
		<center>
		<div id="ct">
<?php
	if(isset($st)){
		$sct = $ctc->getCumulativeStudent($userid, $ctid);
		$scid = $sct[0]['student_ct_id'];
		$tsa = $ctc->getTotalStudentAnswers($scid);
		$ind = sizeof($tsa);
		$ct				= $ctc->getCumulativeTestByID($ctid);
		$questions		= explode(',',$ct->getQid());
	}
		if(!isset($st)){ ?>
			<a href="take-ct.php?ctid=<?php echo $ct->getCTID(); ?>" class="take-box take-cumulative"><?php echo _("Take Cumulative Test"); ?></a>
<?php	} else if($ind != sizeof($questions)) { ?>
			<a href="ct.php?ctid=<?php echo $ct->getCTID().'&i='.$ind; ?>" class="take-box take-cumulative"><?php echo _("Continue Cumulative Test"); ?></a>
		<?php } ?>
		<a href="student-ct-listing.php" class="take-box cumulative-results"><?php echo _("View Cumulative Test Results"); ?></a>
		<br/>
		<br/>
		</div>
		</center>
		<div id="dash"></div>
		<br/>
<?php
	endif;

	if($tm_set):
		
		foreach($modules as $module):
			$moduleid = $module['module_ID'];
			
			foreach($tm_set as $sm):
				if($moduleid == $sm['module_id']):				
?>
					<div class="module-box">
						<h2><?php echo _($module['module_name']); ?></h2>
							<?php 
								$pre 		= checkPreTest($usergroup, $moduleid, $userid);
								$pre_result = $pre['result'];
								
								echo $pre['output'];
								
								if($pre_result):
									$review 		= checkGroupModule($usergroup, $moduleid, $userid);
									$review_result 	= $review['result'];
									
									echo $review['output'];
								endif;
								
								if(isset($review_result) && $review_result):
									$post			= checkPostTest($usergroup, $moduleid, $userid);
									$post_result	= $post['result'];

									echo $post['output'];
								endif;
								
								$pre_result = 0;
								$review_result = 0;
							?>
					</div>
<?php			endif;
			endforeach;
		endforeach;
	else:
?>	
	<div id="dash"></div>
	<br>
	<center><h2><?php echo _("Your teacher has not activated any modules for you yet."); ?></h2></center>
	<br>
	<div id="dash"></div>
<?php endif; ?>

<!-- guide me content -->
<ol id="joyRideTipContent">
  <li data-id="gm-language" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>If there are several languages available, click on the button of the language you want to use for all modules and dashboard interface.</p>
  </li>
  <li data-class="module-box" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>This is the module box. Click the buttons to take modules and pre/post tests and view your results.</p>
  </li>
  <li data-class="take-cumulative" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to take the cumulative test.</p>
    <p></p>
  </li>
  <li data-class="cumulative-results" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to view the results of the cumulative tests.</p>
    <p></p>
  </li>
  <li data-id="lout" data-button="Close" data-options="tipLocation:left;tipAnimation:fade">
    <p>Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard.</p>
  </li>
</ol>
<script>
function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 4) {
        $(this).joyride('set_li', false, 1);
      }
    },
    // modal:true,
    // expose: true
    });
}
$(document).ready(function() {
	language = "<?php echo $language; ?>";
	
	if(language == "ar_EG" || language == "es_ES") {
		$('.module-box .take-box').css('padding','15px 5px');
		$('.module-box .take-box').css('fontSize','14px');
		$('.module-box .button1').css('fontSize','11px');
	}
});
</script>
<?php require_once "footer.php"; ?>