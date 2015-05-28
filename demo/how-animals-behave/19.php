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
<script src="scripts/button.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/saveanswer.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->

<style>
	html { background-color: #E9F5FC; }
	body { display: none; background-color: #FFFFFF;}	
	p {width: 95%;text-align:left;}
	h2 {text-align:left;}
	.bg { 
		background: url(images/bg/qbg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}

	img.next-toggle {  display:none; }
	#answerSpan { display: none;}	
	#qAnswer { display: none }
	#qAnswer p { text-align: center; }
	.choices li{	  
		font-size: 24px;
		margin-left: 45px;
		padding: 0px;
	    text-indent:-50px;
	}		
	.choices { width: 95% }

#radio { min-height: 150px;}
#radio ul { list-style: none; text-align: left; margin: 0; padding: 0;  }
#radio li { padding: 7px 0px;}
input[type="radio"]{ opacity: 0; position: absolute; filter: alpha(opacity=0); margin:5px 0 0 5px; }
input[type="radio"]  + label span{ background: url('images/19/sprite.png')left top no-repeat; position: relative; margin-right:5px; padding: 0 0 0 34px !important; !important; cursor: pointer; max-width: 39px; min-height: 23px; display:inline-block; z-index:0;  overflow: hidden; vertical-align:middle; margin-top:-7px; background-position-x: 2px; }
input[type="radio"]:checked + label span { background-position: -31px 0; }
label { cursor: pointer; }

html[dir="rtl"] #radio ul { text-align: right; }
html[dir="rtl"] .choices li { margin-left:0;text-indent: -15px; }
html[dir="rtl"] p { text-align: right; }
html[dir="rtl"] #qAnswer p { text-align:center; }
html[dir="rtl"] h2 { text-align: right; }
.h2cr img { vertical-align: sub; }
</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<h1 id="h1"><?php echo _("Quiz Question #4"); ?></h1> 			
			<h1 id="answerSpan"><?php echo _("Quiz Question #4"); ?> - <?php echo _("How did I do?"); ?></h1> 
			<div id="screen1">
				<p><?php echo _("A small city's water treatment plant is located near a small river, which is the home to a type of bass popular with fishermen. The plant takes a majority of its water from the river. During warmer months, the number of bass in the river decreases by 6 %."); ?></p>
				<h2><?php echo _("Which of the following is probably the most reasonable stimulus for decreased bass population in the lake?"); ?></h2>
					<div class="choices">
						<div id="radio">
							<ul>
								<li id="liA">
									<input type="radio" id="a" name="answer" value="A"/>
									<label for="a"><span></span>A. <?php echo _("Bass don’t like the loud sounds of the machines in the water treatment plant.");?></label>
								</li>
								<li id="liB">
									<input type="radio" id="b" name="answer" value="B"/>
									<label for="b"><span></span>B. <?php echo _("More water is used by consumers during warmer months, which decreases the amount of water the bass can live in.");?></label>
								</li>
								<li id="liC">
									<input type="radio" id="c" name="answer" value="C"/>
									<label for="c"><span></span>C. <?php echo _("Less water is filtered by the water treatment plant during warmer months, allowing the bass to travel upstream.");?></label>
								</li>
								<li id="liD">
									<input type="radio" id="d" name="answer" value="D"/>
									<label for="d"><span></span>D. <?php echo _("None of the above are reasonable stimuli.");?></label>
								</li>							
							</ul>
						</div>
					</div>
			</div>						
			<div id="qAnswer">
				<p><?php echo _("You answered..."); ?></p>	
				<p class="choice"></p>				
				<p class="h2cr"></p>	
			</div>
		</div>

	</div>
	
	<div class="buttons-back" ><a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="checkanswer-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="20.php" class="wiggle-right"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	<script>
	var answered = 1;
	var studentAnswer = '';
	$(document).ready(function() {
	/* screen transition */	
	$('img.back-toggle').click(function(){
		if( $('#screen1').is(':visible') ) {	
			$('img.back-toggle').parent().attr('href','18.php');
		} else {			
			$('img.back-toggle').parent().attr('href','19.php');	
		}	
	});	
	
	$('img.checkanswer-toggle').click(function(e){
		if ( $("input:radio[name=answer]").is(":checked") ){

			$('#h1').fadeOut( function (){				
				$('#answerSpan').fadeIn();		
			});								
				$(checkAnswer);					
				$('img.back-toggle').fadeIn(); 	
				$('img.checkanswer-toggle').fadeOut(); 	
				$('img.next-toggle').fadeIn(); 
		} else { alert("<?php echo _("Please select your answers."); ?>");e.preventDefault(); }	
	});		

	});
	function checkAnswer(){
		var val= $('input[type="radio"]:checked').val();
		if (val=="A"){
			$('#screen1').fadeOut(function(){
				$('.h2cr').css('color', 'red');	
				$('.choice').html('A. <?php echo _("The Bass don’t like the loud sounds of the machines in the water treatment plant."); ?>');	
				$('.h2cr').html('<img src="images/others/wrong.png" /> <?php echo _("No, that wouldn’t be specific to only the warm months."); ?>');
				$('#qAnswer').fadeIn();		
			});	
		}else if (val=="B"){	
			$('#screen1').fadeOut(function(){	
				$('.h2cr').css('color', 'green');		
				$('.choice').html('B. <?php echo _("More water is used by consumers during warmer months, which decreases the amount of water the bass can live in."); ?>');
				$('.h2cr').html('<img src="images/others/check.png" /> <?php echo _("Correct, not all bass can adapt to this change in their habitat. The plant takes more water and the amount left for the bass is not enough for all of them."); ?>');	
				$('#qAnswer').fadeIn();
			});		
		}else if (val=="C"){
			$('#screen1').fadeOut(function(){		
				$('.h2cr').css('color', 'red');	
				$('.choice').html('C. <?php echo _("Less water is filtered by the water treatment plant during warmer months, allowing the bass to travel upstream."); ?>');	
				$('.h2cr').html('<img src="images/others/wrong.png" /> <?php echo _("No, it seems more water would be used by the plant. We do not have information about the ability the bass have to travel upstream."); ?>');	
				$('#qAnswer').fadeIn();		
			});	
		}else {		
			$('#screen1').fadeOut(function(){	
				$('.h2cr').css('color', 'red');		
				$('.choice').html('D. <?php echo _("None of the above are reasonable stimuli."); ?>');	
				$('.h2cr').html('<img src="images/others/wrong.png" /> <?php echo _("No, if anything all of the above stimuli are reasonable."); ?>');
				$('#qAnswer').fadeIn();	
			});	
		}
		studentAnswer = val;
		if(answered == 0){
			saveAnswer('how-animals-behave-qq4-a',studentAnswer);		
			answered = 1;
		}
	}
	</script>
	
	
	<section id="preloader">

		<section class="selected">
			<strong><?php echo _("Flying fishes"); ?></strong>
		</section>
	</section>
<?php require("setlocale.php"); ?>
</body>
</html>