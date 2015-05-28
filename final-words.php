<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';

	$uc = new UserController();
	$userid = $user->getUserid();
	$uc->updateUserFL($userid);
?>
<style>#dbguide { display: none; }</style>
<div class='lgs-container'>
 	<div class="center">
 		<h1 class="lgs-text">You're done!</h1>
		<p class="lgs-text-sub note">Thank you for your patience in setting up your account. Your students can now log into their account and start the pre-diagnostic test (if you created one) and the module/s you activated.</p>
		<p class="lgs-text-sub note">Click the button below to go to your Dashboard.</p><br>
		<a href="teacher.php?ft=1" class="dashboard">GO TO DASHBOARD</a>
	</div>
</div>
<?php include "footer.php"; ?>