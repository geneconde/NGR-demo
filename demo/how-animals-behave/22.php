<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo _("How Animals Behave"); ?></title>
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/blink.js"></script>
<script src="scripts/wiggle.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script>
$(document).ready(function() {
$('img.watch-toggle').hover(function () { this.src = 'images/buttons/watchvideo-<?php echo $gender; ?>-on.png'; }, function () { this.src = 'images/buttons/watchvideo-<?php echo $gender; ?>.png'; });		$('img.next-toggle').hover(function () { this.src = 'images/buttons/next-<?php echo $gender; ?>-on.png'; }, function () { this.src = 'images/buttons/next.png'; });	});
</script>
<style>	
.bg { 
	background: url(images/22/bg.jpg) 0 0 no-repeat;  
	background-size: 100% 100%; 		
	width:100%; 	
	height:100%; 		
	position:relative; 	
	}
	
	h1 { margin-top: 0; padding-top: 40px; text-align: center; font-size: 50px; }
	h1 .blink { color: #F99611; }	
	h2 { text-align: center; color: #333; font-size: 24px; margin-top: 40px; }
	
a { 
	text-decoration:none; 
	width: 400px;
	-webkit-border-radius:10px;
	-moz-border-radius:10px;
	border-radius:10px;
	border: 2px dashed orange;
	padding: 10px; 
	height: 30px; 
	background-color: #f2c392; 
	color: maroon; 
	font-size: 20px; 
	}	
.buttons-back a {border: none; background: none }
</style>
</head>

<body>	
	<div class="wrap">
		<div class="bg">	
			<h1 class="blink"><?php echo _("Congratulations, ") ?> <?php echo $user->getFirstName() . "!"; ?></h1>	
			<h2><?php echo _("You've completed this How Animals Behave module."); ?></h2>			
			<h2><?php echo _("You can check how you did on the 'Quick Checks' and 'Quiz Questions' for this review by clicking the button below."); ?></span></h2>
			<h2>
				<a
					<?php if ($user->getType() == 0): ?>
						href="../../teacher.php">
						<span id="link"><?php echo _("Go to dashboard"); ?></span>
					<?php else: ?>
						href="../../results.php?smid=<?php echo $_SESSION['smid']; ?>">
						<?php echo _("How did I do?"); ?>
					<?php endif; ?>
				</a>
			</h2>
		</div>	
	</div>		
	<div class="buttons-back" ><a href="21.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<section id="preloader"><section class="selected"><strong><?php echo _("You're done!"); ?></strong></section></section>	
<script>
	$('.blink').blink({ speed: 500, blinks: 1000 });
	$('.wiggle-right').wiggle({ speed: 250, wiggles: 1000, moveto: 'right' });
</script>
<?php require("setlocale.php"); ?>
</body>
</html>