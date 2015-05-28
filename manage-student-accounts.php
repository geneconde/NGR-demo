<?php
	ini_set('display_errors', 1);
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	//include_once('controller/Subscriber.Controller.php');

	$userid 			= $user->getUserid();

	$sc = new SubscriberController();
	$sub = $sc->loadSubscriber($user->getSubscriber());

	//add parameter for is_deleted and is_archived later on method is under userController
	$student_count = $uc->countUserType($user->getSubscriber(), 2);
		
	//added for languages by jp
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);
?>
<link rel="stylesheet" type="text/css" href="trial/css/style.css" />
<link rel="stylesheet" href="trial/css/font-awesome-4.1.0/css/font-awesome.min.css" type="text/css" media="screen" />

<a class="link" href="teacher.php">&laquo; <?php echo _("Go Back"); ?></a><br/><br/>

<!--
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

<div class="clear"></div>

<h1><?php echo _("Welcome"); ?>, <span class="upper bold">Teacher</span>!</h1>
-->
<div class="wrap-container">

<!-- editable grid -->
	<div id="wrap">

		<h1><?php echo _('List of Students') ?></h1>
		<p>*<?php echo _(' Click the column title to filter it Ascending or Descending.'); ?></li></p>
		<br/>
		<!-- Feedback message zone -->
		<div id="message"></div>

        <div id="toolbar">

          <input type="text" id="filter" name="filter" placeholder="Search"  />

        </div>

		<!-- Grid contents -->
		<div id="tablecontent"></div>
	
		<!-- Paginator control -->
		<div id="paginator"></div>

	</div>  
		
	<script src="scripts/editablegrid-2.1.0-b13.js"></script>   
	<script src="trial/js/jquery-1.11.1.min.js" ></script>
    <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="scripts/students.js" ></script>

	<script type="text/javascript">
	
        var datagrid = new DatabaseGrid();
		window.onload = function() { 

            // key typed in the filter field
            $("#filter").keyup(function() {
                datagrid.editableGrid.filter( $(this).val());

                // To filter on some columns, you can set an array of column index 
                //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
            });

            $("#cancelbutton").on("click", function() {
         		showAddForm();
	        });

	        $("#addbutton").on("click", function() {
	        	datagrid.addRow();
	        }); 

	        // $("#showaddformbutton").on("click", function()  {
	        //     showAddForm();
	        // });
		}; 

       /* function showAddForm() {
		if ( $("#addform").is(':visible') ) 
		    $("#addform").css("display","none");
		else
		    $("#addform").css("display","block");
		}
		*/

	</script>

    <!-- simple form, used to add a new row 
    <div id="addform">
		<div class="row">
            <input type="text" id="username" name="username" placeholder="User Name" />
        </div>

        <div class="row">
            <input type="password" id="password" name="password" placeholder="Password" />
        </div>

        <div class="row">
            <input type="text" id="lastname" name="lastname" placeholder="Last Name" />
        </div>

        <div class="row">
            <input type="text" id="firstname" name="firstname" placeholder="First Name" />
        </div>

		<div class="row">
            <input type="text" id="grade_level" name="grade_level" placeholder="Grade Level" />
        </div>

        <div class="row">
            <label>Gender:</label><input type="radio" id="gender" name="gender" value="M"/>Male
            <input type="radio" id="gender" name="gender" value="F"/>Female
        </div>

        <div class="row tright">
          <a id="addbutton" class="button">Apply</a>
          <a id="cancelbutton" class="button">Cancel</a>
        </div>
    </div>
	-->
</div>

<div class="clear"></div>

<?php require_once "footer.php"; ?>