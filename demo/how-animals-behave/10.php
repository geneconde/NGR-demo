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
	p { width: 100%; text-align: left; }	
	h1 { color: #0776A8 }
	.wrap {	border-left: 1px dashed #E0ACB6; 	border-right: 1px dashed #E0ACB6; 	}	
	.bg { 
		background: url(images/10/bg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}
	.container { margin: 2% 0; }
	.container img {		display: block; margin-left: auto; margin-right: auto;
		-webkit-border-radius: 12px; /* Android ≤ 1.6, iOS 1-3.2, Safari 3-4 */
		border-radius: 12px; /* Android 2.1+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 5+ */
		/* useful if you don't want a bg color from leaking outside the border: */
		background-clip: padding-box; /* Android 2.2+, Chrome, Firefox 4+, IE 9+, iOS 4+, Opera 10.50+, Safari 4+ */
	}
	img.next-toggle {  display:none; }
	#screen1 img { width: 35% }	
	#screen2 { display: none; }
	#screen2 .container img { display: inline; width: 35%; margin: 0 auto; }
	#screen2 .container { margin: 0 15%; width: 100% }

	html[dir="rtl"] p { text-align: right; }
	html[dir="rtl"] #screen2 p:last-child { margin-right: 60px; width: 95%; }
	<?php if($language == "es_ES") { ?>
		h1 { font-size:30px; }
		#screen2 p:last-child { width:94%; }
	<?php } ?>
</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">			
		<h1><?php echo _("More big ideas... about how animals behave"); ?></h1>
			<div id="screen1">				
				<p><?php echo _("Your body has a network, and it works just like the network that makes a cell phone work. When you send a text or make a cell phone call, the first thing that happens is that you touch your phone in a pattern, and the touch-sensitive keypad translates into an electronic message. That message is then transmitted through a complex system of radio towers, microwave relays, cable lines, and even satellites. Eventually, it is received by the cell phone you were calling, where it is translated back into the message you meant to send."); ?></p>						
				<div class="container">					
					<img src="images/10/network.png">				
				</div>				
			</div>
			<div id="screen2">				
				<br>
				<p><?php echo _("Your nervous system works the same way. A group of sensitive cells somewhere in your body is stimulated by something from the outside world. These nerve cells respond and send a tiny electrical signal to the brain. Nerve cells are called <span class='key'> neurons</span>. Once in the brain, the signal is interpreted by the brain. The sensation may be one of sight, sound, smell, taste, or touch."); ?></p> 				
				<div class="container">
					<img src="images/10/a.png" alt="Nervous System">
					<img src="images/10/b.png" alt="Nervous System">
				</div>
				<p><?php echo _("After the brain makes sense of the stimulus, it responds by creating a memory, and often sending a response signal out to the body. The response works like the stimulus, only in reverse. A message in the form of an electrical signal goes out and causes muscle cells to contract, making the body move."); ?></p>
			</div>
		</div>
	</div>
	<div class="buttons-back" >
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a>
	</div>
	<div class="buttons" ><a href="#screen2" class="wiggle"><img class="readmore-toggle" src="images/buttons/readmore.png" title="<?php echo _("Read more"); ?>" ></a></div>
	<div class="buttons" ><a href="11.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div><script>	
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
				document.location.href= "9.php";			
			} else if( $('#screen2').is(':visible') ) {				
				$('#screen2').fadeOut(function(){ 					
					$('h1').fadeIn();
					$('#screen1').fadeIn();					
					$('img.next-toggle').fadeOut(function(){						
						$('img.readmore-toggle').fadeIn();					
					});				
				});			
			}		
		});		
		
		$('img.readmore-toggle').click(function(){				
			$('h1').fadeOut();				
			$('#screen1').fadeOut(function(){ 
				$('#screen2').fadeIn();  
				$('img.back-toggle').fadeIn(); 					
				$('img.next-toggle').parent().attr('href','11.php'); 				
			});				
			
			$('img.readmore-toggle').fadeOut();				
			$('img.next-toggle').fadeIn();		
		});	
	});
	</script>
	<section id="preloader"><section class="selected"><strong><?php echo _("Sending text message..."); ?></strong></section></section>
<?php require("setlocale.php"); ?>
</body>
</html>
