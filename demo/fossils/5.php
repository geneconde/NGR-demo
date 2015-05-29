<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(7, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'fossils-qc1-a');
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
.bg { background-image: url(images/5/bg.jpg); }

#question1 ol { list-style: none; padding: 0; margin: 15px 0 0 20px; }
#question1 li { padding: 6px 0; }

.ac-custom { width: 100%; padding: 0 !important; }
.ac-custom label { color: #000; padding-left: 45px; font-size: 24px; }
.ac-custom input[type="checkbox"] { vertical-align: top; margin-top: -10px; }
.ac-custom input[type="checkbox"]:checked + label { color: #c45a63; }
.ac-custom svg { height: 20px; width: 30px; left: 3px; margin-top: -10px; }
.ac-custom label::before { border: 2px solid #c45a63; }
.ac-custom svg path { stroke: #c45a63; }
.ac-custom label::before { height: 35px; width: 35px; margin-top: -18px;}

#question2 ul { margin: 20px auto 0; width: 800px; list-style: none; padding: 0; }
#question2 li { float: left; width: 180px; margin-right: 26px; }
#question2 li:last-child { margin-right: 0; }
#question2 input[type=radio] { display: none; }
#question2 label { font-size: 24px; display: block; text-align: center; cursor: pointer; width: 180px; }
#question2 input[type="radio"] + label img { border: 4px solid #dbd2aa; -webkit-transition: all .3s ease; border-radius: 5px !important; width: 180px; }
#question2 input[type="radio"]:checked + label img {-webkit-transition: all .3s ease; border: 4px solid #c45a63; -webkit-backface-visibility: hidden; }
#question2 input[type="radio"] + label span { color: #000; -webkit-transition: all .3s ease; }
#question2 input[type="radio"]:checked + label span { color: #000; -webkit-transition: all .3s ease; color: #c45a63; -webkit-backface-visibility: hidden;  ;}
#question2 input[type="radio"] + label { -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
#question2 input[type="radio"]:checked + label {}

#answers { display: none; }
#answers p { text-align: center; font-size: 20px; }
#answers h2 { margin-bottom: 0; }

#answer1 .feedback { margin-left: -25px; padding: 0 20px; }

#answer2 .image { float: left; margin: 0 20px 0 0; }
#answer2 .image img { width: 160px; height: 140px; }
#answer2 .placeholder { float: left; width: 500px; }
#answer2 p { text-align: left; }
#answer2 .clear { width: 700px; margin: 0 auto; }
#answer2 .feedback { margin: 0; }

#question2, #answer2 { margin-top: 25px; }
img.next-toggle { display: none; }

html[dir="rtl"] .ac-custom label { padding: 0 80px 0 0; }
html[dir="rtl"] .ac-custom input[type="checkbox"] { right: 35px; margin-top: -20px; }
html[dir="rtl"] .ac-custom label::before { right: 26px; margin-top: -20px; }
html[dir="rtl"] .ac-custom svg { right: 27px; margin-top: -13px; }
html[dir="rtl"] li label { text-align: right; }
html[dir="rtl"] #answer2 .image {float: right;margin: 0 0 0 20px;}
html[dir="rtl"] #answer2 p {text-align: right;}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="questions">
				<h1><?php echo _("Quick Check #1"); ?></h1>

				<div id="question1" class="clear">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the <span class='blink'>true</span> statements about fossils."); ?></h2>	

					<section>
						<form class="ac-custom ac-checkbox ac-diagonal" autocomplete="off">
							<ol>
								<li><input id="a1" name="q1" type="checkbox"><label for="a1"><span><?php echo _("Most fossils are found in formations of layered rock."); ?></span></label></li>
								<li><input id="b1" name="q1" type="checkbox"><label for="b1"><span><?php echo _("All dead plants and animals eventually become fossils."); ?></span></label></li>
								<li><input id="c1" name="q1" type="checkbox"><label for="c1"><span><?php echo _("A fossilized shark's tooth is an example of a trace fossil."); ?></span></label></li>
								<li><input id="d1" name="q1" type="checkbox"><label for="d1"><span><?php echo _("A mold and cast fossil has the same shape as the original organism."); ?></span></label></li>
							<ol>
						</form>
					</section>
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. Trace fossils can reveal information about an animal's behavior and activities. Which of the following is <span class='blink'>not</span> an example of a trace fossil?"); ?></h2>	
 
					<ul class="clear">
						<li>
							<input type="radio" id="a2" name="q2">
							<label for="a2"><img src="images/5/footprint.jpg"><span><?php echo _("Footprint"); ?></span></label>
						</li>
						<li>
							<input type="radio" id="b2" name="q2">
							<label for="b2"><img src="images/5/brachiopod.jpg"><span><?php echo _("Cast"); ?></span></label>
						</li>
						<li>
							<input type="radio" id="c2" name="q2">
							<label for="c2"><img src="images/5/burrow.jpg"><span><?php echo _("Burrow"); ?></span></label>
						</li>
						<li>
							<input type="radio" id="d2" name="q2">
							<label for="d2"><img src="images/5/tracks.jpg"><span><?php echo _("Tracks"); ?></span></label>
						</li>
					</ul>
	 			</div>
			</div>

			<div id="answers">
				<h1><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?"); ?></h1>

				<div id="answer1">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the <span class='blink'>true</span> statements about fossils."); ?></h2>	
					<p><?php echo _("You answered..."); ?></p>
					<div class="answer"></div>
					<div class="feedback"></div>
				</div>					

				<div id="answer2">
					<h2><?php echo _("Question B. Trace fossils can reveal information about an animal's behavior and activities. Which of the following is <span class='blink'>not</span> an example of a trace fossil?"); ?></h2>	
					<div class="clear">
						<div class="image"></div>
						<div class="placeholder">
							<p><?php echo _("You answered..."); ?></p>
							<div class="answer"></div>
							<div class="feedback"></div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="6.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Preparing your first quick check..."); ?></strong></section></section>

	<script>
	var ans1, ans2, answered = <?php echo $answered; ?>, checkAnswer = 0;

	$('#question1').find('input[type=checkbox]').on('click', function() {
		var me = $(this);

		if (me.is(':checked') && me.attr('id') == 'a1') {
			$('#answer1').find('.answer').append('<p class="a"><?php echo _("Most fossils are found in formations of layered rock."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'a1') {
			$('#answer1').find('.answer').find('p.a').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'b1') {
			$('#answer1').find('.answer').append('<p class="b"><?php echo _("All dead plants and animals eventually become fossils."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'b1') {
			$('#answer1').find('.answer').find('p.b').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'c1') {
			$('#answer1').find('.answer').append("<p class='c'><?php echo _("A fossilized shark's tooth is an example of a trace fossil."); ?></p>");//'
		} else if ( ! me.is(':checked') && me.attr('id') == 'c1') {
			$('#answer1').find('.answer').find('p.c').remove(); 
		}

		if (me.is(':checked') && me.attr('id') == 'd1') {
			$('#answer1').find('.answer').append('<p class="d"><?php echo _("A mold and cast fossil has the same shape as the original organism."); ?></p>');
		} else if ( ! me.is(':checked') && me.attr('id') == 'd1') {
			$('#answer1').find('.answer').find('p.d').remove(); 
		}
		ans1 = '';
 		if ($('#a1').is(':checked') == true) {
 			ans1 += 'A';
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
		if ($('#a1').is(':checked') == true && $('#b1').is(':checked') == false && $('#c1').is(':checked') == false && $('#d1').is(':checked') == true) {
			$('#answer1').find('.feedback').html("<p class='green'><img src='images/others/correct.png'><?php echo _("Correct! Most fossils are found in formations of layered rock. Not all animals can become fossils. For example, some plants and animals get eaten before they can become fossils. A fossil tooth is evidence of the shark but is not a trace fossil because it's a fossil of part of the shark not evidence of the shark's activity. A mold and cast fossil has the same shape as the original organism. The impression that is left behind is just like the original plant or animal; then it is filled in with other materials and keeps its shape."); ?></p>"); 
			ans1 = 'AD';
		} else {
			$('#answer1').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("Not quite... Most fossils are found in formations of layered rock. Not all animals can become fossils. For example, some plants and animals get eaten before they can become fossils. And a fossil shark tooth is evidence of the shark, but it isn't considered to be a trace fossil because it's part of the shark not evidence of the shark's activity. A mold and cast fossil has the same shape as the original organism. The impression that is left behind is just like the original plant or animal; then it is filled in with other materials and keeps its shape."); ?></p>"); //'
		}
	});

	$('#question2').find('input[type=radio]').on('click', function() {
		var me = $(this).attr('id');

		if (me == 'a2') {
			$('#answer2').find('.image').html('<img src="images/5/footprint.jpg">');
			$('#answer2').find('.answer').html('<p><?php echo _("Footprint"); ?></p>');
			$('#answer2').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("Nope... footprints are considered a trace fossil as they are evidence of the animal's activity."); ?></p>");//'
			ans2 = 'A';
		}

		if (me == 'b2') {
			$('#answer2').find('.image').html('<img src="images/5/brachiopod.jpg">');
			$('#answer2').find('.answer').html('<p><?php echo _("Cast"); ?></p>');
			$('#answer2').find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct, brachiopod shell fossil is an example of a cast fossil not trace fossil."); ?></p>');
			ans2 = 'B';
		}

		if (me == 'c2') {
			$('#answer2').find('.image').html('<img src="images/5/burrow.jpg">');
			$('#answer2').find('.answer').html('<p><?php echo _("Burrow"); ?></p>');
			$('#answer2').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("No, a burrow is a trace fossil as it is evidence of the animal's activity."); ?></p>");//'
			ans2 = 'C';
		}

		if (me == 'd2') {
			$('#answer2').find('.image').html('<img src="images/5/tracks.jpg">');
			$('#answer2').find('.answer').html('<p><?php echo _("Tracks"); ?></p>');
			$('#answer2').find('.feedback').html("<p class='red'><img src='images/others/wrong.png'><?php echo _("No, tracks are considered a trace fossil as they are evidence of the animal's activity."); ?></p>");//'
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
			saveAnswer('fossils-qc1-a', ans1);
			saveAnswer('fossils-qc1-b', ans2);
		}
	}

	$('img.back-toggle').click(function() {
		if ($('#questions').is(':visible')) {
			document.location.href = "4.php#screen2";
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
