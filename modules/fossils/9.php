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
#question2 .ac-custom svg { height: 42px; width: 38px; left: 1px; margin-top: -23px; }
#question2 .ac-custom svg path { stroke: #c45a63; }
#question2 .ac-custom label::before { background: #c45a63; height: 20px; width: 20px; margin-top: -12px;}

#answers { display: none; }
#answers p { text-align: center; }

#answer1 .answer { text-align: center; margin: 10px 0; }
#answer1 .answer img { display: inline-block; margin-right: 20px; width: 100px !important; }
#answer1 .answer img:last-child { margin-right: 0; }

#question2, #answer2 { margin-top: 25px; }
img.next-toggle { display: none; }
<?php if($language == "es_ES") { ?>
	#answers p { font-size: 21px; }
<?php } ?>

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
			<div id="questions">
				<h1><?php echo _("Quick Check #3"); ?></h1>

				<div id="question1" class="clear">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the fossil fuels below."); ?></h2>	

					<ul class="clear">
						<li>
							<input type="checkbox" id="a1" name="q1">
							<label for="a1"><img src="images/9/petroleum.jpg"><span><?php echo _("Petroleum"); ?></span></label>
						</li>
						<li>
							<input type="checkbox" id="b1" name="q1">
							<label for="b1"><img src="images/9/coal.jpg"><span><?php echo _("Coal"); ?></span></label>
						</li>
						<li>
							<input type="checkbox" id="c1" name="q1">
							<label for="c1"><img src="images/9/fossils.jpg"><span><?php echo _("Fossils"); ?></span></label>
						</li>
						<li>
							<input type="checkbox" id="d1" name="q1">
							<label for="d1"><img src="images/9/gas.jpg"><span><?php echo _("Natural Gas"); ?></span></label>
						</li>
					</ul>
				</div>

				<div id="question2">
					<h2><?php echo _("Question B. Click on the <span class='blink'>false</span> statement about fossil fuels."); ?></h2>	
 
					<section>
						<form class="ac-custom ac-radio ac-circle" autocomplete="off">
							<ol>
								<li><input id="a2" name="q2" type="radio"><label for="a2"><span><?php echo _("Burning fossil fuel is bad for the environment."); ?></span></label></li>
								<li><input id="b2" name="q2" type="radio"><label for="b2"><span><?php echo _("Fossil fuels can be extracted with machinery from various parts of the earth."); ?></span></label></li>
								<li><input id="c2" name="q2" type="radio"><label for="c2"><span><?php echo _("Fossil fuels are continually made inside the earth but very slowly over millions of years."); ?></span></label></li>
								<li><input id="d2" name="q2" type="radio"><label for="d2"><span><?php echo _("Petroleum, natural gas, and coal are renewable sources of energy."); ?></span></label></li>
							<ol>
						</form>
					</section>
	 			</div>
			</div>

			<div id="answers">
				<h1><?php echo _("Quick Check #3"); ?> - <?php echo _("How did I do?"); ?></h1>

				<div id="answer1">
					<h2><?php echo _("Question A. Click on <span class='blink'>all</span> the fossil fuels below."); ?></h2>	
					<p><?php echo _("You answered..."); ?></p>
					<div class="answer"></div>
					<div class="feedback"></div>
				</div>					

				<div id="answer2">
					<h2><?php echo _("Question B. Click on the <span class='blink'>false</span> statement about fossil fuels."); ?></h2>	
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
		<a href="10.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for your last quick check?"); ?></strong></section></section>

	<script>
	var ans1 = '', ans2, answered = <?php echo $answered; ?>, checkAnswer = 0;
	var a1 = $('#a1'), b1 = $('#b1'), c1 = $('#c1'), d1 = $('#d1');

	$('#question1').find('input[type=checkbox]').on('click', function() {
		var checkbox = $(this);

		if (checkbox.is(':checked')) {
			if (checkbox.attr('id') == 'a1') { ans1 = 'A'; $('#answer1').find('.answer').append('<img src="images/9/petroleum.jpg" class="a">'); }
			if (checkbox.attr('id') == 'b1') { ans1 = 'B'; $('#answer1').find('.answer').append('<img src="images/9/coal.jpg" class="b">'); }
			if (checkbox.attr('id') == 'c1') { ans1 = 'C'; $('#answer1').find('.answer').append('<img src="images/9/fossils.jpg" class="c">'); }
			if (checkbox.attr('id') == 'd1') { ans1 = 'D'; $('#answer1').find('.answer').append('<img src="images/9/gas.jpg" class="d">'); }

		} else if ( ! checkbox.is(':checked')) {
			if (checkbox.attr('id') == 'a1') { $('#answer1').find('.answer img.a').remove(); }
			if (checkbox.attr('id') == 'b1') { $('#answer1').find('.answer img.b').remove(); }
			if (checkbox.attr('id') == 'c1') { $('#answer1').find('.answer img.c').remove(); }
			if (checkbox.attr('id') == 'd1') { $('#answer1').find('.answer img.d').remove(); }
		}

		if(a1.is(":checked")) { ans1  = "A"; }
		if(b1.is(":checked")) { ans1 += "B"; }
		if(c1.is(":checked")) { ans1 += "C"; }
		if(d1.is(":checked")) { ans1 += "D"; }

		if (ans1 == 'ABD') {
			$('#answer1').find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct. Three types of fossil fuels are petroleum, natural gas, and coal. They are from decayed plant and animal material covered in sand and stone, then heated and pressured over millions of years."); ?></p>');
		} else {
			$('#answer1').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("Not quite. Three types of fossil fuels are petroleum, natural gas, and coal. They are from decayed plant and animal material covered in sand and stone, then heated and pressured over millions of years. Fossils themselves are not energy resources, rather what they have turned into under certain conditions are."); ?></p>');
		}
	});

	$('#question2').find('input[type=radio]').on('click', function() {
		var me = $(this).attr('id');

		if (me == 'a2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Burning fossil fuel is bad for the environment."); ?></p>');
			$('#answer2').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, the gases released from burning fossil fuel cause pollution and lead to global climate change. This statement is true."); ?></p>');
			ans2 = 'A';
		}

		if (me == 'b2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Fossil fuels can be extracted with machinery from various parts of the earth."); ?></p>');
			$('#answer2').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, drills and pumps are used on land and offshore around the world to extract these valuable resources."); ?></p>');
			ans2 = 'B';
		}

		if (me == 'c2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Fossil fuels are continually made inside the earth but very slowly over millions of years."); ?></p>');
			$('#answer2').find('.feedback').html('<p class="red"><img src="images/others/wrong.png"><?php echo _("No, this is true. Fossil fuels are produced continually, but humans are using up the resources much faster than they are being produced."); ?></p>');
			ans2 = 'C';
		}

		if (me == 'd2') {
			$('#answer2').find('.answer').html('<p><?php echo _("Petroleum, natural gas, and coal are renewable sources of energy."); ?></p>');
			$('#answer2').find('.feedback').html('<p class="green"><img src="images/others/correct.png"><?php echo _("Correct. This statement is false. Petroleum, natural gas, and coal are sources of energy, but they are non-renewable. They will run out when we use them all."); ?></p>');
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
			//saveCheckbox();
			$('img.check-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
			$('#questions').fadeOut(function(){ 
				$('#answers').fadeIn();
				save();
				window.location.hash = '#answer';
			}); 
		}
	});

	function saveCheckbox() {
		if(a1.is(':checked')){ ans1 += 'A'; }
		if(b1.is(':checked')){ ans1 += 'B'; }
		if(c1.is(':checked')){ ans1 += 'C'; }
		if(d1.is(':checked')){ ans1 += 'D'; }
	}

	function save() {
		if (answered == 0) {
			saveAnswer('fossils-qc3-a', ans1);
			saveAnswer('fossils-qc3-b', ans2);
		}
	}

	$('img.back-toggle').click(function() {
		if ($('#questions').is(':visible')) {
			document.location.href = "8.php#screen2";
		} else if ($('#answers').is(':visible')) {
			$('img.next-toggle').fadeOut(function() { $('img.check-toggle').fadeIn(); });
			$('#answers').fadeOut(function() {
				$('#questions').fadeIn();
				ans1 = '';
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
