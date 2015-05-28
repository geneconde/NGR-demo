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
h1 { color: #A89071; }
.wrap { border-color: #c2a482; }
.bg { background-image: url(images/4/bg.jpg); }

#screen1 .slider { width: 330px; margin: 20px auto; }
#screen1 .slider img { margin-bottom: 10px; }
#screen1 .slider .caption { color: #000; text-align: center; }

#screen2 .grid { width: 760px; padding: 0; }
#screen2 .grid li { float: left; width: 340px; }
#screen2 .grid figcaption { background: #c5e0c4; color: #000; width: 290px; height: auto; padding: 10px; }
#screen2 .grid figcaption p { padding: 0; margin: 0; font-size: 22px; }
#screen2 .grid figcaption span { display: inline; }
#screen2 .grid figcaption span:before { content: ''; }

#screen2 p:first-child { padding-top: 15px; }

#screen2 { display: none; }
img.next-toggle { display:none; }
<?php if($language == "es_ES") { ?>
	#screen2 .grid figcaption p { font-size: 20px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div id="screen1" class="screen">
				<h1><?php echo _("Reviewing big ideas... about fossils"); ?></h1>
				<p><?php echo _("<span class='key'>Fossils</span> are the preserved evidence of organisms (living things like plants or animals) that were once alive a long time ago. This evidence might be the preserved remains of the plant or animal or the traces the animal or plant leaves behind like footprints or burrows. Fossils are usually found in <span class='key'>sedimentary rock</span> that is formed by deposition of layers of mud and sand from rivers, streams, lakes and oceans over a long, long time. Not all dead plants and animals turn into fossils, but most fossils are found in or near deposits of sedimentary rock."); ?></p>
				<ul class="rslides slider">
					<li><img src="images/4/s1a.jpg"></li>
					<li><img src="images/4/s1b.jpg"></li>
				</ul>
			</div>

			<div id="screen2" class="screen">
				<p><?php echo _("There are 4 common types of fossils. Hover on the images to know more."); ?></p>

				<ul class="grid cs-style-1 clear">
					<li>
						<figure>
							<img src="images/4/s2a.jpg">
							<figcaption>
							<p><?php echo _("Sometimes the actual organism or parts of the organism are preserved. This kind of fossil is called a <span class='key'>true form fossil</span>. Insects preserved in tree sap are true form fossils. So are woolly mammoths found trapped and frozen in glacial ice. These true form fossils are very rare."); ?></p>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img src="images/4/s2b.jpg">
							<figcaption>
							<p><?php echo _("A fossil can also consist of some mark or evidence of an organism such as a footprint, a nest or even its waste (poop). This type of fossil is called a <span class='key'>trace fossil</span>."); ?></p>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img src="images/4/s2c.jpg">
							<figcaption>
							<p><?php echo _("In some cases the remains of an organism trapped in the rock formation just leave an impression of the organism. This type of fossil is called a <span class='key'>mold</span>."); ?></p>
							</figcaption>
						</figure>
					</li>
					<li>
						<figure>
							<img src="images/4/s2d.jpg">
							<figcaption>
							<p><?php echo _("If the mold then later fills with other materials, the fossil formed is called a <span class='key'>cast</span>."); ?></p>
							</figcaption>
						</figure>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons">
		<a href="#" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _('Read More'); ?>"></a>
		<a href="5.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Types of fossils..."); ?></strong></section></section>

	<script>
	$(".slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: false,
		speed: 400
	});

	var hash = window.location.hash.slice(1);

	if (hash != "") {
		$('.screen').hide();
		$('#screen2').show();
		$('img.readmore-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); });
	}
	
	$('img.back-toggle').click(function(){
		if ($('#screen1').is(':visible')) {
			document.location.href = "3.php#answer";
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
