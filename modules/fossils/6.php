<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) $smc->updateStudentLastscreen(6, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _('Fossils'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/toucheffects.css" />
<link rel="stylesheet" type="text/css" href="styles/responsiveslides.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/modernizr.custom.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/responsiveslides.js"></script>
<script src="scripts/global.js"></script>
<style>
h1 { color: #a49749; }
.wrap { border-color: #b9ab64; }
.bg { background-image: url(images/6/bg.jpg); }

#screen1 .slider, #screen1 .slider2 { float: right; width: 340px; height: 245px; border-radius: 5px; margin-top: 10px; }
#screen1 .slider img, #screen1 .slider2 img { width: 360px; height: 265px; -moz-border-radius: 0; }

@media screen and (-webkit-min-device-pixel-ratio:0) { #screen1 .slider img { width: 340px; height: 245px; } }

#screen1 .rslides_nav { display: none !important; }
#screen1 .clear p { float: left; width: 490px; }

#screen2 .placeholder { width: 464px; border-radius: 5px; position: relative; margin: 20px auto 0; }
#screen2 .placeholder img { width: 100%; margin-bottom: 10px; }
#screen2 .placeholder .caption { text-align: center; font-size: 20px !important; color: #86383B; }
#screen2 .placeholder .next { transition: .2s ease-in all; position: absolute; right: -65px; width: 51px; height: 77px; display: block; text-indent: -9999px; background: url(images/6/arrows.png) no-repeat right top; top: 132px; }
#screen2 .placeholder .prev { transition: .2s ease-in all; position: absolute; left: -65px; width: 51px; height: 77px; display: block; text-indent: -9999px; background: url(images/6/arrows.png) no-repeat left top; top: 132px; }

#screen2 p:first-child { padding-top: 15px; }

#screen2 { display: none; }
img.next-toggle { display:none; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screen">
				<h1><?php echo _("More big ideas... about fossils"); ?></h1>
				<p><?php echo _("<span class='key'>Paleontologists</span> study fossils because they can learn lots of useful things about the Earth and how it has changed. They also can learn many useful things about the living organisms that inhabited the Earth many years ago. These scientists study the collection of all the fossils that have ever been found. The collection is called the <span class='key'>fossil record</span>."); ?></p>

				<div class="clear">
					<p><?php echo _("The fossil record is the collective set of the remains of organisms that are at least 10,000 years old. When the record of all fossils from around the world is viewed as a whole, it can provide interesting information about how life on Earth has changed over time – like when the dinosaurs became extinct. Scientists consider the fossil evidence they have found to be extremely valuable and they keep looking for more new fossil discoveries to try to fill in gaps in the fossil record to have a better understanding of the history of the earth."); ?></p>
					<ul class="rslides slider">
						<li><img src="images/6/s1a.jpg"></li>
						<li><img src="images/6/s1b.jpg"></li>
						<li><img src="images/6/s1c.jpg"></li>
					</ul>
				</div>
			</div>

			<div id="screen2" class="screen">
				<p><?php echo _("Here are some things that scientists can learn about the Earth itself and its inhabitants over time by studying the fossil record."); ?></p>
				<p><?php echo _("Browse through the slides below by clicking the left and right arrows."); ?></p>

				<div class="placeholder">
					<ul class="rslides slider2">
						<li>
							<img src="images/6/s2a.jpg">
							<p class="caption"><?php echo _("How living things changed or evolved over time."); ?></p>
						</li>
						<li>
							<img src="images/6/s2b.jpg">
							<p class="caption"><?php echo _("When certain species became <span class='key'>extinct</span>."); ?></p>
						</li>
						<li>
							<img src="images/6/s2c.jpg">
							<p class="caption"><?php echo _("The habits and activities of different organisms."); ?></p>
						</li>
						<li>
							<img src="images/6/s2d.jpg">
							<p class="caption"><?php echo _("The relative ages of rock layers beneath the earth's surface."); ?></p>
						</li>
						<li>
							<img src="images/6/s2e.jpg">
							<p class="caption"><?php echo _("Changes in the climate at different places on the earth."); ?></p>
						</li>
						<li>
							<img src="images/6/s2f.jpg">
							<p class="caption"><?php echo _("Changes in the locations of the continents and other land masses."); ?></p>
						</li>
						<li>
							<img src="images/6/s2g.jpg">
							<p class="caption"><?php echo _("Locations of bodies of water like rivers, lakes, seas and oceans."); ?></p>
						</li>
					</ul>				
				</div>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _('Read More'); ?>"></a>
		<a href="7.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Studying fossil records..."); ?></strong></section></section>

	<script>
	$('.slider2').responsiveSlides({
		auto: false,
		nav: true
	})
	$(".slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: true,
		speed: 500
	});

	var hash = window.location.hash.slice(1);

	if (hash != "") {
		$('.screen').hide();
		$('#screen2').show();
		$('img.readmore-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); });
	}
	
	$('img.back-toggle').click(function(){
		if ($('#screen1').is(':visible')) {
			document.location.href = "5.php";
		} else if ($('#screen2').is(':visible')) {
			$('img.next-toggle').fadeOut(function() { $('img.readmore-toggle').fadeIn(); });
			$('#screen2').fadeOut(function (){
				$('#screen1').fadeIn();
				window.location.hash = '';
			});
		} 
	});

	$('img.readmore-toggle').click(function(){
		if ($('#screen1').is(':visible')) {
			$('img.readmore-toggle').fadeOut(function() { $('img.next-toggle').fadeIn(); });
			$('#screen1').fadeOut( function(){
				$('#screen2').fadeIn();
				window.location.hash = '#screen2';
			});
		}
	});
	</script>

	<script src="scripts/toucheffects.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
