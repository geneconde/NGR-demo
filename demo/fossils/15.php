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
h2 span { display: inline !important; }
.wrap { border-color: #96927c; }
.bg { background-image: url(images/15/bg.jpg); }

#question ul { margin: 20px auto 0; padding-left: 0; list-style: none; width: 536px; }
#question li { font-size: 24px; text-align: center; float: left; margin: 0 80px 30px 0; }
#question li:nth-child(2) { margin-right: 0; }
#question li:nth-child(4) { margin-right: 0; }
#question img { display: block; width: 220px; border-radius: 5px !important; }
#question span { text-align: center; padding-top: 5px; width: 220px; display: block; }
#question label { cursor: pointer; }
#question input[type=radio] { display: none; }

span.checked { color: #c45a63; -webkit-transition: all .3s ease; }
span.unchecked { color: #000; -webkit-transition: all .3s ease; }
img.grayscale { border: 4px solid #dbd2aa; -webkit-transition: all .3s ease; /* Fade to color for Chrome and Safari */ -webkit-backface-visibility: hidden; /* Fix for transition flickering */ }
img.grayscale-off { border: 4px solid #c45a63; -webkit-transition: all .3s ease; /* Fade to color for Chrome and Safari */ }

#answer { display: none; text-align: center; }
#answer p { text-align: center; }
#answer .answer img { margin-top: 10px; }

.answer span { display: block; }
.answer img { border-radius: 5px; border: 4px solid #dbd2aa; }
.feedback { font-size: 24px; text-align: center; }
.feedback img { vertical-align: middle; background: 0 !important; padding: 0 !important; margin-top: 0 !important; }

img.next-toggle { display: none; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #2"); ?></h1>
				<h2><?php echo _("Which of the following is <span class='blink'>not</span> an example of a trace fossil?"); ?></h2>

				<ul class="clear">
					<li><label for="a"><img class="grayscale" src="images/15/a.jpg"></label><input type="radio" id="a" name="q"><span><?php echo _("Footprint"); ?></span></li>
					<li><label for="b"><img class="grayscale" src="images/15/b.jpg"></label><input type="radio" id="b" name="q"><span><?php echo _("Fossilized poop"); ?></span></li>
					<li><label for="c"><img class="grayscale" src="images/15/c.jpg"></label><input type="radio" id="c" name="q"><span><?php echo _("Fossilized skull"); ?></span></li>
					<li><label for="d"><img class="grayscale" src="images/15/d.jpg"></label><input type="radio" id="d" name="q"><span><?php echo _("Claw marks"); ?></span></li>
				</ul>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #2"); ?> - <?php echo _("How did I do?"); ?></h1>
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
		<a href="16.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Know more about trace fossil..."); ?></strong></section></section>

	<script>
	var back = $('img.back-toggle'),
	next = $('img.next-toggle'),
	check = $('img.check-toggle'),
	question = $('#question'),
	answer = $('#answer'),
	ans = '',
	checkAnswer = 0,
	answered = 1,
	a = $('#a'),
	b = $('#b'),
	c = $('#c'),
	d = $('#d');

	a.on('click', function() {
		$(this).parent().find('img').removeClass().addClass('grayscale-off');
		$(this).parent().find('span').removeClass().addClass('checked');

		b.parent().find('img').removeClass().addClass('grayscale');
		b.parent().find('span').removeClass().addClass('unchecked');

		c.parent().find('img').removeClass().addClass('grayscale');
		c.parent().find('span').removeClass().addClass('unchecked');

		d.parent().find('img').removeClass().addClass('grayscale');
		d.parent().find('span').removeClass().addClass('unchecked');

		answer.find('.answer').html('<img src="images/15/a.jpg"><span><?php echo _("Footprint"); ?></span>');
		answer.find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("No, a footprint is a trace fossil, evidence of the organism's activity."); ?></p>");
		ans = 'A';
	});

	b.on('click', function() {
		$(this).parent().find('img').removeClass().addClass('grayscale-off');
		$(this).parent().find('span').removeClass().addClass('checked');

		a.parent().find('img').removeClass().addClass('grayscale');
		a.parent().find('span').removeClass().addClass('unchecked');

		c.parent().find('img').removeClass().addClass('grayscale');
		c.parent().find('span').removeClass().addClass('unchecked');

		d.parent().find('img').removeClass().addClass('grayscale');
		d.parent().find('span').removeClass().addClass('unchecked');

		answer.find('.answer').html('<img src="images/15/b.jpg"><span><?php echo _("Fossilized poop"); ?></span>');
		answer.find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("No, fossilized poop is a trace fossil, evidence of the organism's activity."); ?></p>");
		ans = 'B';
	});

	c.on('click', function() {
		$(this).parent().find('img').removeClass().addClass('grayscale-off');
		$(this).parent().find('span').removeClass().addClass('checked');

		a.parent().find('img').removeClass().addClass('grayscale');
		a.parent().find('span').removeClass().addClass('unchecked');

		b.parent().find('img').removeClass().addClass('grayscale');
		b.parent().find('span').removeClass().addClass('unchecked');

		d.parent().find('img').removeClass().addClass('grayscale');
		d.parent().find('span').removeClass().addClass('unchecked');

		answer.find('.answer').html('<img src="images/15/c.jpg"><span><?php echo _("Fossilized skull"); ?></span>');
		answer.find('.feedback').html("<p class='green'><img src='images/others/correct.png'><?php echo _("Correct, a skull is part of the organism's body, not evidence of their activity."); ?></p>");
		ans = 'C';
	});

	d.on('click', function() {
		$(this).parent().find('img').removeClass().addClass('grayscale-off');
		$(this).parent().find('span').removeClass().addClass('checked');

		a.parent().find('img').removeClass().addClass('grayscale');
		a.parent().find('span').removeClass().addClass('unchecked');

		b.parent().find('img').removeClass().addClass('grayscale');
		b.parent().find('span').removeClass().addClass('unchecked');

		c.parent().find('img').removeClass().addClass('grayscale');
		c.parent().find('span').removeClass().addClass('unchecked');

		answer.find('.answer').html('<img src="images/15/d.jpg"><span><?php echo _("Claw marks"); ?></span>');
		answer.find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("No, claw marks are a trace fossil, evidence of the organism's activity."); ?></p>");
		ans = 'D';
	});

	function save() {
		if (answered == 0) {
			saveAnswer('fossils-qq2-a', ans);
		}
	}

	back.click(function() {
		if (question.is(':visible')) {
			document.location.href = "14.php";
		} else if (answer.is(':visible')) {
			next.fadeOut(function() { check.fadeIn(); });
			answer.fadeOut(function(){
				question.fadeIn();
				window.location.hash = '';
			}); 
		}
	});
	
	check.click(function() { 
		checkAnswer = $('.grayscale-off').length;

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

	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
