<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(10, $_SESSION['smid']);
		$problem = $mmc->getModuleProblem('fossils');
		$sa = $mac->getProblemAnswer2($_SESSION['smid'],$problem['meta_ID']);
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
<link rel="stylesheet" type="text/css" href="styles/responsiveslides.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/responsiveslides.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
h1 { color: #918557; font-size: 31px; }
h2 { text-align: center; color: #B45B66; }
.wrap { border-color: #e3dfaf; }
.bg { background-image: url(images/10/bg.jpg); }

.slider { width: 450px; margin: 20px auto; }

#assignment { display: none; text-align: center; }
#assignment h2 { margin-top: 0; padding-top: 20px; }
textarea { width: 60%; margin-top: 20px; display: inline-block; border-radius: 5px; border: 1px solid #B45B66; outline: 0; padding: 10px; font-size: 24px; font-family: PlaytimeRegular; }
img.next-toggle { display: none; }
#problem img { margin:0 auto; display: block; }

html[dir="rtl"] h2 { text-align: center; }

</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="problem">
				<h1><?php echo _("Using what you know... about fossils... to solve a problem"); ?></h1>
				<h2><?php echo _("The Problem"); ?></h2>
				<p><?php echo _("You are a paleontologist digging for fossils in a huge cliff along a road through a mountain forest. In rocks at the bottom of the cliff, you find fossils of an extinct fish and some shell fossils. Further up the cliff, in a different rock layer, you find a fossil of an ancient species of cactus. At first, these finds don't make sense to you."); ?></p>
				<img src="images/10/a.jpg">
				<!-- <ul class="rslides slider">
					<li><img src="images/10/a.jpg"></li>
					<li><img src="images/10/b.jpg"></li>
				</ul> -->
			</div>

			<div id="assignment">
				<h2><?php echo _("The Assignment"); ?></h2>
				<p><?php echo _("From your fossil discoveries in the rock layers of the cliff, how would you interpret the fossil evidence you found to tell how past climate and geography changed over time at this location? Explain your reasoning in a report in the text box provided."); ?></p>
				<textarea cols="80" rows="8" placeholder="<?php echo _('Please type your answer here...'); ?>"></textarea>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _('Read More'); ?>"></a>
		<a href="11.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Probing assumptions..."); ?></strong></section></section>

	<script>
	$(".slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: false,
		speed: 400
	});

	$('img.back-toggle').click(function(){
		if ($('#problem').is(':visible')) {
			document.location.href= "9.php";
		} else if ($('#assignment').is(':visible')) {
			$('img.next-toggle').fadeOut(function() { $('img.readmore-toggle').fadeIn(); });
			$('#assignment').fadeOut(function(){
				$('#problem').fadeIn();
			});
		}
	});
	
	$('img.readmore-toggle').click(function(){
		$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
		$('#problem').fadeOut( function(){
			$('#assignment').fadeIn();
			window.location.hash = '#assignment';
		});
	});
	
	$('img.next-toggle').click( function() {
		if ($('textarea').val() == '') {
			alert('<?php echo _("Please type your answer."); ?>');
			return false;
		} else {
			save();
			document.location.href = "11.php";
		}
	});

	var answered = <?php echo $answered; ?>

	function save() {
		var answer = $('textarea').val();
		
		if (answered == 0) {
			saveMeta('fossils', answer);
			answered = 1;
		}
	}

	</script>

	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
