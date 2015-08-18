<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	
	$uc = new UserController();
	$userid = $user->getUserid();

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);

	$stds = $uc->getAllStudents($userid);
	$teacherID = $stds[0]["teacher_id"];
	$groupHolder = $sgc->getGroups($teacherID);
	$groupID = $groupHolder[0]['group_id'];
	$groupNameHolder = $sgc->getGroupName($groupID);
	$group_name = $groupNameHolder[0]["group_name"];

	$dtc 				= new DiagnosticTestController();
	$ct  				= $dtc->getCumulativeTest($userid);
	$diagnostic_test  	= $dtc->getAllTeacherTests($userid);

	$gmc 		= new GroupModuleController();
	$gm			= $gmc->getModuleGroupByID($groupID,"fossils");
	if(!$gm):
		$values = array(
			"group_id" 			=> $groupID,
			"module_id"			=> "fossils",
			"pretest_id"		=> 0,
			"posttest_id"		=> 0,
			"review_active"		=> 0,
			"pre_active"		=> 0,
			"post_active"		=> 0,
			"timelimit_pre"		=> "00:45:00",
			"timelimit_post"	=> "00:45:00"
		);

		$gmc->addGroupModule($values);
	endif;

	$gm2 = $gmc->getModuleGroupByID($groupID,"gathering-data");
	if(!$gm2):
		$values = array(
			"group_id" 			=> $groupID,
			"module_id"			=> "gathering-data",
			"pretest_id"		=> 0,
			"posttest_id"		=> 0,
			"review_active"		=> 0,
			"pre_active"		=> 0,
			"post_active"		=> 0,
			"timelimit_pre"		=> "00:45:00",
			"timelimit_post"	=> "00:45:00"
		);

		$gmc->addGroupModule($values);
	endif;

	$gm3 = $gmc->getModuleGroupByID($groupID,"how-animals-behave");
	if(!$gm3):
		$values = array(
			"group_id" 			=> $groupID,
			"module_id"			=> "how-animals-behave",
			"pretest_id"		=> 0,
			"posttest_id"		=> 0,
			"review_active"		=> 0,
			"pre_active"		=> 0,
			"post_active"		=> 0,
			"timelimit_pre"		=> "00:45:00",
			"timelimit_post"	=> "00:45:00"
		);

		$gmc->addGroupModule($values);
	endif;

	$tmc = new TeacherModuleController();
	$tm_set = $tmc->getTeacherModule($userid);
	
	$teachermodules = array();
	
	$lc = new LanguageController();
	$teacher_languages = $lc->getLanguageByTeacher($userid);

	$mc = new ModuleController();
	$modules = $mc->getAllModules();
	$dtc = new DiagnosticTestController();
	$testIDa = $dtc->getAllTeacherTests1($teacherID);

	$m1TestIDa = "";
	$m2TestIDa = "";
	$m3TestIDa = "";
	for ($i = 0; $i < sizeof($testIDa); $i++) {
		if(strpos($testIDa[$i]["module_id"],'fossils') !== false){
			$m1a = 1;
			$m1TestIDa = $testIDa[$i]["dt_id"];
			$m1TestNamea = $testIDa[$i]["test_name"];
		}
		if(strpos($testIDa[$i]["module_id"],'gathering-data') !== false){
			$m2a = 1;
			$m2TestIDa = $testIDa[$i]["dt_id"];
			$m2TestNamea = $testIDa[$i]["test_name"];
		}
		if(strpos($testIDa[$i]["module_id"],'how-animals-behave') !== false){
			$m3a = 2;
			$m3TestIDa = $testIDa[$i]["dt_id"];
			$m3TestNamea = $testIDa[$i]["test_name"];
		}
	}

	$testIDb = $dtc->getAllTeacherTests2($teacherID);

	$m1TestIDb = "";
	$m2TestIDb = "";
	$m3TestIDb = "";
	for ($i = 0; $i < sizeof($testIDb); $i++) {
		if(strpos($testIDb[$i]["module_id"],'fossils') !== false){
			$m1b = 1;
			$m1TestIDb = $testIDb[$i]["dt_id"];
			$m1TestNameb = $testIDb[$i]["test_name"];
		}
		if(strpos($testIDb[$i]["module_id"],'gathering-data') !== false){
			$m2b = 1;
			$m2TestIDb = $testIDb[$i]["dt_id"];
			$m2TestNameb = $testIDb[$i]["test_name"];
		}
		if(strpos($testIDb[$i]["module_id"],'how-animals-behave') !== false){
			$m3b = 2;
			$m3TestIDb = $testIDb[$i]["dt_id"];
			$m3TestNameb = $testIDb[$i]["test_name"];
		}
	}

	if(!empty($m1TestIDa)){
	?>
		<script>
			var pre = <?php echo $m1TestIDa; ?>;
			var preact	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var pre = "0";
			var preact	= "0";
		</script>
	<?php
	}
	if(!empty($m1TestIDb)){
	?>
		<script>
			var post = <?php echo $m1TestIDb; ?>;
			var postact	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var post = "0";
			var postact	= "0";
		</script>
	<?php
	}

	if(!empty($m2TestIDa)){
	?>
		<script>
			var pre2 = <?php echo $m2TestIDa; ?>;
			var preact2	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var pre2 = "0";
			var preact2	= "0";
		</script>
	<?php
	}
	if(!empty($m2TestIDb)){
	?>
		<script>
			var post2 = <?php echo $m2TestIDb; ?>;
			var postact2	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var post2 = "0";
			var postact2	= "0";
		</script>
	<?php
	}

	if(!empty($m3TestIDa)){
	?>
		<script>
			var pre3 = <?php echo $m3TestIDa; ?>;
			var preact3	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var pre3 = "0";
			var preact3	= "0";
		</script>
	<?php
	}
	if(!empty($m3TestIDb)){
	?>
		<script>
			var post3 = <?php echo $m3TestIDb; ?>;
			var postact3	= "1";
		</script>
	<?php
	} else{
	?>
		<script>
			var post3 = "0";
			var postact3	= "0";
		</script>
	<?php
	}
	
?>
<div class='lgs-container'>
 	<div class="center">
 		<h1 class="lgs-text">Let's Get Started</h1>
		<p class="lgs-text-sub heading-input step step2">Step 3: Your Modules</p>
		<p class="lgs-text-sub heading-input">Modules</p>
		<p class="lgs-text-sub note">Listed below are 3 of the 30 modules available in your free trial account. You can choose to start by creating the pre and post diagnostic tests for any module (first two buttons) and then simply click on Activate (last button), or you can choose to quickly activate any or all of these 3 modules by clicking on the Activate button (last button) and skip the pre and post diagnostic tests.</p>
		<p class="lgs-text-sub note"><b>Note: </b>You also have the option to activate any of the 30 modules in the Dashboard later.</p>
		<table class="modules">
			<tr>
				<td class="module-name"><?php echo _("Fossils"); ?></td>
			</tr>
			<tr class="lgs-modules">
				<td class="dactivate">
					<a id="1a"
					<?php if(!empty($m1a)) { ?>
						href="lgs-test.php?dtid=<?php echo $m1TestIDa; ?>&action=edit"><?php echo _("Edit Pre-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=fossils&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate">
					<a id="1b" <?php
					if(!empty($m1b)){ ?>
						href="lgs-test.php?dtid=<?php echo $m1TestIDb; ?>&action=edit"><?php echo _("Edit Post-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=fossils&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate" id="tm1">
					<input class="dactivatemin" type="button" id="m1" value="<?php if(!empty($gm)){if($gm[0]['pre_active'] == '1' || $gm[0]['post_active'] == '1' || $gm[0]['review_active'] == '1'){ ?>Deactivate for <?php echo $group_name; ?><?php } else { ?>Activate for <?php echo $group_name; ?><?php }} else { ?>Activate for <?php echo $group_name; ?><?php } ?>" onclick="toggle1();">
				</td>
			</tr>
			<tr class="rowSpace">
				<td class="module-name"><?php echo _("Gathering Data"); ?></td>
			</tr>
			<tr class="lgs-modules">
				<td class="dactivate">
					<a id="2a" <?php
					if(!empty($m2a)){ ?>
						href="lgs-test.php?dtid=<?php echo $m2TestIDa; ?>&action=edit"><?php echo _("Edit Pre-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=gathering-data&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate">
					<a id="2b" <?php
					if(!empty($m2b)){ ?>
						href="lgs-test.php?dtid=<?php echo $m2TestIDb; ?>&action=edit"><?php echo _("Edit Post-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=gathering-data&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate" id="tm2">
					<input class="dactivatemin" type="button" id="m2" value="<?php if(!empty($gm2)){if($gm2[0]['pre_active'] == '1' || $gm2[0]['post_active'] == '1' || $gm2[0]['review_active'] == '1'){ ?>Deactivate for <?php echo $group_name; ?><?php } else { ?>Activate for <?php echo $group_name; ?><?php }} else { ?>Activate for <?php echo $group_name; ?><?php } ?>" onclick="toggle2();">
				</td>
			</tr>
			<tr class="rowSpace">
				<td class="module-name"><?php echo _("How Animals Behave"); ?></td>
			</tr>
			<tr class="lgs-modules">
				<td class="dactivate">
					<a id="3a" <?php
					if(!empty($m3a)){ ?>
						href="lgs-test.php?dtid=<?php echo $m3TestIDa; ?>&action=edit"><?php echo _("Edit Pre-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=how-animals-behave&mode=pre&action=new"><?php echo _("Create Pre-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate">
					<a id="3b" <?php
					if(!empty($m3b)){ ?>
						href="lgs-test.php?dtid=<?php echo $m3TestIDb; ?>&action=edit"><?php echo _("Edit Post-Diagnostic Test"); ?>
					<?php } else { ?>
						href="lgs-test.php?module_id=how-animals-behave&mode=post&action=new"><?php echo _("Create Post-Diagnostic Test"); ?>
					<?php } ?>
					</a>
				</td>
				<td class="dactivate" id="tm3">
					<input class="dactivatemin" type="button" id="m3" value="<?php if(!empty($gm3)){if($gm3[0]['pre_active'] == '1' || $gm3[0]['post_active'] == '1' || $gm3[0]['review_active'] == '1'){ ?>Deactivate for <?php echo $group_name; ?><?php } else { ?>Activate for <?php echo $group_name; ?><?php }} else { ?>Activate for <?php echo $group_name; ?><?php } ?>" onclick="toggle3();">
				</td>
			</tr>
			
		</table>
		<!-- <input id="skip_Submit" name="skip_Submit" class="start" type="submit" value="Next" />final-words.php -->
		<a href="#" class="nbtn" id="next">Next</a>
		<a class="nbtn back" href="phpgrid/student-information.php">Back</a>
	</div>
</div>
<script>
	function toggle1()
	{
	  if(document.getElementById("m1").value=="Deactivate for <?php echo $group_name; ?>"){
	   document.getElementById("m1").value="Activate for <?php echo $group_name; ?>";
	   // $(document.getElementById("tm1")).css('background-color','#FF5B5B');
		var review	= "0";
		var pret	= "00:45:00";
		var postt	= "00:45:00";
		var msg = "The following has been deactivated for <?php echo $group_name; ?>:\n* Fossils module";
		<?php if(!empty($m1TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m1TestNamea; ?>"; <?php } ?>
		<?php if(!empty($m1TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m1TestNameb; ?>"; <?php } ?>
		$.ajax({
			type	: "POST",
			url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=fossils",
			data	: {	preid: pre, postid: post, ractive: review, preactive: "0", postactive: "0", pretl: pret, posttl: postt },
			success	: function(json) {
				if(json.error) return;
				alert(msg);
			}
		});
	  }

	  else if(document.getElementById("m1").value=="Activate for <?php echo $group_name; ?>"){
	  	var txt1 = document.getElementById("1a").text;
	  	if(txt1.indexOf("Create") > -1){
	  		var r1 = confirm("Are you sure you want to activate the module without activating the pre-test? Once your students start with the module, you won't be able to activate a pre-test.");
	  	} else { r1 = true; }
		if(r1 == true)
		{
		    document.getElementById("m1").value="Deactivate for <?php echo $group_name; ?>";
		    // $(document.getElementById("tm1")).css({backgroundColor: "#A4A4A4"});
			var review	= "1";
			var pret	= "00:45:00";
			var postt	= "00:45:00";
			var msg = "The following has been automatically activated for <?php echo $group_name; ?>:\n* Fossils module";
			<?php if(!empty($m1TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m1TestNamea; ?>"; <?php } ?>
			<?php if(!empty($m1TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m1TestNameb; ?>"; <?php } ?>
			$.ajax({
				type	: "POST",
				url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=fossils",
				data	: {	preid: pre, postid: post, ractive: review, preactive: preact, postactive: postact, pretl: pret, posttl: postt },
				success	: function(json) {
					if(json.error) return;
					alert(msg);
				}
			});
		}
	  }
	}
	function toggle2()
	{
	  if(document.getElementById("m2").value=="Deactivate for <?php echo $group_name; ?>"){
	   document.getElementById("m2").value="Activate for <?php echo $group_name; ?>";
	   // $(document.getElementById("tm2")).css('background-color','#FF5B5B');
		var review	= "0";
		var pret	= "00:45:00";
		var postt	= "00:45:00";
		var msg = "The following has been deactivated for <?php echo $group_name; ?>:\n* Gathering data module";
		<?php if(!empty($m2TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m2TestNamea; ?>"; <?php } ?>
		<?php if(!empty($m2TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m2TestNameb; ?>"; <?php } ?>
		$.ajax({
			type	: "POST",
			url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=gathering-data",
			data	: {	preid: pre2, postid: post2, ractive: review, preactive: "0", postactive: "0", pretl: pret, posttl: postt },
			success	: function(json) {
				if(json.error) return;
				alert(msg);
			}
		});
	  }

	  else if(document.getElementById("m2").value=="Activate for <?php echo $group_name; ?>"){
		var txt2 = document.getElementById("2a").text;
	  	if(txt2.indexOf("Create") > -1){
	  		var r2 = confirm("Are you sure you want to activate the module without activating the pre-test? Once your students start with the module, you won't be able to activate a pre-test.");
	  	} else { r2 = true; }
		if(r2 == true)
		{
		    document.getElementById("m2").value="Deactivate for <?php echo $group_name; ?>";
		    // $(document.getElementById("tm2")).css({backgroundColor: "#A4A4A4"});
			var review	= "1";
			var pret	= "00:45:00";
			var postt	= "00:45:00";
			var msg = "The following has been automatically activated for <?php echo $group_name; ?>:\n* Gathering data module";
			<?php if(!empty($m2TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m2TestNamea; ?>"; <?php } ?>
			<?php if(!empty($m2TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m2TestNameb; ?>"; <?php } ?>
			$.ajax({
				type	: "POST",
				url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=gathering-data",
				data	: {	preid: pre2, postid: post2, ractive: review, preactive: preact2, postactive: postact2, pretl: pret, posttl: postt },
				success	: function(json) {
					if(json.error) return;
					alert(msg);
				}
			});
		}
	  }
	}
	function toggle3()
	{
	  if(document.getElementById("m3").value=="Deactivate for <?php echo $group_name; ?>"){
	   document.getElementById("m3").value="Activate for <?php echo $group_name; ?>";
	   // $(document.getElementById("tm3")).css('background-color','#FF5B5B');
		var review	= "0";
		var pret	= "00:45:00";
		var postt	= "00:45:00";
		var msg = "The following has been deactivated for <?php echo $group_name; ?>:\n* How animals behave module";
		<?php if(!empty($m3TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m3TestNamea; ?>"; <?php } ?>
		<?php if(!empty($m3TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m3TestNameb; ?>"; <?php } ?>
		$.ajax({
			type	: "POST",
			url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=how-animals-behave",
			data	: {	preid: pre3, postid: post3, ractive: review, preactive: "0", postactive: "0", pretl: pret, posttl: postt },
			success	: function(json) {
				if(json.error) return;
				alert(msg);
			}
		});
	  }

	  else if(document.getElementById("m3").value=="Activate for <?php echo $group_name; ?>"){
	  	var txt3 = document.getElementById("3a").text;
	  	if(txt3.indexOf("Create") > -1){
	  		var r3 = confirm("Are you sure you want to activate the module without activating the pre-test? Once your students start with the module, you won't be able to activate a pre-test.");
	  	} else { r3 = true; }
		if(r3 == true)
		{
			// && document.getElementById("3").value!="Deactivate for <?php echo $group_name; ?>"
		    document.getElementById("m3").value="Deactivate for <?php echo $group_name; ?>";
		    // $(document.getElementById("tm3")).css({backgroundColor: "#A4A4A4"});
			var review	= "1";
			var pret	= "00:45:00";
			var postt	= "00:45:00";
			var msg = "The following has been automatically activated for <?php echo $group_name; ?>:\n* How animals behave module";
			<?php if(!empty($m3TestNamea)) { ?> msg += "\n* The pre-diagnostic test <?php echo $m3TestNamea; ?>"; <?php } ?>
			<?php if(!empty($m3TestNameb)) { ?> msg += "\n* The post-diagnostic test <?php echo $m3TestNameb; ?>"; <?php } ?>
			$.ajax({
				type	: "POST",
				url		: "update-module-group.php?group_id=<?php echo $groupID; ?>&module_id=how-animals-behave",
				data	: {	preid: pre3, postid: post3, ractive: review, preactive: preact3, postactive: postact3, pretl: pret, posttl: postt },
				success	: function(json) {
					if(json.error) return;
					alert(msg);
				}
			});
		}
	  }
	}
	$("#next" ).click(function() {
		location.assign("final-words.php");
	});
</script>
      <!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="1a" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Create a pre-diagnostic test for any module by clicking the button below. After you create a pre-diagnostic test, the button's text will change to <strong>Edit Pre-Diagnostic test</strong>. Clicking this button will let you update the test.</p>
		</li>
		<li data-id="1b" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Create a post-diagnostic test for any module by clicking the button below. After you create a post-diagnostic test, the button's text will change to <strong>Edit Post-Diagnostic test</strong>. Clicking this button will let you update the test.</p>
		</li>
		<li data-id="m1" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Click this button to activate the module as well as the pre-diagnostic test and post-diagnostic test, if you created any.</p>
		</li>
		<li data-id="next" 			data-text="Close" data-options="tipLocation:left;tipAnimation:fade">
			<p>Click <strong>Next</strong> to go to the next page.</p>
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
<?php include "footer.php"; ?>