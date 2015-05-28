<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once 'locale.php';
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
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/modernizr.min.js"></script>
<style>
	html { background-color: #FFFFFF; }
	body { display: none; }	
	html,body { height:100%; padding:0; margin:0; min-height: 450px;}
	h1 {color: #AE1F23; text-align: center; padding-top: 2%}
	h2 { font-weight: normal; font-size: 18px; margin-left:30px; margin-top: 40px; text-align: left; color:#5F623D; }
	a { text-decoration: none; }	
	.wrap { 			
		border-left: 1px dashed #70A44F; 			
		border-right: 1px dashed #70A44F;	
	}	
	.bg { 
		background: url(images/1/bg.png) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}	p { width:100% }	
	#start {
		background: url(images/1/sign.png) 0 0 no-repeat;
		width: 175px;
		height: 144px;
		padding: 0px;
		position: absolute;
		bottom: 0;
		margin-left: 0%;
		top: 76%;
		right: 10%;
	}	
	#start a { font-size: 45px; color: #6B2000; position: relative; left: 21%; top: 5%; }
	#start img { position: relative; top: 10%; left: 25%; cursor: pointer; }
	.buttons { position: absolute; bottom: 2%; right: 2%; }

	html[dir="rtl"] #start a { left:-32%;top:10%; }
	html[dir="rtl"] #start img { top:48%; left:15%; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<h1><?php echo _("Welcome to the How Animals Behave module, "); ?> <?php echo ($user->getFirstName() . "!"); ?></h1>								 
			<div id="start" title="<?php echo _("Start"); ?>">
				<a href="2.php"><?php echo _("Start"); ?></a>
				<img src="images/1/arrow.png" id="arrow">
			</div>				
		</div>
	</div>
	<section id="preloader"><section class="selected"><strong> <?php echo _("Let's begin"); ?> </strong></section></section>
	<script>
	$('#arrow').on('click', function() {
		document.location.href = "2.php";
	});
	</script>
	<?php require("setlocale.php"); ?>
</body>
</html>