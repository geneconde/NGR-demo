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
<style>
	html { background-color: #FFFFFF; }
	body { display: none; }
	h1 { color: #DF5E54 }	
	p { width: 100%; text-align: left; }
	.wrap { 		border-left: 1px dashed #C2E0D6; 		border-right: 1px dashed #C2E0D6; 	}
	.bg { 
		background: url(images/6/bg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}	
	.container img {
		width: 32%; 
		border: solid white;
		display: inline-block;
		margin: 2% auto;
		}
	#screen1 video{	
		display: block;		
		width: 300px;	
		height: 230px;	
		margin-left: 3%;
		}
	img.next-toggle {  display:none; }
	#parentDiv1 { width: 100%; overflow: hidden; }
	#parentDiv1 p { width: 100%; }
	#parentDiv1 div { float: left; }	
	#div1 { width: 63% }	
	#parentDiv2 { overflow: hidden; width: 100%; }
	#parentDiv2 div { float: left; margin-top: 1%;}
	#parentDiv2 p { width: 100%; }
	#div2 { width: 20%; }
	#div3 { width: 56%; }
	#div4 { width: 20%; }	
	#div2 img { width: 100%; padding-top: 20px; }
	#div4 img { width: 100%; padding-top: 20px; }	
	#screen2 { display: none; padding-top: 1%; }
	#screen2 .container { margin-left: 7%; height: 200px; }
	.container div { float: left; margin-left: 2%; }
	.container div video { }	
	#sealVideo, #duckVideo { height: 200px;  }
	
	#container { margin-left: 25% }
	#container img { height: 120px; margin: 0 10px; }

	html[dir="rtl"] p { text-align: right;margin-right:5px; }
	html[dir="rtl"] #screen2 #container { margin-right: 210px; }

	<?php if($language == "es_ES") { ?>
		h1 { font-size:30px; }
		p { font-size:20px; }
	<?php } ?>	
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">			<h1><?php echo _("More big ideas... about how animals behave"); ?></h1>
			<div id="screen1">
				<div id="parentDiv1" >					
				<div id="div1">
						<p><?php echo _("Let's look at behaviors of different organisms."); ?></p>
						<p><?php echo _("Hungry? Microorganisms and plants that use light to make food will automatically move toward light to get more for their food making process (photosynthesis)."); ?>	
						<br />						
						<?php echo _("The Venus fly trap is a plant and makes its own food. However, it lives in poor soil and is healthier if it gets nutrients from insects."); ?></p>	
						</div>
					<div class="container">
						<video controls>
							<source src="videos/6/venus-fly-trap.webm" type="video/webm">
						</video>
					</div>				
				</div>	
				
				<div id="parentDiv2" >		
					<div id="div2">		
						<img src="images/6/a.png" />	
					</div>	
					<div id="div3">				
						<p><?php echo _("Scared? If a skunk is threatened it will warn the predator to stand down. If all the stomping and high tailing does not work, the skunk sprays an odor that will cause even bears to leave them alone."); ?></p>
						<p><?php echo _("When a person is scared, their heart rate increases, and the body releases stress hormones in response to something it sees is dangerous. People show different behavior in response to fear. Some people scream to scare off the one harming the person and to call for help at the same time. What do you do?"); ?></p>	
					</div>	
					
					<div id="div4">
						<img src="images/6/b.png" />
					</div>	
				</div>
			</div>
			<div id="screen2">	
				<p><?php echo _("Animals develop complex behaviors to help them survive in the wild. Those who have the most useful behaviors are more likely to survive and reproduce than those who don't. Those same useful behaviors are passed on to later generations. Eventually, an <span class='key'>inherited behavior</span> becomes common in a population of animals.  Not all behavior is inherited, although some is. The ability to learn is inherited.<span class='key'> Instinctual behavior </span> is any behavior that is inherited and not learned during life."); ?></p>				
				<div class="container">				
				
					<div> 
						<video controls id="sealVideo">
							<source src="videos/6/seal_converted.webm" type="video/webm">
						</video>		
					</div>	
					
					<div>	
						<video controls id="duckVideo">	
							<source src="videos/6/duck.webm" type="video/webm">	
						</video>
					</div>
				</div>		
				<p><?php echo _("Over many generations, dogs have gained abilities that make them desirable to people. They kill pests, help us hunt other animals, and even use their natural hunting abilities to herd our animals. Dogs are even able to learn new behaviors and associate them with words or actions."); ?></p>
				
				<div id="container">
					<img src="images/6/wolf.jpg" alt="Wolf">		
					<img src="images/6/sheep.jpg" alt="Sheep">		
				</div>				
			</div>

		</div>
	</div>

	<div class="buttons-back" ><a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#screen2" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read more"); ?>" ></a></div>
	<div class="buttons" ><a href="7.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	
	<script>	
		var hash = window.location.hash.slice(1);	
		$(document).ready(function() {		
			if(hash == 'screen2') {		
				$('#screen1').hide();		
				$('h1').hide();			
				$('#screen2').show(function () {		
					$('img.readmore-toggle').fadeOut(function(){
					$('img.next-toggle').fadeIn();				
					});			
				});	
			}	
			
			/* screen transition */		
			$('img.back-toggle').click(function(){	
				if( $('#screen1').is(':visible') ) {
					document.location.href= "5.php";		
				} else {	
					$('#screen2').fadeOut(function(){
						$('#screen1').fadeIn(); 
						$('h1').fadeIn();
						});					
						$('img.next-toggle').fadeOut(function(){ 
							$('img.readmore-toggle').fadeIn(); 
							});				
							addHash('');	
					}		
			});			
			$('img.readmore-toggle').click(function(){	
				$('h1').fadeOut();		
					$('#screen1').fadeOut(function(){
					$('#screen2').fadeIn(); 
					$('img.back-toggle').fadeIn(); 	
					});								
					$('img.readmore-toggle').fadeOut(function(){	
						$('img.next-toggle').fadeIn();
					});						
					removeHash();	
					addHash('#screen2');	
				});			
});
</script>

	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Trapping insects..."); ?></strong>
		</section>
	</section>

	<?php require("setlocale.php"); ?>

</body>
</html>
