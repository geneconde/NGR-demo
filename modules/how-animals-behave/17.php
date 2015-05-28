<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(17, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'how-animals-bahave-qq2-a');
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

<script src="scripts/jquery.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/saveanswer.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->
<style>
	html { background-color: #E9F5FC; }
	body { display: none; background-color: #FFFFFF;}	
	p { margin: 0 auto; color: black; }
	.bg { 	background: url(images/bg/qbg.jpg) 0 0 no-repeat; 	background-size: 100% 100%;	width:100%; height:100%; position:relative;	}
	img.next-toggle {  display:none; }
	#answer { display: none; color: red; }
	#answerSpan { display: none; }
	.studentanswer1 { border-radius: 10px; width: 250px; margin: 0 auto; display: block; }
	#answer h2 { color: black; text-align: center; margin-top: 2%}	
	.choices {}
	.choices li {  float: left; width: 50%}
	.choices img { margin-left: 25%; width: 180px; border-radius: 10px; border: solid white; -webkit-transition: all .3s ease;}
	.choices p { }
	.choices img:hover{cursor:pointer;}

	html[dir="rtl"] .choices img { margin-right:25%;margin-left:0; }
	html[dir="rtl"] .choices li {  width: 45%}
	.h2cr1 img{ vertical-align: sub; }
	
	<?php if($language == 'zh_CN') { ?>
		.choices img { width: 165px;margin-left:25%;margin-right:0; }
		.choices li {  width: 41%; float:none; display:inline-block;margin-left: 50px;}
		.choices li:nth-child(n+3) {margin-top: 30px;}
	<?php } ?>
	</style>
</head>
<body>

	<div class="wrap">
		<div class="bg">

			<h1 id="h1"><?php echo _("Quiz Question #2"); ?></h1>
			<h1 id="answerSpan"><?php echo _("Quiz Question #2"); ?> - <?php echo _("How did I do?"); ?></h1> 
			<div id="screen1">
					<div id="form">
						<h2><?php echo _("Which behavior of the bat is most likely a learned behavior?"); ?></h2>
							<div class="choices">	
								<ul>
									<li><img class="q1img" id="q1imga" src="images/17/a.jpg"><p id="q1pa"><?php echo _("Sleeping upside down"); ?></p></li>
									<li><img class="q1img" id="q1imgb" src="images/17/b.jpg"><p id="q1pb"><?php echo _("Flying to move around"); ?></p></li>
									<li><img class="q1img" id="q1imgc" src="images/17/c.jpg"><p id="q1pc"><?php echo _("Avoiding humans"); ?></p></li>
									<li><img class="q1img" id="q1imgd" src="images/17/d.jpg"><p id="q1pd"><?php echo _("Using sound to find objects"); ?></p></li>
								</ul>
							</div>
							<div id="c1"> 
							</div>
							
					</div>
					<div id="answer">
						<p><?php echo _("You answered..."); ?></p>
						<img class="studentanswer1" src="">
						<p class="choice1"></h2>
						<p class="h2cr1"></p>
					</div>
			</div>
		</div>

	</div>
	
	<div class="buttons-back" ><a href="" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="checkanswer-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="18.php" class="wiggle-right"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
<script>
	var studentAnswer ='';
	var answered = <?php echo $answered; ?>;
	$(document).ready(function() {	
	selectedImage ="";	
	
	/* screen transition */		
	$('img.back-toggle').click(function(){	
	if( $('#h1').is(':visible') ) {		
		$('img.back-toggle').parent().attr('href','16.php');	
		} else {		
		$('img.back-toggle').parent().attr('href','17.php');	
		}	
		});	
		
		$('img.checkanswer-toggle').click(function(e){	
		if ( selectedImage != "" ){		
			if( $('#screen1').is(':visible') ) {	
			$('#h1').fadeOut( function (){			
			$('#answerSpan').fadeIn();			
			});									
			$('#c1').fadeOut();				
			$('#form').fadeOut(function(){			
			$('#answer').fadeIn();					
			$(checkAnswer);		
		});					
		$('img.back-toggle').fadeIn(); 			
		$('img.checkanswer-toggle').fadeOut(); 	
		$('img.next-toggle').fadeIn(); 				
		} else if ( $('#answer').is(':visible') ) {		
		$('h1').fadeOut();					
		$('img.checkanswer-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); });	
		$('#answer').fadeOut(function(){ 					
		$('img.back-toggle').fadeIn();				
		$('img.back-toggle').parent().attr('href','#answer');	
		document.location.href= "6.php";		
		});			
		} 			
		} else{ alert('<?php echo _("Please select your answers."); ?>');  e.preventDefault();}	
		});		
		$('.q1img').on('click',function(){	
		if ($(this).attr('id') == 'q1imga') {	
			selectedImage ="A";		
			$('#q1imga').css('border-color', '#1F001D'); $('#q1pa').css('color', '#1F001D');	
			$('#q1imgb, #q1imgc, #q1imgd').css('border-color', 'white'); 	
			// $('#q1pb, #q1pc, #q1pd').css('color', 'white');		
			
		} else if ($(this).attr('id') == 'q1imgb'){		
			selectedImage ="B";		
			$('#q1imgb').css('border-color', '#1F001D'); $('#q1pb').css('color', '#1F001D');	
			$('#q1imga, #q1imgc, #q1imgd').css('border-color', 'white'); 	
			// $('#q1pa, #q1pc, #q1pd').css('color', 'white');			
		
		} else if ($(this).attr('id') == 'q1imgc'){		
			selectedImage ="C";		
			$('#q1imgc').css('border-color', '#1F001D'); $('#q1pc').css('color', '#1F001D');	
			$('#q1imgb, #q1imga, #q1imgd').css('border-color', 'white'); 	
			// $('#q1pb, #q1pa, #q1pd').css('color', 'white');	
		
		} else if ($(this).attr('id') == 'q1imgd'){	
			selectedImage ="D";			
			$('#q1imgd').css('border-color', '#1F001D'); $('#q1pd').css('color', '#1F001D');
			$('#q1imgb, #q1imgc, #q1imga').css('border-color', 'white'); 	
			// $('#q1pb, #q1pc, #q1pa').css('color', 'white');	
			}	
		});
		});	
		function checkAnswer() {	
		if (selectedImage == "A"){ 	
			$('.h2cr1').css('color', 'red');
			$('.studentanswer1').attr("src","images/17/a.jpg");		
			$('.choice1').html('<?php echo _("Sleeping upside down"); ?>');	
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("No, this is instinctive, so it is an inherited behavior."); ?>');	
		
		} else if (selectedImage == "B"){	
			$('.h2cr1').css('color', 'red');		
			$('.studentanswer1').attr("src","images/17/b.jpg");	
			$('.choice1').html('<?php echo _("Flying to move around"); ?>');
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("No, flying is an instinct. This is an inherited behavior, not a learned one."); ?>');		
		
		}  else if (selectedImage == "C"){	
			$('.h2cr1').css('color', 'green');	
			$('.studentanswer1').attr("src","images/17/c.jpg");		
			$('.choice1').html('<?php echo _("Avoiding humans"); ?>');	
			$('.h2cr1').html('<img src="images/others/check.png" /> <?php echo _("Correct. Bats have to interact with their environment and learn to avoid humans."); ?>');	
		
		}  else if (selectedImage == "D"){		
			$('.h2cr1').css('color', 'red');	
			$('.studentanswer1').attr("src","images/17/d.jpg");	
			$('.choice1').html('<?php echo _("Using sound to find objects"); ?>');	
			$('.h2cr1').html('<img src="images/others/wrong.png" /><?php echo _(" No, bats do not have strong eyesight and they use sound and vibrations to find objects."); ?>');	
		}
		
		studentAnswer = selectedImage;		
		if(answered == 0){
			saveAnswer('how-animals-behave-qq2-a',studentAnswer);		
			answered = 1;
		}
	}
	
	
</script>
	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Bats, bats, and more bats!"); ?></strong>
		</section>
	</section>
<?php require("setlocale.php"); ?>
</body>
</html>
