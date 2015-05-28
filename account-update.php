<?php
	require_once 'session.php';	
	require_once 'locale.php';
	include_once 'header.php';
	require_once 'controller/Security.Controller.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/User.Controller.php';

	$sc = new SecurityController();
	$userID = $user->getUserid();
	$questions = $sc->getAllQuestions();
	$securityRecord = $sc->getSecurityRecord($userID);
	$lc = new LanguageController();
	$languages = $lc->getAllLanguages();
	$teacher_languages = $lc->getLanguageByTeacher($userID);
	$default_language = $lc->getDefaultLanguageByTeacher($userID);
	if(!isset($_GET['lang']) && !empty($default_language)){
		$langs = $lc->getLanguage($default_language[0]['language_id']);
		$lang = $langs->getLanguage_code();
		header("Location: account-update.php?lang=$lang");
	}
	if($type == 2){
		$tid = $user->getTeacher();
		$default_language = $lc->getDefaultLanguageByTeacher($tid);
		
		if(!isset($_GET['lang']) && !empty($default_language)){
			$langs = $lc->getLanguage($default_language[0]['language_id']);
			$lang = $langs->getLanguage_code();
			header("Location: account-update.php?lang=$lang");
		}
	}

	$answer = "";
	$questionID = "";
	if(sizeof($securityRecord) == 1){
		$questionID = $securityRecord[0]['question_id'];
		$answer = $securityRecord[0]['answer'];
	}

	$d_langId = 0;
	foreach ($teacher_languages as $lang) {
		if($lang['is_default'] == 1) {
			$d_langId = $lang['language_id'];
		}
	}
 ?>
 <div class='lgs-container'>
	<form action="save-account.php?ut=<?php echo $type; ?>&ret=lgs" method="post" id="edit-account">
		<div class="center">
 		<h1 class="lgs-text">Let's Get Started</h1>
		<p class="lgs-text-sub welcome">Welcome to NexGenReady! This page will help you in updating and setting up your account.</p>
		
		<?php if ($type == 0) { ?>
		<p class="lgs-text-sub heading-input step">Step 1: Your Account</p>
		<?php } ?>
		
		<p class="lgs-text-sub heading-input">Update Account</p>
		<p class="lgs-text-sub note">Please update your username and password so you can easily remember them.</p>
		<div class="left">
			<p class="input-label">Username</p>
			<p><input class="inputText" id="Username" name="username" type="text" maxlength="50" placeholder="Username" value="<?php echo $user->getUsername(); ?>" required/><img src="" id="check"></p></p>
		</div>
		<div class="right">
			<p class="input-label">Password</p>
			<p><input class="inputText" id="Password" name="password" type="password" maxlength="50" placeholder="Password" value="<?php echo $user->getPassword(); ?>" required/></p>
		</div>
		<p class="lgs-text-sub heading-input">About You</p>
		<?php if ($type == 2) { ?>
		<p class="lgs-text-sub note">Please enter your first name, last name, grade level and gender.</p>
		<?php } else { ?>
		<p class="lgs-text-sub note">Please enter your first name, last name and gender.</p>
		<?php } ?>
		<div class="left">
			<p class="input-label">First name</p>
			<p><input class="inputText" id="FirstName" name="fname" type="text" maxlength="50" placeholder="Enter your first name..." required value="<?php echo $user->getFirstname(); ?>"/></p>
		</div>
		<div class="right">
			<p class="input-label">Last name</p>
			<p><input class="inputText" id="LastName" name="lname" type="text" maxlength="50" placeholder="Enter your last name..." required value="<?php echo $user->getLastname(); ?>" /></p>
		</div>
		<?php if($type == 2 ){ ?>
		<div class="left">
			<p class="input-label grade">Grade level</p>
			<p><input class="inputText" id="Gradelevel" name="level" type="number" maxlength="2" placeholder="Enter your grade level..." value="<?php echo $user->getLevel(); ?>" required/></p>
		</div>		
		<?php } ?>
		<div class="clear"></div>
		<p class="input-label sup" id="gender">I am a...</p>
		<p class="radio"><input id="male" type="radio" name="gender" value="male" required <?php if($user->getGender() == "m"){ ?> checked <?php } ?>><label for="male"><?php echo _("Male"); ?></label></p>
		<p class="radio"><input id="female" type="radio" name="gender" value="female" <?php if($user->getGender() == "f") { ?> checked <?php } ?>><label for="female"><?php echo _("Female"); ?></label></p>

<?php if ($type != 2) : ?>
<!-- security -->
		<div class="s_question">
			<p class="input-label sup" id="squestion">Security Question:</p>
			<select name="squestion">
				<?php
				$i = 1;
				foreach ($questions as $question) { ?>
				   <option <?php if($questionID == $i) { ?> selected <?php } ?> value="<?php echo $question['question_id']; ?>"><?php echo $question["question"]; ?></option> 
				<?php $i++; } ?>
			</select>
			<p class="input-label sup" id="gender">Answer:</p>
			<input class="inputText" id="sanswer" name="sanswer" type="text" placeholder="Enter your answer..." value="<?php echo $answer; ?>" required/>
		</div>
<!-- end security -->
		<div class="clear"></div>
<!-- default language -->
		<div class="default-language">
			<p class="input-label sup" id="dlang">Default Language:</p>
			<select name="dlang">
				<?php
				$j = 1;
				foreach ($languages as $lang) { ?>
				   <option <?php if($d_langId == $j) { ?> selected <?php } ?> value="<?php echo $lang->getLanguage_id(); ?>"><?php echo $lang->getLanguage(); ?></option>
				<?php $j++; } ?>
			</select>
		</div>
<!-- end default language -->
<?php endif; ?>
		<input class="nbtn" type="submit" value="Next"/>
		</div>
	</form>
</div>
<script>
var olduname = "<?php echo $user->getUsername(); ?>";
$(document).ready(function() {
	// $('#edit').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',false);
	// 	$(this).hide();
	// 	$('.hidden-btn').show();
	// });
	
	// $('#cancel').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',true);
	// 	$('.hidden-btn').hide();
	// 	$('#edit').show();
	// });
	
	$('#Username').focusout(function() {
		var uid = $(this).val();
		if(uid != olduname) {
			$.ajax({
				type	: "POST",
				url		: "validate-user.php",
				data	: {	userid: uid },
				success : function(data) {
					if(data == 1) { 
						$('#check').attr('src','images/accept.png');
						$('#save').prop('disabled',false);
					} else { 
						$('#check').attr('src','images/error.png'); 
						$('#save').prop('disabled',true);
					}
				}
			});
		} else {
			$('#check').attr('src','images/accept.png');
			$('#save').prop('disabled',false);
		}
	});
});

$.validate({
  form : '#edit-account'
});
</script>
      <!-- Tip Content -->
    <ol id="joyRideTipContent">
		<li data-id="Username" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Update your <strong>username</strong> to something that you can easily remember. This is optional so you can leave it as it is if you prefer.</p>
		</li>
		<li data-id="Password" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Update your <strong>password</strong> to something that you can easily remember. This is optional so you can leave it as it is if you prefer.</p>
		</li>
		<li data-id="FirstName" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade;">
			<p>Enter in your first name</p>
		</li>
		<li data-id="LastName" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Enter in your last name</p>
		</li>
		<li data-id="Gradelevel" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Enter your <strong>grade level</strong>. This should be a number.</p>
		</li>
		<li data-id="gender" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Select your <strong>gender</strong>.</p>
		</li>
		<li data-id="squestion" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Choose a security question and enter in your answer for that question. This will be used to change your password if you forget it in the future.</p>
		</li>
		<li data-id="sanswer" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Enter the answer to your security question. This is case sensitive.</p>
		</li>
		<li data-id="dlang" 		data-text="Next" data-options="tipLocation:top;tipAnimation:fade">
			<p>Choose a language that you want to use for all modules and the dashboard interface.</p>
		</li>
		<li data-class="nbtn" 			data-text="Close" data-options="tipLocation:left;tipAnimation:fade;">
			<p>Click this button to save your changes and go to the next page.</p>
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