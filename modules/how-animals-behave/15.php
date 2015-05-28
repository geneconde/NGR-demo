<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(15, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo _("How Animals Behave"); ?></title>

<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" /><link rel="stylesheet" type="text/css" href="styles/global.css" />

<script src="scripts/jquery.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->
<style>
	html { background-color: #E9F5FC; }
	body { display: none; background-color: #FFFFFF;}	
	h1 { font-size: 34px; color: palevioletred; }	p { margin-left: 2% }
	.bg { 
		background: url(images/14/bg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}

	.container {
		margin-top: 2%;
		margin-left: 24%;
	}

	.container img {
		-webkit-border-radius: 12px; /* Android ≤ 1.6, iOS 1-3.2, Safari 3-4 */
		border-radius: 12px; /* Android 2.1+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 5+ */

		/* useful if you don't want a bg color from leaking outside the border: */
		background-clip: padding-box; /* Android 2.2+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 4+ */
	}
	
	#question { height: 320px; width: 470px; margin:0 auto; display: block; }

	#question img{
	  display:none;
	  position:absolute;
	}
	#question img.active{
	  display:block;
	  margin:0 auto;
	}
<?php if($language == "es_ES") { ?>
		h1 { font-size:27px; }
	<?php } ?>
</style>
</head>

<body>

	<div class="wrap">
		<div class="bg">
			<h1><?php echo _("Checking what you now know... about how animals behave"); ?></h1>
			<br>			<br>
			<p><?php echo _("Answering the following six (6) quiz questions will give you an idea of what you now know and what you still need to study."); ?></p>						<br>			
			<p><?php echo _("Click the NEXT button when you are ready."); ?></p>
			<div id="question">
				<img src="images/15/0.png" class="active"/>
				<img src="images/15/1.png"/>
				<img src="images/15/2.png" />
				<img src="images/15/3.png" />
			</div>		
		</div>

	</div>
	
	<div class="buttons-back" ><a href="14.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="16.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>

	<section id="preloader">

		<section class="selected">
			<strong><?php echo _("Let's check what you now know"); ?></strong>
		</section>

	</section>

<?php require("setlocale.php"); ?>
<script>
$(document).ready(function() {
	setInterval('swapImages()', 1000);
});

function swapImages(){
	var active = $('#question .active');
	var next = ($('#question .active').next().length > 0) ? $('#question .active').next() : $('#question img:first');  
	active.removeClass('active');
	next.addClass('active');
}
</script>
</body>
</html>