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
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" /><link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/nlform-default.css" /><link rel="stylesheet" type="text/css" href="styles/nlform-component.css" /><script src="scripts/nlform-modernizr.custom.js"></script>

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
	input { font-family: 'PlaytimeRegular'; font-size: 35px } 
	#screen1 p { line-height: 45px; font-size: 24px }	
	#list { font-family: 'PlaytimeRegular'; font-size: 24px }	
	#answerSpan { display: none; }
	#answerdiv { display: none; text-align: center }	
	.answerP  { font-size: 24px; line-height: 40px; }
	#answerdiv span { color: #B36BC9; font-size: 24px; text-align: center; width: 100%; }
	.feedback { font-size: 24px }
	
	#screen1 p:last-child  { width: 70%; }
	.answerP img { vertical-align: sub; }
</style>
</head>

<body>

	<div class="wrap">

		<div class="bg">

			<h1 id="h1"><?php echo _("Quiz Question #3"); ?></h1>
			<h1 id="answerSpan"><?php echo _("Quiz Question #3"); ?> - <?php echo _("How did I do?"); ?></h1> 
			
			<div id="screen1">
				<h2><?php echo _("Complete the sentences by selecting the right words from the drop down menus."); ?></h2>
				<form id="nl-form" class="nl-form">					
					<p><?php echo _("The reaction to an occurrence or event is a "); ?><select id="opt1"><option value="1" selected>&#60;<?php echo _("select"); ?>&#62;</option><option value="2"><?php echo _("response"); ?></option><option value="3"><?php echo _("stimulus"); ?></option><option value="4"><?php echo _("mechanical stimulus"); ?></option></select>.</p>					
					<p><?php echo _("Anything that can cause a response is a "); ?><select id="opt2"><option value="1" selected>&#60;<?php echo _("select"); ?>&#62;</option><option value="2"><?php echo _("response"); ?></option><option value="3"><?php echo _("stimulus"); ?></option><option value="4"><?php echo _("mechanical stimulus"); ?></option></select>.</p>						
					<p><?php echo _("Anything that causes a sensation of touch, pain, sound, or temperature is a "); ?><select id="opt3"><option value="1" selected>&#60;<?php echo _("select"); ?>&#62;</option><option value="2"><?php echo _("response"); ?></option>	<option value="3"><?php echo _("stimulus"); ?></option>	<option value="4"><?php echo _("mechanical stimulus"); ?></option>				
					</select>				
					.</p>				
				</form>
			</div>						
			<div id="answerdiv"><p><?php echo _("You answered..."); ?></p>
			<p id="p1" class="answerP"> <?php echo _("The reaction to an occurrence or event is a "); ?><span class="choice1">a </span>.	</p>						
			<p id="p2" class="answerP"> <?php echo _("Anything that can cause a response is a "); ?><span class="choice2">b</span>.</p>
					
			<p id="p3" class="answerP"> <?php echo _("Anything that causes a sensation of touch, pain, sound, or temperature is a "); ?><span class="choice3">c</span>.</p>
				
			<br />				
			<p class="feedback"></p>
			</div>
		</div>

	</div>
	
	<div class="buttons-back" ><a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="checkanswer-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="19.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
<script>
var studentAnswer = '';
var answered = 1;
$(document).ready(function() {
/* screen transition */		
$('img.back-toggle').click(function(){
		if( $('#screen1').is(':visible') ) {
		$('img.back-toggle').parent().attr('href','17.php');	
		} else {	
		$('img.back-toggle').parent().attr('href','18.php');	
		}	
	});		
	$('img.checkanswer-toggle').click(function(e){
	val1 =  $( "#opt1" ).val();	
	val2 =  $( "#opt2" ).val();	
	val3 =  $( "#opt3" ).val();	
	
	if ( val1 != 1 && val2 != 1 && val3 != 1 ){	
	$('#h1').fadeOut( function () {		
		$('#answerSpan').fadeIn();	
	});			
	$(checkAnswer);	
	
	$('img.checkanswer-toggle').fadeOut(function(){ 
		$('img.next-toggle').fadeIn(); });			
		$('#answer').fadeOut(); 		
		} else
			{
				alert('<?php echo _("Please select your answers."); ?>'); 
				e.preventDefault();
			}	
		});
});
function checkAnswer() {	
 a = $("#opt1 option:selected").text();	
 b = $("#opt2 option:selected").text();	
 c = $("#opt3 option:selected").text();	
 
 $('.choice1').html( a );		
 $('.choice2').html( b );		
 $('.choice3').html( c );	
 if ( val1 == '2' && val2 == '3' && val3 == '4' ){	
	$('#screen1').fadeOut( function(){
		$('#answerdiv').fadeIn();		
		});			
	
		$('.feedback').css('color', 'green');
		$('.feedback').html('<?php echo _("Great job! A reaction is a response; the thing that produces a response is a stimulus; and anything that causes sensations of touch, pain, sound or temperature is a special kind of mechanical stimulus."); ?>');	
	
	} else 	{	
		$('#screen1').fadeOut( function(){	
			$('#answerdiv').fadeIn();		
		});			
		$('.feedback').css('color', 'red');	
		$('.feedback').html('<?php echo _("Too bad. A reaction is a response; the thing that produces a response is a stimulus; and anything that causes sensations of touch, pain, sound or temperature is a special kind of mechanical stimulus."); ?>');		
	}	
	
	if (val1 == '2'){
		$('#p1').prepend('<img src="images/others/check.png" />');
		
	} else  { 
			$('#p1').prepend('<img src="images/others/wrong.png" />');	
	    	}
		
	if (val2 == '3'){	
		$('#p2').prepend('<img src="images/others/check.png" />');	
	} else  {	
			$('#p2').prepend('<img src="images/others/wrong.png" />'); 
			}
	
	if (val3 == '4'){		
		$('#p3').prepend('<img src="images/others/check.png" />');	
	} else 	{ 
	$('#p3').prepend('<img src="images/others/wrong.png" />');
	}
	
	if(answered == 0){
		saveAnswer('how-animals-behave-qq3-a',a);		
		saveAnswer('how-animals-behave-qq3-b',b);		
		saveAnswer('how-animals-behave-qq3-c',c);		
		answered = 1;
	}
	
}
</script>	
<script src="scripts/nlform.js"></script>
<script>
 	 var nlform = new NLForm( document.getElementById( 'nl-form' ) );	
</script>	
<section id="preloader"><section class="selected"><strong><?php echo _("Stimulus and response"); ?></strong></section></section>
<?php require("setlocale.php"); ?>
</body>
</html>