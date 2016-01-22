<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';

	$_SESSION['from'] = 0;
	
	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php"); }
	if($user->getType() == 2){ header("Location: student.php"); }
	
	$userid 			= $user->getUserid();
	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);
	
	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$mc = new ModuleController();

	$teachermodules = array();
	
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$ufl = $user->getFirstLogin();
	if($ufl == 1){ header("Location: account-update.php"); }
?>
<style>
	<?php if($language == "es_ES") {  ?>
		.close-btn { width: 65px !important; }
	<?php } if($language == "zh_CN") { ?>
		.close-btn { width: 40px !important; }
	<?php } if($language == "ar_EG") { ?>
		#gm-language {
			float: right;
		  	margin-right: -54px;
		}
	<?php } ?>

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
	#gm-language { margin-left: -54px; }
	a.ngss_link:hover {
		text-decoration: none;
		background-color: #FAEBD7;
	}
	.fleft.language { margin-top: 10px !important; }
	div#dbguide {
	    margin-top: -28px;
	    float: left;
	}
</style>
<div class="grey"></div>

<div class="fleft language" id="gm-language">
	<?php echo _("Language"); ?>:

	<?php
			if(!empty($teacher_languages)) :
				foreach($teacher_languages as $tl) : 
					$lang = $lc->getLanguage($tl['language_id']);
		?>
					<a class="uppercase manage-box" href="teacher.php?lang=<?php echo $lang->getLanguage_code(); ?>"/><?php echo $lang->getLanguage(); ?></a>
		<?php 
				endforeach; 
			else :

		?>
			<a class="uppercase manage-box" href="teacher.php?lang=en_US"/><?php echo _("English"); ?></a>
		<?php endif; ?>

	<!-- <select id="language-menu">
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
	<a href="teacher-languages.php" class="link" id="edit-lang"><?php echo _("Edit Languages"); ?></a>
</div>
<div class="fright m-top10" id="gm-accounts">
	<div id="manage-container">
		<?php echo _('Manage'); ?>: 
			<a id="teacher-account" class="uppercase manage-box" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Teacher Account"); ?></a>
			<a id="student-accounts" class="uppercase manage-box" href="phpgrid/manage-students.php"/><?php echo _("Student Accounts"); ?></a>
			<a id="student-groups" class="uppercase manage-box" href="student-accounts.php"/><?php echo _("Student Groups"); ?></a>

		<!-- <select id="manage-menu">
			<option selected><?php //echo _('Options'); ?></option>
			<option value="edit-account.php?user_id=<?php //echo $userid; ?>&f=0"><?php //echo _('Teacher Account'); ?></option>
			<option value="phpgrid/manage-students.php"><?php //echo _('Student Accounts'); ?></option>
			<option value="student-accounts.php"><?php //echo _('Student Groups'); ?></option>
		</select> -->
	</div>
	<!-- <a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("Manage Teacher Account"); ?></a><p class="fright margin-sides">|</p>
	<a class="link fright" href="manage-student-accounts.php"><?php echo _("Manage Student Accounts"); ?></a><p class="fright margin-sides">|</p>
	<a class="link fright" href="student-accounts.php"><?php echo _("Manage Student Groups"); ?></a> -->
	<a class="uppercase manage-box fright" href="../marketing/ngss.php" target="_blank"><?php echo _("See the NGSS Alignment"); ?></a>
	
</div>
<div class="clear"></div>
<?php if($user->getFirstname() != '') : ?>
	<h1><?php echo _("Welcome"); ?> <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<?php else : ?>
	<h1><?php echo _("Welcome Teacher"); ?>!</h1>
<?php endif; ?>
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
<p><?php echo _("This is your Dashboard. On this page, you can preview the modules available for your students, adjust modules settings and view the students' results."); ?></p></br>
	<p id="new_note"><?php echo _("<b>NOTE:</b> We are in the process of adding an \"English language voice-over\" to all the modules. The voice-over will allow students to hear the module read to them in English as they read the module in any of the four language options. The \"Heating & Cooling\" module is a sample of how the voice-over works."); ?></p>

<br/>
<div id="dash"></div>
<br/>
<div id="ct">
<center>
	<a class="take-box" href="ct-settings.php" id="gm-cumulative-settings"><?php echo _("CUMULATIVE TEST SETTINGS"); ?></a>
	<a class="take-box" href="all-ct.php" id="gm-cumulative-results"><?php echo _("CUMULATIVE TEST RESULTS"); ?></a>
</center>
</div>
<br/>
<div id="dash"></div>
<br/><br/>
<div id="gm-module"></div>
<?php 
	$modules = $mc->getAllModules();
	foreach($modules as $module):
		foreach($tm_set as $sm):
			if($module['module_ID'] == $sm['module_id']):
				array_push($teachermodules, $module['module_ID']);
?>
<div class="module-box teacher-mb">
	<span><?php echo _($module['category']); ?></span>
	<!-- <span class="desc-btn"><?php echo _("Overview"); ?></span> -->
	
	<div class="mod-desc">
		<div><?php echo _($module['module_desc']); ?></div>
		<span class="close-btn"><?php echo _("Close!"); ?></span>
	</div>

	<h2><?php echo _($module['module_name']); ?></h2>
	<br/>
	<div class="module-menu">
		<a class="uppercase take-box desc-btn" href="#"><?php echo _("Overview"); ?></a>
		<a id="vmodule" class="uppercase take-box" href="demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("Module"); ?></a>
		<a id="settings" class="uppercase take-box" href="settings.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Settings"); ?></a>
		<a id="results" class="uppercase take-box" href="student-group-results.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Results"); ?></a>
	</div>
	<br>
</div>
<?php 
			endif;
		endforeach;
	endforeach;

	$_SESSION['modules'] = $teachermodules;
?>

<div class="clear"></div>

<!-- guide me content -->
<ol id="joyRideTipContent">
  <li data-id="edit-lang" data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click on <strong>Edit Languages</strong> to set the language options in which the modules themselves and your dashboard and its  functions can be viewed. You can change the language anytime by selecting a language in the drop down box.</p>
  </li>
  <li data-id="teacher-account" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to personalize your information.</p>
  </li>
  <li data-id="student-accounts" data-button="Next" data-options="tipLocation:left;tipAnimation:fade">
    <p>Click this button to manage account and change password of your students.</p>
  </li>
  <li data-id="student-groups" data-button="Next" data-options="tipLocation:left;tipAnimation:fade">
    <p>Click this button to manage student groups. You can create groups and transfer students as well.</p>
  </li>
  <li data-id="gm-module" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>This is the module box. This is where you can manage data related to the module. You can click on the <strong>Overview</strong> button to view the description of each module.</p>
  </li>
  <li data-id="vmodule" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Clicking this button will allow you to go through the module as a student would experience it. This is for demonstration purposes only so answers are not saved.</p>
  </li>
  <li data-id="settings" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>The settings button will take you to a screen that allows you to do the following:</p>
    <ul style="padding-left: 20px; font-size: 14px;">
    	<li>Open/close the module completely for any or all groups</li>
    	<li>Create, edit or delete a pre and/or post diagnostic test</li>
    	<li>Open/close a pre and post diagnostic tests for the student groups</li>
    	<li>Set time limits for the test for each student group</li>
    </ul>
    <p></p>
  </li>
  <li data-id="results" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>All student's responses to questions embedded in a module, including questions on the pre and post diagnostic tests for a module and a "cumulative" post-diagnostic test across several modules, are automatically recorded in a database and will be available for individual students and groups of students.</p>
    <p>Clicking on this button will take you to a screen where you can select a group and view the test results of the students in that group.</p>
  </li>
  <li data-id="gm-cumulative-settings" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to create a <strong>"cumulative test"</strong>. This test can cover any or all modules.<br/>Creating and administering a <strong>"cumulative test"</strong> across several modules is optional.</p>
  </li>
  <li data-id="gm-cumulative-results" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Click this button to view the results of the cumulative tests of students.</p>
  </li>
  <li data-id="lout" data-button="Close" data-options="tipLocation:left;tipAnimation:fade">
    <p>Clicking the <strong>Logout</strong> link will log you out of NexGenReady dashboard.</p>
  </li>
</ol>

<script>
	$("#manage-menu").change(function() {
		window.location = $(this).find("option:selected").val();
	});

	$(".close-btn").on("click", function(){
		$(".mod-desc").css("display", "none");
		$(".grey").css("display", "none");
	});
	
	$(".desc-btn").on("click", function(){
		$(this).parent().parent().find(".mod-desc").css("display", "block");
		
		//$(".mod-desc").css("display", "block");
		$(".grey").css("display", "block");
	});
</script>

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