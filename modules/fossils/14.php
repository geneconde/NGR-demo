<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(14, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'fossils-qq1-a');
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
<link rel="stylesheet" type="text/css" href="styles/hexaflip.css" />
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
.bg { background-image: url(images/19/bg.jpg); }

#question ul { list-style: none; padding: 0; width: 800px; margin: 0 auto; }
#question li { font-size: 24px; }

#box { text-align: center; margin-top: 0; }
#box .info { padding: 20px 0; color: #92578B; width: 600px; text-align: center; margin: 0 auto; }
#hexaflip { margin: 0 0 15px 330px; }
.hexaflip-cube .hexaflip-side { width: 101%; }

#answer { display: none; text-align: center; }
#answer p { text-align: center; }
#answer .answer img { margin-top: 10px; border-radius: 0 !important; }

.answer span { display: block; }
.feedback { font-size: 24px; text-align: center; }
.feedback img { vertical-align: middle; background: 0 !important; padding: 0 !important; margin-top: 0 !important; }

img.next-toggle { display: none; }

html[dir="rtl"] #hexaflip {margin: 0 auto;}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #1"); ?></h1>
				<h2><?php echo _("What do you call a person who studies fossils?"); ?></h2>

				<ul>						
					<li>A. <?php echo _("Archeologist"); ?></li>
					<li>B. <?php echo _("Paleontologist"); ?></li>
					<li>C. <?php echo _("Cosmetologist"); ?></li>
					<li>D. <?php echo _("Taxidermist"); ?></li>
				</ul>

				<div id="box">
					<p class="info"><?php echo _("Click, hold and slide your mouse up and down to rotate the box and select your answer."); ?></p>
					<div id="hexaflip"></div>
				</div>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				<p><?php echo _("You answered..."); ?></p>
				<p class="answer"></p>
				<div class="feedback center"></div>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="15.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Your first quiz question is..."); ?></strong></section></section>

	<script src="scripts/hexaflip.js"></script>

	<script>
	var hexa,
		images = [
			'./images/others/a.png',
			'./images/others/b.png',
			'./images/others/c.png',
			'./images/others/d.png'
		];

	hexa = new HexaFlip(document.getElementById('hexaflip'), { set: images }, { size: 180 });

	var back = $('img.back-toggle'),
	next = $('img.next-toggle'),
	check = $('img.check-toggle'),
	question = $('#question'),
	answer = $('#answer'),
	ans = '',
	checkAnswer = 0,
	answered = <?php echo $answered; ?>;

	function save() {
		var hexaValue = hexa.getValue();

		if (hexaValue == './images/others/a.png') {
			answer.find('.answer').html('<img src="images/others/a.png"><span><?php echo _("Archeologist"); ?></span>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite, archeologists study prehistoric human activity and their culture."); ?></p>');
			ans = 'A';
		}

		if (hexaValue == './images/others/b.png') {
			answer.find('.answer').html('<img src="images/others/b.png"><span><?php echo _("Paleontologist"); ?></span>');
			answer.find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct, a paleontologist studies fossils and the history of life."); ?></p>');
			ans = 'B';
		}

		if (hexaValue == './images/others/c.png') {
			answer.find('.answer').html('<img src="images/others/c.png"><span><?php echo _("Cosmetologist"); ?></span>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, a cosmetologist provides skincare and make-up."); ?></p>');
			ans = 'C';
		}

		if (hexaValue == './images/others/d.png') {
			answer.find('.answer').html('<img src="images/others/d.png"><span><?php echo _("Taxidermist"); ?></span>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, a taxidermist preserves dead animals for display."); ?></p>');
			ans = 'D';
		}

		if (answered == 0) {
			saveAnswer('fossils-qq1-a', ans);
		}
	}

	back.click(function() {
		if (question.is(':visible')) {
			document.location.href = "13.php";
		} else if (answer.is(':visible')) {
			next.fadeOut(function() { check.fadeIn(); });
			answer.fadeOut(function(){
				question.fadeIn();
				window.location.hash = '';
			}); 
		}
	});
	
	check.click(function() { 
		check.fadeOut(function() { next.fadeIn(); });
		question.fadeOut(function(){
			answer.fadeIn();
			save();
			window.location.hash = '#answer';
		}); 
	});
	</script>

	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
