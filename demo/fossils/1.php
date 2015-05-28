<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) $smc->updateStudentLastscreen(1, $_SESSION['smid']);

?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _('Fossils'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
html, body { overflow: hidden; }
h1 { color: #8B8350; padding: 20px 0 0; text-align: center; }
.wrap { border-color: #beb482; }
.bg { background-image: url('images/1/bg.jpg'); }

#start { position: absolute; top: 460px; left: 345px; width: 187px; height: 203px; display: block; padding: 85px 0 0 36px; font-size: 34px; color: #8B8350; background: url('images/1/start.png') top left no-repeat; } 

@-webkit-keyframes pulse { 25% { -webkit-transform: scale(1.1); transform: scale(1.1); } 75% { -webkit-transform: scale(0.9); transform: scale(0.9); } }
@keyframes pulse { 25% { -webkit-transform: scale(1.1); transform: scale(1.1); } 75% { -webkit-transform: scale(0.9); transform: scale(0.9); } }

.pulse { display: inline-block; -webkit-transform: translateZ(0); transform: translateZ(0); box-shadow: 0 0 1px rgba(0, 0, 0, 0); }
.pulse:hover, .pulse:focus, .pulse:active { -webkit-animation-name: pulse; animation-name: pulse; -webkit-animation-duration: 1s; animation-duration: 1s; -webkit-animation-timing-function: linear; animation-timing-function: linear; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite; }

html[dir="rtl"] h1, html[dir="rtl"] #start { text-align: center; }
html[dir="rtl"] #start {padding: 85px 19px 0 26px;width: 147px;top: 445px; }

</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _("Welcome to the Fossils module, "); echo $user->getFirstName(); ?>!</h1>
				<a href="2.php" id="start" class="pulse"><?php echo _('Start'); ?></a>
			</div>				
		</div>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Let's begin!"); ?></strong></section></section>

	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
