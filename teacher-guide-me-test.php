<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	
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
	<?php } ?>

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
	}
	.fleft { margin-top: -16px; }
	.tguide { float: left; margin-top: 9px; }
	.guide {
		padding: 5px;
		background-color: #FF5B5B;
		border-radius: 5px;
		margin-right: 1px;
		margin-left: 1px;
		border: none;
		font-size: 10px;
		color: #fff;
		cursor: pointer;
		font-family: inherit;
	}
	.guide:hover {
		background-color: #FFBD9E;
	}
</style>
<div class="grey"></div>

<div class="fleft language" id="language">
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
	<a href="teacher-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
</div>
<div><button class="uppercase guide tguide" onClick="guide()">Guide Me</button></div>
<div class="fright m-top10" id="accounts">
	<div id="manage-container">
		<?php echo _('Manage'); ?>: 
			<a class="uppercase manage-box" href="edit-account.php?user_id=<?php echo $userid; ?>"/><?php echo _("Teacher Account"); ?></a>
			<a class="uppercase manage-box" href="phpgrid/manage-students.php"/><?php echo _("Student Accounts"); ?></a>
			<a class="uppercase manage-box" href="student-accounts.php"/><?php echo _("Student Groups"); ?></a>

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
</div>
<div class="clear"></div>
<?php if($user->getFirstname() != '') : ?>
	<h1><?php echo _("Welcome"); ?> <span class="upper bold"><?php echo $user->getFirstname(); ?></span>!</h1>
<?php else : ?>
	<h1><?php echo _("Welcome Teacher"); ?>!</h1>
<?php endif; ?>
<?php
	if(!empty($_GET["ft"])):
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

<br/>
<div id="dash"></div>
<br/>
<div id="ct">
<center>
	<a class="take-box" href="ct-settings.php" id="cumulative-settings"><?php echo _("CUMULATIVE TEST SETTINGS"); ?></a>
	<a class="take-box" href="all-ct.php" id="cumulative-results"><?php echo _("CUMULATIVE TEST RESULTS"); ?></a>
</center>
</div>
<br/>
<div id="dash"></div>
<br/><br/>

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
		<a class="uppercase take-box" href="demo/<?php echo $module['module_ID']; ?>/1.php"><?php echo _("Module"); ?></a>
		<a class="uppercase take-box" href="settings.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Settings"); ?></a>
		<a class="uppercase take-box" href="student-group-results.php?mid=<?php echo $module['module_ID']; ?>"><?php echo _("Results"); ?></a>
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
  <li data-class="language" data-text="Next" class="custom">
    <p>Languages</p>
    <p>You can set your prefered language here.</p>
  </li>
  <li data-id="accounts" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Manage</p>
    <p>You can manage accounts on these section.</p>
  </li>
  <li data-id="cumulative-settings" data-button="Next" data-options="tipLocation:top;tipAnimation:fade">
    <p>Cumulative Settings</p>
    <p>Set cumulative tests here.</p>
  </li>
  <li data-id="cumulative-results" data-button="Close">
    <p>Cumulative Results</p>
    <p>View test results here</p>
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
<script type="text/javascript" src="libraries/joyride/jquery-1.10.1.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.cookie.js"></script>
<script type="text/javascript" src="libraries/joyride/modernizr.mq.js"></script>
<script type="text/javascript" src="libraries/joyride/jquery.joyride-2.1.js"></script>
<script>
  function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 4) {
        $(this).joyride('set_li', false, 1);
      }
    },
    modal:true,
    expose: true
    });
  }
</script>
<?php require_once "footer.php"; ?>