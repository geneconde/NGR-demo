<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(9, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'fossils-qc3-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
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
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
h1 { color: #96927c; }
.wrap { border-color: #96927c; }
.bg { background-image: url(images/9/bg.jpg); }

#question1 ul { margin: 20px auto 0; width: 800px; list-style: none; padding: 0; }
#question1 li { float: left; width: 180px; margin-right: 26px; }
#question1 li:last-child { margin-right: 0; }
#question1 input[type=checkbox] { display: none; }
#question1 label { font-size: 24px; display: block; text-align: center; cursor: pointer; width: 180px; }
#question1 input[type=checkbox] + label img { border: 4px solid #dbd2aa; -webkit-transition: all .3s ease; border-radius: 5px !important; width: 180px; }
#question1 input[type=checkbox]:checked + label img {-webkit-transition: all .3s ease; border: 4px solid #c45a63; -webkit-backface-visibility: hidden; }
#question1 input[type=checkbox] + label span { color: #000; -webkit-transition: all .3s ease; }
#question1 input[type=checkbox]:checked + label span { color: #000; -webkit-transition: all .3s ease; color: #c45a63; -webkit-backface-visibility: hidden;  ;}
#question1 input[type=checkbox] + label { -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
#question1 input[type=checkbox]:checked + label {}

#question2 ol { list-style: none; padding: 0; margin: 15px 0 0 20px; }
#question2 li { padding: 6px 0; }
#question2 .ac-custom { width: 100%; }
#question2 .ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
#question2 .ac-custom input[type="radio"] {}
#question2 .ac-custom input[type="radio"]:checked + label { color: #c45a63; }
#question2 .ac-custom sv