<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(2, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> <?php echo _("How Animals Behave"); ?> </title>

<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/clouds.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" /><link rel="stylesheet" type="text/css" href="styles/global.css" />

<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/easeljs.js"></script>
<script src="scripts/tweenjs.js"></script>
<script src="scripts/movieclip.js"></script>
<script src="scripts/2.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->
<script>
	var canvas, stage, exportRoot;
	function init() {
		canvas = document.getElementById("canvas");
		fitToContainer(canvas)
		exportRoot = new lib._2();
		stage = new createjs.Stage(canvas);
		stage.addChild(exportRoot);
		stage.update();

		createjs.Ticker.setFPS(24);
		createjs.Ticker.addEventListener("tick", stage);
	}
	function fitToContainer(canvas) {
		canvas.style.width ='100%';
		canvas.style.height='100%';
		canvas.width  = canvas.offsetWidth;
		canvas.height = canvas.offsetHeight;
	}
</script>
<style>	
	html { background-color: #FFFFFF; }
	body { display: none; }	
	h1 { padding-left: 20px; }
	p { padding: 0 10px; margin-left: 10px; text-align: left; }
	.wrap { padding: 0; position: relative; border-left: 1px dashed #009FE8; border-right: 1px dashed #009FE8; }
	.inner { background-color: #26770f; margin: 0 auto; max-width: 896px; height: 100%; }
	.bg { position: relative; z-index: 4; }
	.bg h1 { color: #F7E258; }
	.bg div { background-color: rgba(255, 255, 255, .7); padding: 10px 0; border-radius: 10px; }
	#canvas { position: absolute; z-index: 1; overflow: hidden; width: 896px !important; }

	.container img {
		-webkit-border-radius: 12px; /* Android ≤ 1.6, iOS 1-3.2, Safari 3-4 */
		border-radius: 12px; /* Android 2.1+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 5+ */
		/* useful if you don't want a bg color from leaking outside the border: */
		background-clip: padding-box; /* Android 2.2+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 4+ */
	}


	.buttons { position: absolute; bottom: 2%; right: 2%; }
	#canvas {
		position: absolute;
	}
	#sun {
		background: url(images/2/sun.png) 0 0 no-repeat;
		width: 123px;
		height: 124px;
		position: absolute;
		right: 0;
		top: 10px;
		right: 10px;
		z-index: 3;
		-webkit-animation: infinite-spinning 5s infinite;
		-moz-animation: infinite-spinning 5s infinite;
		-o-animation: infinite-spinning 5s infinite;
	}
	@-webkit-keyframes infinite-spinning {
		from { -webkit-transform: rotate(0deg); }
		to { -webkit-transform: rotate(360deg); }
	}
	@-moz-keyframes infinite-spinning {
		from { -moz-transform:  rotate(0deg); }
		to { -moz-transform:  rotate(360deg); }
	}

	html[dir="rtl"] #sun { right:auto;left:10px; }
	html[dir="rtl"] p { text-align: right; margin-right: 10px; }
</style>
</head>
<body onload="init();">
	<div class="wrap">
		<div class="inner">	
			<canvas id="canvas" width="900" height="670"></canvas>
			<div id="sun"></div>

			<div class="bg">
				<h1><?php echo _("Thinking about... how animals behave"); ?></h1>
				<p><?php echo _("Want to know where your dog or cat is? Open a can of pet food. Is the fish in the bowl still alive? Tap the glass. Are there ants in the park? Open the picnic basket."); ?></p>
				<br>
				<p><?php echo _("When you open the can, tap the glass, or bring out the picnic you get a quick response. The animals sense chemicals wafting into the air from the food substances. The fish moves in response to vibrations transmitted through the glass bowl into the water. The stimulus you provide causes a response in the animals. All animals are able to respond to their environments in some manner."); ?></p>
			</div>
		</div>
	</div>

	<div class="buttons-back" ><a href="1.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>	
	<div class="buttons"><a href="3.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Are you ready"); ?>, <?php echo ($user->getFirstName() . "?"); ?></strong></section></section>
<?php require("setlocale.php"); ?>
</body>
</html>
