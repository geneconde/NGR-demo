<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';

	$uc = new UserController();
	$userid = $user->getUserid();
	$uc->updateUserFL($userid);
?>
<style>
	#dbguide { display: none; }
	.tguide { float: none !important; }
</style>
<div class='lgs-container'>
 	<div class="center">
 		<h1 class="lgs-text">You're done!</h1>
		<p class="lgs-text-sub note">Thank you for your patience in setting up your account.</p>
		<p class="lgs-text-sub note">Click the button below to go to your Dashboard, and use the GUIDE ME button (<button class="uppercase guide tguide">Guide Me</button>) at the top left of the Dashboard to walk you through all the features our online library has to offer.</p><br>
		<a href="teacher.php?ft=1" class="dashboard">GO TO DASHBOARD</a>
	</div>
</div>
<?php include "footer.php"; ?>