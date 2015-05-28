<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(13, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo _("How Animals Behave"); ?></title>

<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/modalcomponent.css" /><link rel="stylesheet" type="text/css" href="styles/global.css" />

<script src="scripts/jquery.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<style>
	 html { background-color: #FFFFFF; }
	 body { display: none; }
	h1 { color: palevioletred; }
	.bg { 
		background: url(images/13/bg.jpg) 0 0 repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}		p { margin-left: auto; margin-right: auto; text-align: left; }	.wrap {	border-left: 1px dashed #FEDE63; border-right: 1px dashed #FEDE63; }

	html[dir="rtl"] p { text-align: right; }
	<?php if($language == "es_ES") { ?>
		h1 { font-size:27px; }
	<?php } ?>
</style>
</head>

<body>

	<div class="wrap">

		<div class="bg">

			<h1><?php echo _("Summarizing big ideas... about how animals behave"); ?></h1>
			
			<p><?php echo _("<span class='key'>Behavior</span> is the way that an organism acts and responds in the environment. Organisms’ behavior occurs as a reaction to a <span class='key'>stimulus</span>. Stimuli can either be external, as in a change in the environment, or internal, as in a signal within the animal. Many behaviors are adaptations that help organisms survive and reproduce. Useful behaviors are passed on to later generations and eventually an <span class='key'>inherited behavior </span>  becomes common. Not all behavior is inherited, the ability to learn is inherited. <span class='key'> Instinctual behavior </span> is any behavior that is inherited and not learned during life. <span class='key'> Mechanical stimuli </span> include anything that causes a sensation of touch, pain, sound, or temperature. <span class='key'> Chemical stimuli </span>  are molecules in our environment that make us sense taste or smell. Flavor is a combination of taste and smell combined and interpreted by the brain together. The brain is part of a system in which messages are taken from all parts of the body to the brain and back. First the nerve cells are stimulated, then they respond and send an electrical signal to the brain. The brain interprets it and sends a <span class='key'> response </span> signal out to the body. This is how organisms respond to their environment. "); ?></p>

		</div>

	</div>

	<div class="buttons-back" ><a href="12.php#screen2" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons"><a href="14.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Putting it all together..."); ?></strong></section></section>

	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
<?php require("setlocale.php"); ?>
</body>
</html>