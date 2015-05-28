<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) $smc->updateStudentLastscreen(3, $_SESSION['smid']);
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
<link rel="stylesheet" type="text/css" href="styles/nlform.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/nlform.js"></script>
<style>
h1 { color: #96927c; }
.wrap { border-color: #96927c; }
.bg { background-image: url(images/3/bg.jpg); }

#question ol { margin: 0 0 0 30px; padding: 0; }
#question li { padding: 10px 0; }
#question h2:last-of-type { margin-top: 20px; }
#question .ac-custom { width: 100%; }
#question .ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
#question .ac-custom input[type="radio"] { vertical-align: top; margin-top: -10px; }
#question .ac-custom input[type="radio"]:checked + label { color: #c45a63; }
#question .ac-custom svg { height: 20px; width: 30px; left: 3px; margin-top: -10px; }
#question .ac-custom label::before { border: 2px solid #c45a63; }
#question .ac-custom svg path { stroke: #c45a63; }
#question .ac-custom label::before { height: 35px; width: 35px; margin-top: -18px;}

#nl-form { margin-left: 30px; }
#nl-form a { border-bottom: 0; background: #ec6b76; color: #000; padding: 0px 10px; text-align: center; border-radius: 5px; }
.nl-field ul { background: #ec6b76; width: 390px; }
.nl-field li { font-size: 24px; padding: 0 10px !important; color: #000 !important; }
.nl-dd ul li.nl-dd-checked { background: #c45a63 !important; color: #fff!important; }

#question .clear section { float: left; width: 400px; }
#question .clear img { float: right; margin-right: 40px; }

#answer { display: none; }
#answer p:first-child { padding-top: 15px; }

img.next-toggle { display: none; }
<?php if($language == "es_ES") { ?>
	#question li { font-size: 20px; }
<?php } ?>

html[dir="rtl"] .ac-custom label { padding: 0 80px 0 0; }
html[dir="rtl"] .ac-custom input[type="radio"] { right: 35px; margin-top: -20px; }
html[dir="rtl"] .ac-custom label::before { right: 26px; margin-top: -30px; }
html[dir="rtl"] .ac-custom svg { right: 27px; margin-top: -23px; }
html[dir="rtl"] li label { text-align: right; }
html[dir="rtl"] #question .clear img {float: left;margin-left: 40px;}
html[dir="rtl"] #question .clear section {float: right;}
html[dir="rtl"] .nl-field ul {width: 440px;left: -18.5em;}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Checking what you know... about fossils"); ?></h1>
				<p><?php echo _("We know there were no people around to tell us about the ancient past. But we have some remains that might give us clues about what it was like if we can piece them all together."); ?></p>

				<h2>1. <?php echo _("The picture to the right shows a fossil of an animal. Where do you think this animal lived?"); ?></h2>

				<div class="clear">
					<section>
						<form class="ac-custom ac-radio ac-swirl" autocomplete="off">
							<ol>
								<li><input id="a" name="q" type="radio"><label for="a"><span><?php echo _("In the ground"); ?></span></label></li>
								<li><input id="b" name="q" type="radio"><label for="b"><span><?php echo _("In the trees"); ?></span></label></li>
								<li><input id="c" name="q" type="radio"><label for="c"><span><?php echo _("In the desert"); ?></span></label></li>
								<li><input id="d" name="q" type="radio"><label for="d"><span><?php echo _("In the ocean"); ?></span></label></li>
							<ol>
						</form>
					</section>

					<img src="images/3/fossil.jpg">
				</div>

				<h2>2. <?php echo _("What is the <span class='blink'>best</span> way to describe what fossils are?"); ?></h2>

				<form id="nl-form" class="nl-form">
					<p><?php echo _("Fossils are");?>

					<select name="select">
						<option value="" selected>&lt;<?php echo _("select"); ?>&gt;</option>
						<option value="A"><?php echo _("buried plants and animals"); ?></option>
						<option value="B"><?php echo _("evidence of dead plants and animals"); ?></option>
						<option value="C"><?php echo _("skeletons of dead plants and animals"); ?></option>
						<option value="D"><?php echo _("extinct plants and animals"); ?></option>
					</select>

					.</p>

					<div class="nl-overlay"></div>
				</form>
			</div>

			<div id="answer">
				<p><?php echo _("Fossils are evidence of dead plants or animals that lived thousands or even millions of years ago. Fossils might be skeletons, or shells, or footprints of extinct animals, or of animals that still roam the earth. The photo of the shell you saw on the previous page was a fossil of an animal that lived in the ocean a long time ago."); ?></p>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="4.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Brushing shell fossil..."); ?></strong></section></section>

	<script>
	var nlform = new NLForm(document.getElementById('nl-form'));

	var hash = window.location.hash.slice(1);
	var screenCount = 2;

	if(hash != "") {
		$('#' + hash).show(function() {
			var screen = hash[hash.length -1];
			if (screen = screenCount) {
				$('.bg').css('background-image', 'url(images/3/bg2.jpg)');
				$('.wrap').css('border-color', '#5a8aa8');
				$('#question').fadeOut(100, function() { $('#answer').fadeIn(); });
				$('img.check-toggle').fadeOut( function(){ $('img.next-toggle').fadeIn(); });
			} else {
				$('.bg').css('background-image', 'url(images/3/bg.jpg)');
				$('.wrap').css('border-color', '#96927c');
				$('#question').fadeIn();
				$('img.back-toggle').fadeIn();
				$('img.next-toggle').fadeOut(function(){$('img.check-toggle').fadeIn();});
			}
		});
	}

	$('img.check-toggle').click(function(){
		var checkAnswer = $('input:radio:checked').length;
		var checkAnswer2 = $('select option:selected').val();
		
		if (checkAnswer == '' || checkAnswer2 == '') {
			alert('<?php echo _("Please select your answers."); ?>');
		} else {
			$('#question').fadeOut(function(){
				$('.bg').css('background-image', 'url(images/3/bg2.jpg)');
				$('.wrap').css('border-color', '#5a8aa8');
				$('#answer').fadeIn();
				$('img.check-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); });
				window.location.hash = '#answer';
			});
		}
	});

	$('img.back-toggle').click(function(){
		if ($('#answer').is(':visible')) {
			$('#answer').fadeOut(function(){
				$('.bg').css('background-image', 'url(images/3/bg.jpg)');
				$('.wrap').css('border-color', '#96927c');
				$('#question').fadeIn();
				$('img.back-toggle').fadeIn();
				$('img.next-toggle').fadeOut(function(){$('img.check-toggle').fadeIn();});
				window.location.hash = '';
			});
		} else {
			$('img.back-toggle').parent().attr('href','2.php');
		}
	});
	</script>

	<script src="scripts/svgcheckbx.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
