<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(14, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<title><?php echo _("How Animals Behave"); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/locale.css" />
	<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
	<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
	<link rel="stylesheet" type="text/css" href="styles/modalcomponent.css" />
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.wiggle.min.js"></script>
	<script src="scripts/modernizr.custom2.js"></script>
	<!-- <script src="scripts/rightclick.js"></script> -->
	<style>	
    html { background-color: #fff; }
	body { display: none; }
	html, body { height: 100%; padding: 0; margin: 0; font-family: PlaytimeRegular, 'Comic Sans', sans-serif; min-height: 450px; }
	img { -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; }
	h1 { font-size: 33px; text-align: left; padding: 5px 0; margin: 0; }
	h2 { font-size: 24px; color: #2f60a8; text-align: center; font-weight: normal; padding: 0; margin: 10px 0 10px 0; }
	p { font-size: 24px; margin: 0; text-align: center; padding: 0; }
	ul { list-style: none; }
	li { font-size: 24px; }
	label { font-size: 24px; }
	td { font-size: 24px; }
	th { font-size: 26px; }
	a { text-decoration: none; color: #111; }
	.wrap { margin: 0 auto; max-width: 900px; height: 100%; border-left: 1px dashed #FF8C56; border-right: 1px dashed #FF8C56; padding: 0 2px; }
	.bg { background-image: url(images/14/bg.jpg); background-repeat: no-repeat; position: relative; background-size: 100% 100%; width: 100%; height: 100%; }
	.bg > div { width: 95%; margin: 0 auto; }
	h1 { color: palevioletred; }
	h2 { }
	.clear { clear:both;}
	.buttons { position: absolute; bottom: 2%; right: 2%; }
	.buttons-back { position: absolute; bottom: 2%; left: 2%; }
	.bold { font-weight: bold; }
	.float-left { float: left; }
	.md-content { text-align: center; background-color: #FEDE63; -webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;}
	.md-content h2 { background-color: #7FD4FF; color: #8F6FC9; font-size: 24px; text-transform: none; text-align: center; margin:0px; padding: 10px }
	.md-content img {  -webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px; }		.md-content div p { font-size: 16px; }
	.md-close { background-color: #5bc6de; color: #fff; text-transform: none; font-size: 0.8em !important; }
	.column { width: 80%; text-align: center; margin: 10% auto;}
	button:hover { background-color: #37C1BF; color: #FFD4FF }
	button {					
	font-family: 'PlaytimeRegular'; 
	font-size: 17px; 
		border: none;
		border-image-source: initial;
		border-image-slice: initial;
		border-image-width: initial;
		border-image-outset: initial;
		border-image-repeat: initial;
		padding: 1em 2em;
		background-color: #7FD4FF;
		color: #8F6FC9;
		outline: 0 !important;
		letter-spacing: 1px;
		text-transform: uppercase;
		cursor: pointer;
		display: inline-block;
		margin: 1% 0;
		border-radius: 10px;
	}

	html[dir="rtl"] h1 { text-align: right; }
	html[dir="rtl"] p { text-align: right; }
	<?php if($language == "es_ES") { ?>
		h1 { font-size:24px; }
		.column { width:80%; }
	<?php } ?>
	</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing key vocabulary related to... how animals behave"); ?></h1>
				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
						<h2><?php echo _("BEHAVIOR"); ?></h2>
						<div>
							<img src="images/14/behavior.jpg" alt="Placeholder">
							<p><?php echo _("The way that an animal responds to its environment is called behavior. An animal's behavior, or actions, often changes in response to changes in its environment."); ?></p>						<p><?php echo _("Behavior is not limited to just one individual. Animals can change their behavior as a group, too. For example, a flock of birds may not fly south for the winter as early as they normally would if an area is experiencing unusually warm temperatures. Or, a group of deer that normally travel on one path to find food may change their behavior and find another route if the path is flooded or blocked."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-2">
					<div class="md-content">
						<h2><?php echo _("INHERITED BEHAVIOR"); ?></h2>
						<div>
							<img src="images/14/inherited.jpg" alt="Placeholder">
							<p><?php echo _("Inherited behaviors are behaviors that are passed on to later generations.  Eventually, an inherited behavior becomes common in a population of animals.  Not all behavior is inherited, although some is."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h2><?php echo _("STIMULUS"); ?></h2>
						<div>
							<img src="images/14/stimulus.jpg" alt="Placeholder">
							<p><?php echo _("A stimulus is something that produces a reaction or a change. Light is a stimulus that can cause the size of the pupil in your eye to change."); ?></p>						<p><?php echo _("Sometimes rewards are used as a stimulus to cause a desired action or response. For example, your school may reward students for the numbers of books read during the school year. This reward can act as a stimulus to get students to read more books."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h2><?php echo _("INSTINCTUAL BEHAVIOR"); ?></h2>
						<div>
							<img src="images/14/instinctual.jpg" alt="Placeholder">
							<p><?php echo _("Instinctual behavior is any behavior that is inherited and not learned during life."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h2><?php echo _("MECHANICAL STIMULUS"); ?></h2>
						<div>
							<img src="images/14/mechanical.jpg" alt="Placeholder">						<p><?php echo _("Mechanical stimuli include anything that causes a sensation of touch, pain, sound, or temperature."); ?></p>						
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h2><?php echo _("NEURON"); ?></h2>
						<div>
							<img src="images/14/neuron.jpg" alt="Placeholder">
							<p><?php echo _("Neurons are nerve cells.  Neurons respond to a stimulus, send a tiny electrical signal to the brain, and the signal is interpreted by the brain as a response is generated."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h2><?php echo _("CHEMICAL STIMULUS"); ?></h2>
						<div>
							<img src="images/14/chemical.jpg" alt="Placeholder">						<p><?php echo _("Chemical stimuli are molecules in our environment that make us sense taste or smell."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h2><?php echo _("RESPONSE"); ?></h2>
						<div>
							<img src="images/14/response.jpg" alt="Placeholder">
							<p><?php echo _("A response is generated in the brain after it receives a tiny electrical signal from the neurons. The response works like the stimulus, only in reverse."); ?></p>
							<button class="md-close"><?php echo _("CLOSE ME!"); ?></button>
						</div>
					</div>
				</div>
				<div class="container">
					
					<div class="main clearfix">
						<div class="column">
							<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _("BEHAVIOR"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-2"><?php echo _("INHERITED BEHAVIOR"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _("STIMULUS"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _("INSTINCTUAL BEHAVIOR"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _("MECHANICAL STIMULUS"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-6"><?php echo _("NEURON"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _("CHEMICAL STIMULUS"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _("RESPONSE"); ?></button>
						</div>
					</div>
				</div>			
				<div class="md-overlay"></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<script>		
		$(document).ready(function() {
			$('.wiggle').wiggle({ speed: 250, wiggles: 1000 });			
			$('.wiggle-right').wiggle({ speed: 250, wiggles: 1000, moveto: 'right' });	
		});	
	</script>	
	<div class="buttons-back" ><a href="13.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons"><a href="15.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
	<script>var polyfilter_scriptpath = '/scripts/';</script>
	<script src="scripts/cssParser.js"></script>
	<script src="scripts/css-filters-polyfill.js"></script>
	<section id="preloader">		<section class="selected">			<strong><?php echo _("Words and explanations"); ?></strong>		</section>	</section>
<?php require("setlocale.php"); ?>
</body>
</html>
