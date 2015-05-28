<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _('Fossils'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
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
.bg { background-image: url(images/16/bg.jpg); }

#question ol { list-style: none; padding: 0; margin: 15px 0 0 20px; }
#question li { padding: 8px 0; }
#question .ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
#question .ac-custom input[type="radio"] {}
#question .ac-custom input[type="radio"]:checked + label { color: #c45a63; }
#question .ac-custom svg { height: 42px; width: 38px; left: 1px; margin-top: -23px; }
#question .ac-custom svg path { stroke: #c45a63; }
#question .ac-custom label::before { background: #c45a63; height: 20px; width: 20px; margin-top: -12px;}

#answer { display: none; text-align: center; }
#answer p { text-align: center; }
#answer .answer img { margin-top: 10px; border: 2px solid #fff; }

.answer span { display: block; }
.feedback { font-size: 24px; text-align: center; }
.feedback img { vertical-align: middle; background: 0 !important; padding: 0 !important; margin-top: 0 !important; }

img.next-toggle { display: none; }

html[dir="rtl"] .ac-custom label { padding: 0 80px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"] { right: 35px; margin-top: -20px; }
html[dir="rtl"] .ac-custom label::before { right: 36px; margin-top: -20px; }
html[dir="rtl"] .ac-custom svg { right: 27px; margin-top: -13px; }
html[dir="rtl"] li label { text-align: right; }

</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #3"); ?></h1>
				<h2><?php echo _("The presence of an animal fossil in a rock gives evidence of..."); ?></h2>

				<form class="ac-custom ac-radio ac-circle" autocomplete="off">
					<ol>
						<li><input id="a" type="radio" name="q"><label for="a"><?php echo _("What other animals hunted the animal in the fossil"); ?></label></li>
						<li><input id="b" type="radio" name="q"><label for="b"><?php echo _("Total number of babies the animal had given birth to"); ?></label></li>
						<li><input id="c" type="radio" name="q"><label for="c"><?php echo _("The date the animal was born"); ?></label></li>
						<li><input id="d" type="radio" name="q"><label for="d"><?php echo _("The time period in which the animal lived"); ?></label></li>
					</ol>
				</form>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #3"); ?> - <?php echo _("How did I do?"); ?></h1>
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
		<a href="17.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Excavating sedimentary rocks..."); ?></strong></section></section>

	<script>
	var back = $('img.back-toggle'),
	next = $('img.next-toggle'),
	check = $('img.check-toggle'),
	question = $('#question'),
	answer = $('#answer'),
	ans = '',
	checkAnswer = 0,
	answered = 1;

	question.find('input[type=radio]').on('click', function() {
		var radio = $(this);

		if (radio.attr('id') == 'a') {
			answer.find('.answer').html('<?php echo _("What other animals hunted the animal in the fossil"); ?>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, the fossil will not show what animal hunted it."); ?></p>');
			ans = 'A';
		}

		if (radio.attr('id') == 'b') {
			answer.find('.answer').html('<?php echo _("Total number of babies the animal had given birth to"); ?>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, the fossil will not show the total number of babies it had given birth to even if some baby fossils were found with it. Can you think why?"); ?></p>');
			ans = 'B';
		}

		if (radio.attr('id') == 'c') {
			answer.find('.answer').html('<?php echo _("The date the animal was born"); ?>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, the animal fossil can show the time period when it was born, but not an exact date."); ?></p>');
			ans = 'C';
		}

		if (radio.attr('id') == 'd') {
			answer.find('.answer').html('<?php echo _("The time period in which the animal lived"); ?>');
			answer.find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct, a plant or animal fossil in a rock can help paleontologists determine the general geological time period it might have lived in because the age of the rock can usually be approximately determined."); ?></p>');
			ans = 'D';
		}
	});

	function save() {
		if (answered == 0) {
			saveAnswer('fossils-qq3-a', ans);
		}
	}

	back.click(function() {
		if (question.is(':visible')) {
			document.location.href = "15.php";
		} else if (answer.is(':visible')) {
			next.fadeOut(function() { check.fadeIn(); });
			answer.fadeOut(function(){
				question.fadeIn();
				window.location.hash = '';
			}); 
		}
	});
	
	check.click(function() { 
		checkAnswer = $('input:radio:checked').length;

		if (checkAnswer == 0) {
			alert('<?php echo _("Please select your answer."); ?>');
		} else {
			check.fadeOut(function() { next.fadeIn(); });
			question.fadeOut(function(){
				answer.fadeIn();
				save();
				window.location.hash = '#answer';
			}); 
		}
	});
	</script>

	<script src="scripts/svgcheckbx.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
