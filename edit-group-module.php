<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/GroupModule.Controller.php';
	include_once 'controller/StudentModule.Controller.php';
	include_once 'controller/StudentGroup.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
		
	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";
	
	$userid		= $user->getUserid();
	$mid 		= $_GET['module_id'];
	$groupid	= $_GET['group_id'];
	$action		= $_GET['action'];
	
	$gmc 		= new GroupModuleController();
	$gm			= $gmc->getModuleGroupByID($groupid,$mid);

	if(!$gm):
		$values = array(
			"group_id" 			=> $groupid,
			"module_id"			=> $mid,
			"pretest_id"		=> 0,
			"posttest_id"		=> 0,
			"review_active"		=> 0,
			"pre_active"		=> 0,
			"post_active"		=> 0,
			"timelimit_pre"		=> "00:45:00",
			"timelimit_post"	=> "00:45:00"
		);

	$gmc->addGroupModule($values);
	$gm			= $gmc->getModuleGroupByID($groupid,$mid);
	endif;
	
	$sgc		= new StudentGroupController();
	$grp		= $sgc->getTargetGroup($groupid);
	$user_groups = $sgc->getUsersInGroup($groupid);
	
	//$gm			= $gmc->getModuleGroupByID($groupid,$mid);

	// echo '<pre>';
	// print_r($student_modules);
	// echo '</pre>';

	$smc = new StudentModuleController();
	$stdm = null;
	foreach($user_groups as $user_group)
	{
		$student_modules = $smc->loadStudentModuleByUser($user_group, $mid);
		// echo "<pre>";
		// print_r($student_modules);
		// echo "</pre>";
		
		foreach($student_modules as $student_module)
		{
			if($user_group == $student_module['user_ID'] && $mid == $student_module['module_ID'])
			{
				$stdm = 1;
			} else {
				$stdm = 0;
			}
		}
	}

	$mc			= new ModuleController();
	$module_set	= $mc->loadModule($mid);
	
	$dtc		= new DiagnosticTestController();
	$test_set	= $dtc->getAllModuleTestsByTeacher($mid, $userid);
	
	$pre = $dtc->getDiagnosticTest($mid, $userid, 1);
	
	if(!empty($gm)){
		$pre = $dtc->getDiagnosticTest($mid, $userid, 1);
		$pretl		= explode(":", $gm[0]['timelimit_pre']);
		$posttl		= explode(":", $gm[0]['timelimit_post']);
	}
	
	$pre_result = false;
	$post_result = false;
	
	foreach($test_set as $mode)
	{
		if($mode['mode'] == 1) $pre_result = true;
		if($mode['mode'] == 2) $post_result = true;
	}
?>
<div id="container">
<a class="link" href="settings.php?mid=<?php echo $mid; ?>">&laquo <?php echo _("Go Back"); ?></a>
<center>
	<h2><?php echo $grp[0]['group_name']; ?></h2><br>
	<span id="update" class="green"></span>
	<h2><?php echo _($module_set->getModule_name())." "._("Module"); ?></h2>
	<table border="0" class="result morepad">
		<tr>
			<th class="bold"><?php echo _("Status"); ?></th>
			<th class="bold"><?php echo _("Action"); ?></th>
		</tr>
		<tr>
			<td id="module-stat">
				<?php if($gm[0]['review_active'] == 1) : ?>
					<p class="text_active"><?php echo _("This module is active."); ?></p>
				<?php else : ?>
					<p class="text_active"><?php echo _("This module is not active."); ?></p> 
				<?php endif; ?>
			</td>
			<td>
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch1" class="onoffswitch-checkbox" id="myonoffswitch-module-review" value="module" <?php if($gm[0]['review_active']): ?> checked <?php endif; ?>>
					<label class="onoffswitch-label" for="myonoffswitch-module-review">
						<div class="onoffswitch-inner<?php echo $lang; ?>" ></div>
						<div class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
					</label>
				</div>
			</td>
		</tr>
	</table>
	<br>
	
	<h2><?php echo _("Diagnostic Tests"); ?></h2>
	<?php if($test_set) : ?>
		<table border="0" class="result morepad">
			<tr id="tr">
				<th id="dtests"><?php echo _("Test Type"); ?></th>
				<th><?php echo _("Test Name"); ?></th>
				<th><?php echo _("Time Limit"); ?></th>
				<th id="stat"><?php echo _("Status"); ?></th>
			</tr>
			<?php if($pre_result) : ?>
				<tr>
					<td>
						<?php echo _("Pre-Test"); ?>
					</td>
					<td>
						<select id="pretest">
							<?php
								foreach($test_set as $test):
									if($test['mode'] == 1):
										
							?>
									<option <?php if($gm[0]['pretest_id'] == $test['dt_id']): ?> selected <?php endif; ?> value="<?php echo $test['dt_id']; ?>">
										<?php echo $test['test_name']; ?>
									</option>
							<?php 
									endif;
								endforeach;
							?>
						</select>
					</td>
					<td>
						<select id="hours1">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
						<?php echo _("Hour/s and"); ?> 
						<select id="minutes1">
							<option>00</option>
							<option>05</option>
							<option>10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
							<option selected>45</option>
							<option>50</option>
							<option>55</option>
						</select>
						<?php echo _("Minutes"); ?>
					</td>
					<td>
						<div class="onoffswitch">
							<input type="checkbox" name="onoffswitch1" class="onoffswitch-checkbox" id="myonoffswitch-module-pre" value="module" <?php if($gm[0]['pre_active']): ?> checked <?php endif; ?>>
							<label class="onoffswitch-label" for="myonoffswitch-module-pre">
								<div class="onoffswitch-inner<?php echo $lang; ?>" ></div>
								<div class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
							</label>
						</div>
					</td>
				</tr>
			<?php else : ?>
				<tr>
					<!-- <td colspan="4"><center><a href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=pre&action=new" class="button1">Create Pre Diagnostic Test</a></center></td> -->
					<td colspan="4"><p class="ta-center"><?php echo _('You have not created any pre test.')?></p></td>
				</tr>
			<?php endif; ?>
			
			<?php if($post_result) : ?>
				<tr>
					<td>
						<?php echo _("Post-Test"); ?>
					</td>
					<td>
						<select id="posttest">
							<?php
								foreach($test_set as $test):
									if($test['mode'] == 2):
							?>
									<option <?php if($gm[0]['posttest_id'] == $test['dt_id']): ?> selected <?php endif; ?> value="<?php echo $test['dt_id']; ?>">
										<?php echo $test['test_name']; ?>
									</option>
							<?php 
									endif;
								endforeach;
							?>
						</select>
					</td>
					<td>
						<select id="hours2">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
						<?php echo _("Hour/s and"); ?> 
						<select id="minutes2">
							<option>00</option>
							<option>05</option>
							<option>10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
							<option selected>45</option>
							<option>50</option>
							<option>55</option>
						</select>
						<?php echo _("Minutes"); ?>
					</td>
					<td>
						<div class="onoffswitch">
							<input type="checkbox" name="onoffswitch1" class="onoffswitch-checkbox" id="myonoffswitch-module-post" value="module" <?php if($gm[0]['post_active']): ?> checked <?php endif; ?>>
							<label class="onoffswitch-label" for="myonoffswitch-module-post">
								<div class="onoffswitch-inner<?php echo $lang; ?>" ></div>
								<div class="onoffswitch-switch<?php if($language == 'ar_EG') { echo $lang; } ?>"></div>
							</label>
						</div>
					</td>
				</tr>
			<?php else : ?>
				<tr>
					<!-- <td colspan="4"><center><a href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=post&action=new" class="button1">Create Post Diagnostic Test</a></center></td> -->
					<td colspan="4"><p class="ta-center"><?php echo _('You have not created any post test.')?></p></td>
				</tr>
			<?php endif; ?>
		</table>
	<?php else : ?>
		<br/><br/>
		<!-- <a href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=pre&action=new" class="button1">Create Pretest</a>
		<a href="edit-dt.php?module_id=<?php echo $mid; ?>&mode=post&action=new" class="button1">Create Posttest</a> -->
		<p><?php echo _('You have not created any pre or post test.')?></p>
		<br/>
		<!-- <br/> -->
	<?php endif; ?>
	<br>
	<a class="button1" id="save"><?php echo _("Save Changes"); ?></a>
<center>
</div>
      <!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="tr" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Select a pre-diagnostic test and post-diagnostic test for this student group and set the time limit for each test. The default time limit is set at 45 minutes.</p>
		</li>
		<li data-id="stat" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>You can activate/deactivate the tests by clicking the ON/OFF switch.</p>
		</li>
		<li data-id="save" 		data-text="Close" data-options="tipLocation:top;tipAnimation:fade">
			<p>Click 'Save changes' to update your settings.</p>
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

$(document).ready(function() {
	
	$('#hours1').val('<?php echo ltrim($pretl[0], '0'); ?>');
	$('#hours2').val('<?php echo ltrim($posttl[0], '0'); ?>');
	$('#minutes1').val('<?php echo $pretl[1]; ?>');
	$('#minutes2').val('<?php echo $posttl[1]; ?>');	

	$('#myonoffswitch-module-pre').click(function(){

		<?php if($stdm == 1) { ?>
			var preact1	= ($('#myonoffswitch-module-pre').is(':checked')) ? 1 : 0;
			if(preact1 == 1){
				alert("<?php echo _('There are students who have already taken this module. You cannot activate a pre-test anymore.'); ?>");
				$('#myonoffswitch-module-pre').prop('checked', false);
				// var r = confirm("There are students who have already taken this module. You cannot activate a pre-test anymore");
				// if(r == true)
				// {
					// $('#myonoffswitch-module-pre').prop('checked', true);
				// } else {
					// $('#myonoffswitch-module-pre').prop('checked', false);
				// }
			} 
		<?php } ?>			
	});
	
	$('#myonoffswitch-module-review').click(function() {
		<?php  if($pre) : ?>
			var module	= ($('#myonoffswitch-module-review').is(':checked')) ? 1 : 0;
			if(module == 1){
				var r = confirm("<?php echo _('Once your students start the module, you won\'t be able to activate a pre-test. Please make sure that a pre-test is activated before they begin (pre-test is optional).'); ?>");
				if(r == true)
				{
					$('#myonoffswitch-module-review').prop('checked', true);
				} else {
					$('#myonoffswitch-module-review').prop('checked', false);
				}
			}
			
		<?php else : ?>
			var module	= ($('#myonoffswitch-module-review').is(':checked')) ? 1 : 0;
			if(module == 1){
				var r = confirm("<?php echo _('Once your students start the module, you won\'t be able to activate a pre-test. Please make sure that a pre-test is activated before they begin (pre-test is optional).'); ?>");
				if(r == true)
				{
					$('#myonoffswitch-module-review').prop('checked', true);
				} else {
					$('#myonoffswitch-module-review').prop('checked', false);
				}
			}
		<?php endif; ?>
	});
	
	$('#save').click(function() {
		var pre 	= $('#pretest option:selected').val();
		var post 	= $('#posttest option:selected').val();
		var preName 	= $('#pretest option:selected').text();
		var postName 	= $('#posttest option:selected').text();
		var review	= ($('#myonoffswitch-module-review').is(':checked')) ? 1 : 0;
		var preact	= ($('#myonoffswitch-module-pre').is(':checked')) ? 1 : 0;
		var postact	= ($('#myonoffswitch-module-post').is(':checked')) ? 1 : 0;
		
		var pret	= "0" + $('#hours1').val() + ":" + $('#minutes1').val() + ":" + "00";
		var postt	= "0" + $('#hours2').val() + ":" + $('#minutes2').val() + ":" + "00";
		
		$.ajax({
			type	: "POST",
			url		: "update-module-group.php?group_id=<?php echo $groupid; ?>&module_id=<?php echo $mid; ?>&pren="+preName+"&postn="+postName,
			data	: {	preid: pre, postid: post, ractive: review, preactive: preact, postactive: postact, pretl: pret, posttl: postt },
			success	: function(json) {
				if(json.error) return;
				  $(document).ajaxStop(function() { location.reload(true); });
				alert("<?php echo _('You have successfully updated this group.'); ?>");
			}
		});
		
	});
	
});
</script>
<?php require_once "footer.php"; ?>