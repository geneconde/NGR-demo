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
.bg { background-image: url(images/19/bg.jpg); }

#question li { padding: 8px 0; }

.ac-custom { width: 100%; padding: 0 !important; }
.ac-custom label { color: #000; padding-left: 50px; font-size: 24px; }
.ac-custom input[type="radio"] { vertical-align: top; margin-top: -10px; }
.ac-custom input[type="radio"]:checked + label { color: #c45a63; }
.ac-custom svg { height: 20px; width: 30px; left: 3px; margin-top: -10px; }
.ac-custom label::before { border: 2px solid #c45a63; }
.ac-custom svg path { stroke: #c45a63; }
.ac-custom label::before { height: 35px; width: 35px; margin-top: -18px;}

#answer { display: none; text-align: center; }
#answer p { text-align: center; }
#answer .answer img { margin-top: 10px; border: 2px solid #fff; }

.answer span { display: block; }
.feedback { font-size: 24px; text-align: center; }
.feedback img { vertical-align: middle; background: 0 !important; padding: 0 !important; margin-top: 0 !important; }

img.next-toggle { display: none; }

html[dir="rtl"] .ac-custom label { padding: 0 80px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"] { right: 35px; margin-top: -20px; }
html[dir="rtl"] .ac-custom label::before { right: 26px; margin-top: -20px; }
html[dir="rtl"] .ac-custom svg { right: 27px; margin-top: -13px; }
html[dir="rtl"] li label { text-align: right; }

</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #6"); ?></h1>
				<h2><?php echo _("Which of the following is <span class='blink'>not</span> something that scientists could learn by studying fossil records?"); ?></h2>

				<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
					<ul>
						<li><input id="a" type="radio" name="q"><label for="a"><?php echo _("The climate of Location 'X' was very hot and dry at some time in the geological past."); ?></label></li>
						<li><input id="b" type="radio" name="q"><label for="b"><?php echo _("Location 'X' was covered by water at one point in Earth's history."); ?></label></li>
						<li><input id="c" type="radio" name="q"><label for="c"><?php echo _("A certain species of flowering plant produced yellow flowers."); ?></label></li>
						<li><input id="d" type="radio" name="q"><label for="d"><?php echo _("A certain species of plant became extinct about 60 million years ago."); ?></label></li>
					</ul>
				</form>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #6"); ?> - <?php echo _("How did I do?"); ?></h1>
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
		<a href="20.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for your last quiz question?"); ?></strong></section></section>

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
			answer.find('.answer').html("<?php echo _("The climate of Location 'X' was very hot and dry at some time in the geological past."); ?>");
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, scientists can determine things about the climate of an area a long time ago from fossils."); ?></p>');
			ans = 'A';
		}

		if (radio.attr('id') == 'b') {
			answer.find('.answer').html("<?php echo _("Location 'X' was covered by water at one point in Earth's history."); ?>");
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, scientists can get an idea of the amount of water an area had a long time ago."); ?></p>');
			ans = 'B';
		}

		if (radio.attr('id') == 'c') {
			answer.find('.answer').html('<?php echo _("A certain species of flowering plant produced yellow flowers."); ?>');
			answer.find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct, scientists cannot identify the color of a flower that existed a long time ago because colors would likely change in the fossilization process."); ?></p>');
			ans = 'C';
		}

		if (radio.attr('id') == 'd') {
			answer.find('.answer').html('<?php echo _("A certain species of plant became extinct about 60 million years ago."); ?>');
			answer.find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, scientists can estimate when a plant became extinct by studying the fossil record."); ?></p>');
			ans = 'D';
		}
	});

	function save() {
		if (answered == 0) {
			saveAnswer('fossils-qq6-a', ans);
		}
	}

	back.click(function() {
		if (question.is(':visible')) {
			document.location.href = "18.php";
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
