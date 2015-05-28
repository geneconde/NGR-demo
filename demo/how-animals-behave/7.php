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

<script src="scripts/jquery.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/blink.js"></script>
<script src="scripts/saveanswer.js"></script>


<style>
	html { background-color: #FFFFFF; }
	body { display: none; }
	img.next-toggle {  display:none; }	p { width: 100% }
	.bg { 
		background: url(images/bg/qbg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}			
	#questionA, #questionB { overflow: hidden; background-color: rgba(255, 255, 212, .3); margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; 		border-radius: 10px; margin-bottom: 10px; padding: 0 10px; width: 97%;	}
	#qaAnswer { display: none; }	#qbAnswer { display: none; }	
	#answerSpan { display: none; }
	.studentanswer1 { display: block; margin: 0 auto; width: 155px}	
	#q1 { margin: 0px; padding: 0px;}
	#q1 li{ margin-top: 10px; font-size: 24px; line-height: 19px; padding: 0px; list-style-type: none; }
	
	#questionB { min-height: 220px }
	#questionB li{ font-size: 24px; line-height: 40px; padding: 0px; list-style-type: none; float: left}
	#c1 { margin-top: 15%; width: 100%; text-align: center }
	#c1 p{ font-weight: normal; color: #black; font-size: 24px; text-align: center;}
	
	#q1 img { width: 23%; float: left; border: solid  white; border-radius: 10px; margin: 0 4px; -webkit-transition: all .3s ease; /* Fade to color for Chrome and Safari */ }
	#q1 img:hover { cursor: pointer; }
	
	<!--ul { padding: 1%}	
	input[type="radio"] {
		display:none;
	}
	input[type="radio"] + label {
		font-size:24px;
	}
	input[type="radio"] + label span {
		display:inline-block;
		width:35px;
		height:35px;
		margin:-1px 4px 0 0;
		vertical-align:middle;
		background:url('images/7/unchecked.png') no-repeat;
		cursor:pointer;
	}
	input[type="radio"]:checked + label span {
		background:url('images/7/checked.png') no-repeat;
	}-->
	#instruction {color:#4976A7;}
	
#radio { min-height: 150px; margin:10px 0 0 10px;  }
#radio ul { list-style: none; text-align: left; margin: 0; padding: 0;  }
#radio li { padding: 7px 0px;}

input[type="radio"]{ opacity: 0; position: absolute; filter: alpha(opacity=0); margin:5px 0 0 5px; }
input[type="radio"]  + label span{ background: url('images/7/sprite.png')left top no-repeat; position: relative; margin-right:5px; padding: 0 0 0 3px !important; !important; cursor: pointer; line-height: 40px; max-width: 39px; min-height: 38px; display:inline-block; z-index:0;  overflow: hidden; vertical-align:middle; margin-top:-15px; background-position-x: 2px; }
input[type="radio"]:checked + label span { background-position: 2px 0; }
label { cursor: pointer; }

html[dir="rtl"] #questionB li { float:right; width: 90%; }
html[dir="rtl"] #qbAnswer p { width: 95%; }
html[dir="rtl"] #qaAnswer p { width: 95%; }
html[dir="rtl"] #instruction { text-align: right; }
.h2cr1 img, .h2cr2 img { vertical-align: sub; }
</style>
</head>

<body>

	<div class="wrap">
		<div class="bg">
			<h1 id="h1"><?php echo _("Quick Check #2"); ?></h1>			
			<h1 id="answerSpan"><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?") ?></h1>			
			<div id="screen1">				
			<div id="questionA">					
				<h2><?php echo _("Question A. Which of the following behaviors is most likely inherited, rather than learned?"); ?></h2>
				<div id="q1">
					 <p id="instruction"><?php echo _("Click each image to view the corresponding descriptions."); ?></p>
						<ul>
							<li><img class="q1img" id="q1imga" src="images/7/a.jpg"></li>
							<li><img class="q1img" id="q1imgb" src="images/7/b.jpg"></li>
							<li><img class="q1img" id="q1imgc" src="images/7/c.jpg"></li>
							<li><img class="q1img" id="q1imgd" src="images/7/d.jpg"></li>
						</ul>
				</div>
				
				<div id="c1"> 
					<p id="c1p"><?php echo _("Select an image"); ?></p>
				</div>
				
				<div id="qaAnswer">
					<p><?php echo _("You answered..."); ?></p>
					<img class="studentanswer1" src="images/7/a.jpg">
					<p class="choice1"></p>
					<p class="h2cr1"></p>
				</div>								
			</div>
				
			<div id="questionB">
				<h2><?php echo _("Question B. Click on the statement that is <span class='blink'>not</span> correct."); ?></h2>						
				<div id="q2li">
					<ul>
						<li id="liA"><input type="radio" id="a" name="answer" value="A"/>
							<label for="a"><span></span><?php echo _("Useful behaviors that help organisms survive are passed on to later generations."); ?></label></li>
						<li id="liB"><input type="radio" id="b" name="answer" value="B"/>
							<label for="b"><span></span><?php echo _("Plants and animals will move to get enough sunlight and food."); ?></label></li>
						<li id="liC"><input type="radio" id="c" name="answer" value="C"/>
							<label for="c"><span></span><?php echo _("All behavior is inherited and it is passed on from generation to generation."); ?></label></li>
						<li id="liD"><input type="radio" id="d" name="answer" value="D"/>
							<label for="d"><span></span><?php echo _("All animals respond differently to their internal needs and changes in the environment."); ?></label></li>
					</ul>					
				</div>						
				<div id="qbAnswer">							
					<p><?php echo _("You answered..."); ?></p>							
					<p class="choice2"></p>							
					<p class="h2cr2"></p>						
					</div>
				</div>
			</div>						
		</div>
	</div>
	
	<div class="buttons-back" ><a href="6.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="checkanswer-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="8.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	
	
<script>
var answered = 1;
var studentAnswer = '';
var studentAnswer2 = '';
	$(document).ready(function() {
		selectedImage ="";
		
		/* screen transition */
		$('img.back-toggle').click(function(){
			if( $('#answerSpan').is(':visible') ) {
				$('img.back-toggle').parent().attr('href','7.php');

			} else  {
				$('img.back-toggle').parent().attr('href','6.php#screen2');
			}
			
		});
		
		$('img.checkanswer-toggle').click(function(e){
			
			if ( $("input:radio[name=answer]").is(":checked") && selectedImage != "" ){
				$('#h1').fadeOut();
				$('#c1').fadeOut(); 
				
				$('#q2li').fadeOut();
				
				$('#q1').fadeOut(function(){
					$('img.back-toggle').fadeIn(); 
					$('img.back-toggle').parent().attr('href','7.php');
	
					$(checkAnswers);
					$('#qaAnswer').fadeIn();
					$('#answerSpan').fadeIn();
	
				});
				
				$('img.checkanswer-toggle').fadeOut(); 
				$('img.next-toggle').fadeIn(); 
			} else { alert('<?php echo _("Please select your answers."); ?>');e.preventDefault(); }
		});


		$('.q1img').on('click',function(){  
			if ($(this).attr('id') == 'q1imga') {			
				selectedImage ="A";			
				$('#c1p').html("<?php echo _("Monarch butterflies require at least three generations to migrate from Canada and the northern US to Mexico and back each year."); ?>");			
				$('#q1imga').css('-webkit-filter', 'none');			
				$('#q1imga').css('border-color', 'orange');				
				$('#q1imgb').css('border-color', 'white');				
				$('#q1imgc').css('border-color', 'white');				
				$('#q1imgd').css('border-color', 'white');		  
			} else if ($(this).attr('id') == 'q1imgb'){			
				selectedImage ="B";			
				$('#c1p').html("<?php echo _("Bears know which foods to eat by watching their mothers for 2-3 years after birth."); ?>");			
				$('#q1imgb').css('-webkit-filter', 'none');			
				$('#q1imgb').css('border-color', 'orange');				
				$('#q1imga').css('border-color', 'white');				
				$('#q1imgc').css('border-color', 'white');				
				$('#q1imgd').css('border-color', 'white');		  
			} else if ($(this).attr('id') == 'q1imgc'){			
				selectedImage ="C";			
				$('#c1p').html("<?php echo _("After weeks of training, dogs are able to find truffles, an underground type of mushroom, for their owners."); ?>");			
				$('#q1imgc').css('-webkit-filter', 'none');			
				$('#q1imgc').css('border-color', 'orange');				
				$('#q1imgb').css('border-color', 'white');				
				$('#q1imga').css('border-color', 'white');				
				$('#q1imgd').css('border-color', 'white');		  
				} else if ($(this).attr('id') == 'q1imgd'){			
				selectedImage ="D";			
				$('#c1p').html("<?php echo _("By the time they are four years old, crows react differently to as many as 300 different people."); ?>");			
				$('#q1imgd').css('-webkit-filter', 'none');			
				$('#q1imgd').css('border-color', 'orange');				
				$('#q1imgb').css('border-color', 'white');				
				$('#q1imgc').css('border-color', 'white');				
				$('#q1imga').css('border-color', 'white');		  
				}
		});
		$('.blink').blink({ speed: 500, blinks: 1000 });
	});
	
	function checkAnswers() {

		if (selectedImage == "A"){ 
			$('.h2cr1').css('color', 'green');
			$('.studentanswer1').attr("src","images/7/a.jpg");
			$('.choice1').html('<?php echo _("Monarch butterflies require at least three generations to migrate from Canada and the northern US to Mexico and back each year."); ?>');
			$('.h2cr1').html('<img src="images/others/check.png" /> <?php echo _("Yes! The second generation of Monarchs has never been to their destination, nor as the third generation."); ?>');	
		  } else if (selectedImage == "B"){
			$('.h2cr1').css('color', 'red');
			$('.studentanswer1').attr("src","images/7/b.jpg");
			$('.choice1').html('<?php echo _("Bears know which foods to eat by watching their mothers for 2-3 years after birth."); ?>');
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("Not this one. The little bears are learning from their moms."); ?>');	
		  }  else if (selectedImage == "C"){
			$('.h2cr1').css('color', 'red');
			$('.studentanswer1').attr("src","images/7/c.jpg");
			$('.choice1').html('<?php echo _("After weeks of training, dogs are able to find truffles, an underground type of mushroom, for their owners."); ?>');
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("No... The key word here is training. That’s learning."); ?>');	
		  }  else if (selectedImage == "D"){
			$('.h2cr1').css('color', 'red');
			$('.studentanswer1').attr("src","images/7/d.jpg");
			$('.choice1').html('<?php echo _("By the time they are four years old, crows react differently to as many as 300 different people."); ?>');
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("If it takes time, it’s learning. This time, it takes years."); ?>');	
		  }
						  
		var val= $('input[type="radio"]:checked').val();
		
			$('#qbAnswer').fadeIn();
			if (val=="A"){							
				$('.h2cr2').css('color', 'red');							
				$('.choice2').html('<?php echo _("Useful behaviors that help organisms survive are passed on to later generations."); ?>');							
				$('.h2cr2').html('<img src="images/others/wrong.png" /> <?php echo _("Not quite. The complex behaviors they have developed caused them to stay alive. These behaviors take time (generations) to really be part of the organism."); ?>');	
			}else if (val=="B"){							
				$('.h2cr2').css('color', 'red');							
				$('.choice2').html('<?php echo _("Plants and animals will move to get enough sunlight and food."); ?>');							
				$('.h2cr2').html('<img src="images/others/wrong.png" /> <?php echo _("Not quite. The internal cue for hunger is the stimulus, they respond by moving to get more sunlight, or by getting food."); ?>');		
			}else if (val=="C"){							
				$('.h2cr2').css('color', 'green');							
				$('.choice2').html('<?php echo _("All behavior is inherited and it is passed on from generation to generation."); ?>');							
				$('.h2cr2').html('<img src="images/others/check.png" /><?php echo _("Correct! Some behavior is learned, not all behavior is inherited."); ?>');		
			}else if (val=="D"){							
				$('.h2cr2').css('color', 'red');							
				$('.choice2').html('<?php echo _("All animals respond differently to their internal needs and changes in the environment."); ?>');							
				$('.h2cr2').html('<img src="images/others/wrong.png" /> <?php echo _("Not quite. Animals respond differently for example to temperature change: some hibernate, some migrate."); ?>');		
			}				
		
		studentAnswer = selectedImage;
		studentAnswer2 = val;
		if(answered == 0){
			saveAnswer('how-animals-behave-qc2-a',studentAnswer);
			saveAnswer('how-animals-behave-qc2-b',studentAnswer2);
			answered = 1;
		}
	}
</script>

	
	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Inherited or learned?"); ?></strong>
		</section>
	</section>

	<?php require("setlocale.php"); ?>

</body>
</html>
