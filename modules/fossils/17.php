<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(17, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'fossils-qq4-a');
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
.bg { background-image: url(images/17/bg.jpg); }

#question li { padding: 10px 0; }

.ac-custom { width: 100%; padding: 0 !important; }
.ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
.ac-custom input[type="checkbox"] { vertical-align: top; margin-top: -10px; }
.ac-custom input[type="checkbox"]:checked + label { color: #c45a63; }
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
				<h1><?php echo _("Quiz Question #4"); ?></h1>
				<h2><?php echo _("Select <span class='blink'>all</span> the <span class='blink'>correct</span> statements about the fossil record."); ?></h2>

				<section>
					<form class="ac-custom ac-checkbox ac-diagonal" autocomplete="off">
						<ol>
							<li><input id="a" name="q" type="checkbox"><label for="a"><span><?php echo _("A list of the oldest fossilized specimens that have been found for each species."); ?></span></label></li>
							<li><input id="b" name="q" type="checkbox"><label for="b"><span><?php echo _("A database of all the species that have ever existed."); ?></span></label></li>
							<li><input id="c" name="q" type="checkbox"><label for="c"><span><?php echo _("A database of all the fossils that have ever been found and reported."); ?></span></label></li>
							<li><input id="d" name="q" type="checkbox"><label for="d"><span><?php echo _("What scientists study to learn about the history of the earth."); ?></span></label></li>
							<li><input id="e" name="q" type="checkbox"><label for="e"><span><?php echo _("Evidence that life has existed in different forms and changed over geological time."); ?></span></label></li>
						<ol>
					</form>
				</section>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #4"); ?> - <?php echo _("How did I do?"); ?></h1>
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
		<a href="18.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Keeping fossil records..."); ?></strong></section></section>

	<script>
	var back = $('img.back-toggle'),
	next = $('img.next-toggle'),
	check = $('img.check-toggle'),
	question = $('#question'),
	answer = $('#answer'),
	ans = '',
	checkAnswer = 0,
	answered = <?php echo $answered; ?>;

	$('#question').find('input[type=checkbox]').on('click', function() {
		var me = $(this);

		if (me.is(':checked') && me.attr('id') == 'a') {
			$('#answer').find('.answer').append('<p class="a"><?php echo _("A list of the oldest fossilized specimens that have been found for each species."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'a') {
			$('#answer').find('.answer').find('p.a').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'b') {
			$('#answer').find('.answer').append('<p class="b"><?php echo _("A database of all the species that have ever existed."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'b') {
			$('#answer').find('.answer').find('p.b').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'c') {
			$('#answer').find('.answer').append('<p class="c"><?php echo _("A database of all the fossils that have ever been found and reported."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'c') {
			$('#answer').find('.answer').find('p.c').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'd') {
			$('#answer').find('.answer').append('<p class="d"><?php echo _("What scientists study to learn about the history of the earth."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'd') {
			$('#answer').find('.answer').find('p.d').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'e') {
			$('#answer').find('.answer').append('<p class="e"><?php echo _("Evidence that life has existed in different forms and changed over geological time."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'e') {
			$('#answer').find('.answer').find('p.e').remove(); 
		}

		if ($('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == true && $('#d').is(':checked') == true && $('#e').is(':checked') == true) {
			$('#answer').find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct! The fossil record is a database of all the fossils that have been found, not all the ones that have ever existed. By studying the fossil record, scientists learn about the history of the earth and how life has changed over geological time."); ?></p>');
		} else if ($('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == true && $('#d').is(':checked') == true && $('#e').is(':checked') == false || $('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == true && $('#d').is(':checked') == false && $('#e').is(':checked') == true || $('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == false && $('#d').is(':checked') == true && $('#e').is(':checked') == true) {
 			$('#answer').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite, the answer you gave is TRUE - but there are more true statements that you can check in addition."); ?></p>');
 		} else if ($('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == true && $('#d').is(':checked') == false && $('#e').is(':checked') == false || $('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == false && $('#d').is(':checked') == true && $('#e').is(':checked') == false || $('#a').is(':checked') == false && $('#b').is(':checked') == false && $('#c').is(':checked') == false && $('#d').is(':checked') == false && $('#e').is(':checked') == true) {
 			$('#answer').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite, the answer you gave is TRUE - but there are more true statements that you can check in addition."); ?></p>');
		} else {
			$('#answer').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite, a fossil record is a database of all the fossils that have been found, not all the ones that have ever existed. By studying the fossil record, scientists learn about the history of the earth."); ?></p>'); 
		}
	});

	function save() {
		if($('#a').is(':checked')) { ans += 'A'; }
		if($('#b').is(':checked')) { ans += 'B'; }
		if($('#c').is(':checked')) { ans += 'C'; }
		if($('#d').is(':checked')) { ans += 'D'; }
		if($('#e').is(':checked')) { ans += 'E'; }

		if (answered == 0) {
			saveAnswer('fossils-qq4-a', ans);
		}
	}

	back.click(function() {
		if (question.is(':visible')) {
			document.location.href = "16.php";
		} else if (answer.is(':visible')) {
			next.fadeOut(function() { check.fadeIn(); });
			answer.fadeOut(function(){
				question.fadeIn();
				ans = '';
				window.location.hash = '';
			}); 
		}
	});
	
	check.click(function() { 
		checkAnswer = $('input:checkbox:checked').length;

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
