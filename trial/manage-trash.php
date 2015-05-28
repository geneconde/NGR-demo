<?php
	ini_set('display_errors', 1);
	require_once '../session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once '../controller/DiagnosticTest.Controller.php';
	include_once '../controller/TeacherModule.Controller.php';
	include_once '../controller/Module.Controller.php';
	include_once '../controller/Language.Controller.php';
	include_once('../controller/Subscriber.Controller.php');
	
	$userid 			= $user->getUserid();

	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	$student_count = $uc->countUserType($user->getSubscriber(), 2);
		
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

?>
<div class="fleft" id="language">
	<?php echo _("Language"); ?>:
	<select id="language-menu">
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
	</select>
	<a href="edit-languages.php" class="link"><?php echo _("Edit Languages"); ?></a>
</div>
<div class="fright m-top10" id="accounts">
	<a class="link fright" href="edit-account.php?user_id=<?php echo $userid; ?>&f=0"><?php echo _("My Account"); ?></a>
</div>
<div class="clear"></div>
<h1><?php echo _("Welcome"); ?>, <span class="upper bold"><?php echo $sub->getFirstName(); ?></span>!</h1>
<p><?php echo _("This is your Dashboard. In this page, you can manage your teachers, students and informations."); ?>

<div class="wrap-container">
<!-- editable grid -->
	<div id="wrap">
		<h1>List of Students</h1>
		<div class="fright">
			<!-- <a href="index.php" class="link" style="display: inline-block;">Dashboard</a>	| -->
			<a href="index.php" class="link" style="display: inline-block;">Manage Teachers</a> |
			<a href="manage-trash.php" class="link" style="display: inline-block;">Trash</a>
			<!-- <a href="manage-students.php" class="link" style="display: inline-block;">Manage Students</a> -->
		</div>
		<!-- Feedback message zone -->
		<div id="message"></div>

        <div id="toolbar">
          <input type="text" id="filter" name="filter" placeholder="Filter :type any text here"  />
          <?php if($sub->getStudents() != $student_count) : ?>
          	<a id="showaddformbutton" class="button">Add new row</a>
          <?php else : ?>
          	<a href="#" onclick="alert('You have reached the maximum number of students.')" class="button cgray">Add new row</a>
          <?php endif; ?>
        </div>
		<!-- Grid contents -->
		<div id="tablecontent"></div>
	
		<!-- Paginator control -->
		<div id="paginator"></div>
	</div>  
		
	<script src="js/editablegrid-2.1.0-b13.js"></script>   
	<script src="js/jquery-1.11.1.min.js" ></script>
    <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="js/trash.js" ></script>

	<script type="text/javascript">
	
        var datagrid = new DatabaseGrid();
		window.onload = function() { 

            // key typed in the filter field
            $("#filter").keyup(function() {
                datagrid.editableGrid.filter( $(this).val());

                // To filter on some columns, you can set an array of column index 
                //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
              });   
		}; 
	</script>

</div>

<div class="clear"></div>
<?php require_once "footer.php"; ?>