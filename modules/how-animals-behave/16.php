<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(16, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'how-animals-bahave-qq1-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
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
<link rel="stylesheet" type="text/css" href="styles/hexaflip.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/saveanswer.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->
<style>	
	html { background-color: #E9F5FC; }
	body { display: none; background-color: #FFFFFF;}	
	p { margin: 0 auto; }	
	.bg { 
		background: url(images/bg/qbg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}
	img.next-toggle {  display:none; }
	#answerdiv { display: none; color: red; text-align: center }	
	.choices { height: 180px; margin-left: 2%;}		.choices li{	
		list-style-type: none;	
		margin-top: 2%;	
		font-size: 24px;	
		line-height: 25px;	
	}	
	#answerSpan { display: none; }
	#hexaflip { margin: 0 auto; }
	.h2cr img { vertical-align: sub; }

	html[dir="rtl"] .h2cr img { margin-left: 10px; }
</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<h1 id="h1"><?php echo _("Quiz Question #1"); ?></h1>
			<h1 id="answerSpan"><?php echo _("Quiz Question #1"); ?> - <?php echo _("How did I do?"); ?></h1> 
			
			<div id="screen1">
					<h2><?php echo _("Choose the <span class='blink'> incorrect </span> statement from the following."); ?></h2>
						<div class="choices">	
							<ul>
								<li id="a"><?php echo _("A. Organisms’ behavior occurs as a reaction to a stimulus."); ?></li>
								<li id="b"><?php echo _("B. Animals are not capable of learned behavior."); ?></li>
								<li id="c"><?php echo _("C. The brain is part of the central nervous system."); ?></li>
								<li id="d"><?php echo _("D. Neurons are all over the body."); ?></li>
							</ul>
						</div>
						
					<p><?php echo _("Rotate or flip the 3D box below either up or down to set your answer."); ?><p>
					<div id="hexaflip"></div>
			</div>
			
			<div id="answerdiv">
				<p><?php echo _("You answered..."); ?></p>
				<img class="studentanswer" src="">
				<p class="choice"></p>
				<p class="h2cr"></p>
			</div>
		</div>

	</div>
	
	<div class="buttons-back" ><a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="17.php" class="wiggle-right"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	
	<script src="scripts/hexaflip.js"></script>	
	<script src="scripts/blink.js"></script>
	<script>	
	var answered = <?php echo $answered; ?>;
	var studentAnswer = '';
	$(document).ready(function() {	
	$('.blink').blink({ speed: 500, blinks: 1000 });	
	/* screen transition */		
	$('img.back-toggle').click(function(){	
		if( $('#screen1').is(':visible') ) {	
			$('img.back-toggle').parent().attr('href','15.php');
		} else {
			$('img.back-toggle').parent().attr('href','16.php');	
		}	
	});	
	
	$('img.check-toggle').click(function(){
		$('#h1').fadeOut( function (){	
			$('#answerSpan').fadeIn();	
		});					
	$('#screen1').fadeOut(function(){
		$('#answerdiv').fadeIn( function (){
			save();
		});				
			$('img.check-toggle').fadeOut();	
			$('img.next-toggle').fadeIn();		
	});								
	var hexavalue = hexa.getValue();	
	
	if (hexavalue == './images/16/a.jpg') {	
		$('.h2cr').css('color', 'red');		
		$('.studentanswer').attr("src","images/16/a.jpg");	
		$('.choice').html('<?php echo _("Organisms’ behavior occurs as a reaction to a stimulus."); ?>');	
		$('.h2cr').html('<img src="images/others/wrong.png" /> <?php echo _("No. Stimulus from inside or outside the organism triggers it to respond."); ?>');
		studentAnswer = 'A';
	}					
	if (hexavalue == './images/16/b.jpg') {	
		$('.h2cr').css('color', 'green');		
		$('.studentanswer').attr("src","images/16/b.jpg");	
		$('.choice').html('<?php echo _("Animals are not capable of learned behavior."); ?>');	
		$('.h2cr').html('<img src="images/others/check.png" /> <?php echo _("That’s the one... Many animals certainly are able to learn."); ?>');	
		studentAnswer = 'B';
	}	
	
	if (hexavalue == './images/16/c.jpg') {			
			$('.h2cr').css('color', 'red');		
			$('.studentanswer').attr("src","images/16/c.jpg");		
			$('.choice').html('<?php echo _("The brain is part of the central nervous system."); ?>');		
			$('.h2cr').html('<img src="images/others/wrong.png" /><?php echo _("This one is true. The brain is part of the central nervous system."); ?>');		
			studentAnswer = 'C';
	}
	
	if (hexavalue == './images/16/d.jpg') {	
			$('.h2cr').css('color', 'red');		
			$('.studentanswer').attr("src","images/16/d.jpg");	
			$('.choice').html('<?php echo _("Neurons are all over the body."); ?>');	
			$('.h2cr').html('<img src="images/others/wrong.png" /> <?php echo _("No. Neurons, or nerve cells, are located all over the body to send and receive messages to and from the brain."); ?>');	
			studentAnswer = 'D';
		}				
	});	
	
	var hexa;	
	set1 = ['./images/16/a.jpg','./images/16/b.jpg','./images/16/c.jpg','./images/16/d.jpg'];    
    hexa = new HexaFlip(document.getElementById('hexaflip'), { set: set1 }, { size: 200 });
	
	function save(){
		if(answered == 0){	
		saveAnswer('how-animals-behave-qq1-a',studentAnswer);		
		answered = 1;
		}
	}
});	
</script>
	<section id="preloader">		<section class="selected">			<strong><?php echo _("And the first quiz question is..."); ?></strong>		</section>	</section>
<?php require("setlocale.php"); ?>
</body>
</html>
