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
	<script src="scripts/jquery.wiggle.min.js"></script>
	<script src="scripts/button.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<style>	
		html { background-color: #FFFFFF; }
		body { display: none; }
		p { width: 100%; text-align: left; }	
		h1 { color: #4976A7 }
		.wrap { border-left: 1px dashed #7FD3FF; border-right: 1px dashed #7FD3FF; 	}
		.bg { 
			background: url(images/4/bg.jpg) 0 0 no-repeat;  
			background-size: 100% 100%; 
			width:100%;
			height:100%; 
			position:relative; 
		}
		.container {		margin: 0 0;
		}
		.container img {		display: block;		margin: 0 auto;
			-webkit-border-radius: 12px; /* Android ≤ 1.6, iOS 1-3.2, Safari 3-4 */
			border-radius: 12px; /* Android 2.1+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 5+ */
			/* useful if you don't want a bg color from leaking outside the border: */
			background-clip: padding-box; /* Android 2.2+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 4+ */
		}
		img.next-toggle {  display:none; }	#screen1 img { width: 53% }
		#screen2 { display: none; padding-top: 2%}
		#screen2 img {}	#parentDiv1 div { float:left; height: 280px  ;margin: 0px; padding: 0px; }
		#div1 { width: 230px; }
		#div2 { width: 310px;  }
		#div3 { width: 310px; }	
		#div1 img { height: 280px; }
		#div3 img { width: 280px; }		#parentDiv2 { margin-top: 35% }

		html[dir="rtl"] p { text-align: right; }
		html[dir="rtl"] h1 { font-size:33px; }
		<?php if($language == "es_ES") { ?>
		h1 { font-size:27px; }
	<?php } ?>
	</style>
</head>
<body>

	<div class="wrap">
		<div class="bg">			<h1><?php echo _("Reviewing big ideas... about how animals behave"); ?></h1>
			<div id="screen1">
				<p><?php echo _("Have you ever been told to be on your best behavior? What is behavior and what do parents and teachers mean by that?"); ?></p>
				<p><?php echo _("<span class='key'> Behavior </span> is the way that an organism acts and responds in the environment. In your case, there are many things going on inside and around you. You might feel hungry as soon as you get in the car, or need to use to the bathroom as soon as your teacher starts the lesson. These feelings are internal cues signaling a need you have. The next step is what you do about it, how you respond at this point is your behavior."); ?></p>				
				<div class="container">
					<img src="images/4/children.png" alt="Children">
				</div>		
			</div>
			<div id="screen2">				<div id="parentDiv1">					<div class="div" id="div1">						<img src="images/4/a.png" alt=" Girl">					</div>										<div class="div" id="div2">
			<p><?php echo _("Sometimes those cues come from inside you like hunger, and sometimes they come from the environment, like when your sister pokes you and you feel pain. A cue like this is called a <span class='key'>stimulus</span>."); ?></p>					</div>					
			<div class="div" id="div3">
				<img src="images/4/b.png" alt="Poke">
			</div>				</div>								<div id="parentDiv2">					<div class="container">
			<p><?php echo _("A stimulus is anything that causes a reaction or change in an organism or any part of an organism. Behaviors are actions living things take in <span class='key'>response</span> to stimuli (plural form of stimulus). Stimuli can be either internal or external, and include anything like heat, cold, pain, noise, anything that arouses the senses."); ?></p>						<img src="images/4/c.png" alt="Baby">					</div>				</div>
		</div>
	</div>

</div>
<div class="buttons-back" ><a href="" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
<div class="buttons" ><a href="#screen2" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read more"); ?>" ></a></div>
<div class="buttons" ><a href="5.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
<script>	
	var hash = window.location.hash.slice(1);		
	$(document).ready(function() {		
		if(hash != "") {			
			$('#screen1').hide();			
			$('#screen2').show(function () {				
				$('img.readmore-toggle').fadeOut(function(){					
					$('img.next-toggle').fadeIn();				
				});			
			});		
		}				
		/* Back Transition */		
		$('img.back-toggle').click(function(){			
			if($('#screen1').is(':visible')) {				
				$('img.back-toggle').parent().attr('href','3.php#answer');			
			} else if($('#screen2').is(':visible')) {				
				$('#screen2').fadeOut( function(){					
					$('h1').fadeIn(); 					
					$('#screen1').fadeIn();					
					$('img.readmore-toggle').parent().attr('href','#screen2'); 					
					window.location.hash = '';				
				});				
				$('img.next-toggle').fadeOut( function(){					
					$('img.readmore-toggle').fadeIn();				
				});			
			} 					
		});				
		/* Read More Screen Transition */		
		$('img.readmore-toggle').click(function(){			
			if($('#screen1').is(':visible')) {				
				$('h1').fadeOut();				
				$('#screen1').fadeOut( function(){					
					$('#screen2').fadeIn();					
					$('img.back-toggle').parent().attr('href','#screen1');					
					window.location.hash = '#screen2';				
				});								
				$('img.readmore-toggle').fadeOut(function(){					
					$('img.next-toggle').fadeIn();				
				});			
			}		
		});				
		if($('#screen2').is(':visible')) {			
			$('h1').fadeOut();		
		}	
	});
</script>
<section id="preloader">
	<section class="selected">
		<strong><?php echo _("Crumpling papers..."); ?></strong>
	</section>
</section>
<?php require("setlocale.php"); ?>

</body>
</html>
