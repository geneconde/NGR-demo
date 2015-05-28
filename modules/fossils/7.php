<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(7, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'fossils-qc2-a');
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
.bg { background-image: url(images/7/bg.jpg); }

#questions li { padding: 6px 0; }

#question1 .ac-custom { width: 100%; padding: 0 !important; }
#question1 .ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
#question1 .ac-custom input[type="checkbox"] { vertical-align: top; margin-top: -10px; }
#question1 .ac-custom input[type="checkbox"]:checked + label { color: #c45a63; }
#question1 .ac-custom svg { height: 20px; width: 30px; left: 3px; margin-top: -10px; }
#question1 .ac-custom label::before { border: 2px solid #c45a63; }
#question1 .ac-custom svg path { stroke: #c45a63; }
#question1 .ac-custom label::before { height: 35px; width: 35px; margin-top: -18px;}

#question2 .ac-custom { width: 100%; }
#question2 .ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
#question2 .ac-custom input[type="radio"] { vertical-align: top; margin-top: -10px; }
#question2 .ac-custom input[type="radio"]:checked + label { color: #c45a63; }
#question2 .ac-custom svg { height: 20px; width: 30px; left: 3px; margin-top: -10px; }
#question2 .ac-custom label::before { border: 2px solid #c45a63; }
#question2 .ac-custom svg path { stroke: #c45a63; }
#question2 .ac-custom label::before { height: 35px; width: 35px; margin-top: -18px;}

#answers { display: none; }
#answers p { text-align: center; font-size: 22px; }

#question2, #answer2 { margin-top: 25px; }
img.next-toggle { display: none; }
<?php if($language == "es_ES") { ?>
	#answers p { font-size: 20px; }
<?php } ?>

html[dir="rtl"] .ac-custom label { padding: 0 80px 0 0; }
html[dir="rtl"] .ac-custom input[type="radio"] { right: 35px; margin-top: -20px; }
html[dir="rtl"] .ac-custom label::before { right: 26px; margin-top: -30px; }
html[dir="rtl"] .ac-custom svg { right: 27px; margin-top: -23px; }
html[dir="rtl"] li label { text-align: right; }

</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #2"); ?></h1>

				<div id="question1" class="clear">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the ways finding and studying fossils help."); ?></h2>	

					<section>
						<form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
							<ol>
								<li><input id="a1" name="q1" type="checkbox"><label for="a1"><span><?php echo _("Add information to the fossil record"); ?></span></label></li>
								<li><input id="b1" name="q1" type="checkbox"><label for="b1"><span><?php echo _("Learn about changes in the Earth's climate and geography"); ?></span></label></li>
								<li><input id="c1" name="q1" type="checkbox"><label for="c1"><span><?php echo _("Connect species of today to their ancestors"); ?></span></label></li>
								<li><input id="d1" name="q1" type="checkbox"><label for="d1"><span><?php echo _("Identify good places to build cities"); ?></span></label></li>
							<ol>
						</form>
					</section>
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. Click on the correct statement describing the fossil record."); ?></h2>	
 
					<section>
						<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
							<ol>
								<li><input id="a2" name="q2" type="radio"><label for="a2"><span><?php echo _("Provides clues to earth's history"); ?></span></label></li>
								<li><input id="b2" name="q2" type="radio"><label for="b2"><span><?php echo _("Is fully complete"); ?></span></label></li>
								<li><input id="c2" name="q2" type="radio"><label for="c2"><span><?php echo _("Reveals major periods of extinction"); ?></span></label></li>
								<li><input id="d2" name="q2" type="radio"><label for="d2"><span><?php echo _("A and C"); ?></span></label></li>
							<ol>
						</form>
					</section>
	 			</div>
			</div>

			<div id="answers">
				<h1><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?"); ?></h1>

				<div id="answer1">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the ways finding and studying fossils help."); ?></h2>	
					<p><?php echo _("You answered..."); ?></p>
					<div class="answer"></div>
					<div class="feedback"></div>
				</div>					

				<div id="answer2">
					<h2><?php echo _("Question B. Click on the correct statement describing the fossil record."); ?></h2>	
					<p><?php echo _("You answered..."); ?></p>
					<div class="answer"></div>
					<div class="feedback"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="8.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Verifying collected data..."); ?></strong></section></section>

	<script>
	var ans1, ans2, answered = <?php echo $answered; ?>, checkAnswer = 0;

	$('#question1').find('input[type=checkbox]').on('click', function() {
		var me = $(this);

		if (me.is(':checked') && me.attr('id') == 'a1') {
			$('#answer1').find('.answer').append('<p class="a"><?php echo _("Add information to the fossil record"); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'a1') {
			$('#answer1').find('.answer').find('p.a').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'b1') {
			$('#answer1').find('.answer').append("<p class='b'><?php echo _("Learn about changes in the Earth's climate and geography"); ?></p>");
		} else if ( ! me.is(':checked') && me.attr('id') == 'b1') {
			$('#answer1').find('.answer').find('p.b').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'c1') {
			$('#answer1').find('.answer').append('<p class="c"><?php echo _("Connect species of today to their ancestors"); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'c1') {
			$('#answer1').find('.answer').find('p.c').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'd1') {
			$('#answer1').find('.answer').append('<p class="d"><?php echo _("Identify good places to build cities"); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'd1') {
			$('#answer1').find('.answer').find('p.d').remove(); 
		}

 		if ($('#a1').is(':checked') == true) {
 			ans1 = 'A';
		}
 		if ($('#b1').is(':checked') == true) {
 			ans1 += 'B';
		}
 		if ($('#c1').is(':checked') == true) {
 			ans1 += 'C';
		}
 		if ($('#d1').is(':checked') == true) {
 			ans1 += 'D';
		}
		if ($('#a1').is(':checked') == true && $('#b1').is(':checked') == true && $('#c1').is(':checked') == true && $('#d1').is(':checked') == true) {
			$('#answer1').find('.feedback').html("<p class='green'><img src='images/others/correct.png'><?php echo _("Correct! Fossils help scientists fill in the fossil record, learn about changes in the Earth's climate, geography and other things, and figure out how plants and animals from today and plants and animals from long ago are connected and they can even help engineers and architects decide the best places to build cities because fossils tell things about the earth below."); ?> </p>");
			ans1 = 'ABCD';
		} else {
			$('#answer1').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("Not quite. Fossils help scientists fill in the fossil record, learn about changes in the Earth's climate, geography and other things, and figure out how plants and animals of today are connected with plants and animals of long ago. They can even help engineers and architects decide the best places to build cities, because fossils tell things about the earth below."); ?></p>"); 
		}
	});

	$('#question2').find('input[type=radio]').on('click', function() {
		var me = $(this).attr('id');

		if (me == 'a2') {
			$('#answer2').find('.answer').html("<p><?php echo _("Provides clues to earth's history"); ?></p>");
			$('#answer2').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("Not quite. The fossil record does provide clues to the earth's history, but what else does the fossil record do?"); ?></p>");
			ans2 = 'A';
		}

		if (me == 'b2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Is fully complete"); ?></p>');
			$('#answer2').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, scientists are always discovering more fossils; the fossil record is not complete."); ?></p>');
			ans2 = 'B';
		}

		if (me == 'c2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Reveals major periods of extinction"); ?></p>');
			$('#answer2').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite. The fossil record does reveal major periods of extinction, but what else does the fossil record do?"); ?></p>');
			ans2 = 'C';
		}

		if (me == 'd2') {
			$('#answer2').find('.answer').html('<p><?php echo _("A and C"); ?></p>');
			$('#answer2').find('.feedback').html("<p class='green'><img src='images/others/correct.png'><?php echo _("Correct, the fossil record reveals major periods of extinction and provides clues to the Earth's history as well."); ?></p>");
			ans2 = 'D';
		}
	});

	$('img.check-toggle').click(function(){ 
		if ($('input:radio:checked').length == 0 || $('input:checkbox:checked').length == 0) {
			checkAnswer = 1;
		} else {
			checkAnswer = 0;
		}

		if (checkAnswer == 1) {
			alert('<?php echo _("Please select your answers."); ?>');
		} else {
			$('img.check-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
			$('#questions').fadeOut(function(){ 
				$('#answers').fadeIn();
				save();
				window.location.hash = '#answer';
			}); 
		}
	});

	function save() {
		if (answered == 0) {
			saveAnswer('fossils-qc2-a', ans1);
			saveAnswer('fossils-qc2-b', ans2);
		}
	}

	$('img.back-toggle').click(function() {
		if ($('#questions').is(':visible')) {
			document.location.href = "6.php#screen2";
		} else if ($('#answers').is(':visible')) {
			$('img.next-toggle').fadeOut(function() { $('img.check-toggle').fadeIn(); });
			$('#answers').fadeOut(function() {
				$('#questions').fadeIn();
				window.location.hash = '';
			});
		}
	});
	</script>

	<script src="scripts/svgcheckbx.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
