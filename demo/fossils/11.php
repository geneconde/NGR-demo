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
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
h1 { color: #766427; }
.wrap { border-color: #e0ce8e; }
.bg { background-image: url(images/11/bg.jpg); }
p { font-size: 20px; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _("Summarizing big ideas... about fossils"); ?></h1>
				<p><?php echo _("When a living organism dies, it sometimes is covered by soil, sand, mud or other sediments. These sediments may harden into <span class='key'>sedimentary rock</span>, preserving some remains of the organism or some type of trace or trail of the organism's activity. These remains or other evidence of an ancient dead plant or animal are called <span class='key'>fossils</span>. They can be a bone, a shell print in rock, a track, a burrow or a tunnel. There are several main types of fossils, including <span class='key'>molds</span>, <span class='key'>casts</span>, <span class='key'>true form fossils</span>, and <span class='key'>trace fossils</span>. Fossils indicate that many different life forms have existed at different times throughout the geological history of the earth. Scientists called <span class='key'>paleontologists</span> use fossils to study the plants and animals that lived on the Earth a long time ago and to study what the Earth was like in the far distant past and how it has changed. Over millions of years, heat and pressure went to work on the dead plants and animals in rocks formed in ancient seas and swamps until they became pockets of fossil fuel in the earth. Petroleum (oil), natural gas, and coal are three types of fossil fuels. Today, miners and oilmen use big drills and other heavy equipment to dig or drill into the earth's crust to find fossil fuels. Natural gas is usually found near oil deposits that were created under similar conditions. Oil, gas, and coal can be converted to electricity – another form of energy. Oil can be made into gasoline to run our cars. We use fossil fuels every day, but the process of forming them inside the earth takes a long time – millions of years. That means these resources are <span class='key'>non-renewable</span>; they cannot be replaced once they are used up."); ?></p>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="10.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons" title="<?php echo _('Next'); ?>">
		<a href="12.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Putting it all together..."); ?></strong></section></section>

	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
