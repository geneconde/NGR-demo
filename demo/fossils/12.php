<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'fossils';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _('Fossils'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/modalcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
h1 { color: #766427; }
.wrap { border-color: #e0ce8e; }
.bg { background-image: url(images/12/bg.jpg); }
.column { width: 95%; text-align: center; margin: 10% auto; }
.md-content { background: #fffced; }
.md-content p { font-size: 16px; }
.md-content img { height: 200px; }
.md-content h3 { background: #c8b35a; color: #fff; }
button:hover { background: #e0ce8e; }
button {
	font-family: 'PlaytimeRegular';
	border: none;
	border-image-source: initial;
	border-image-slice: initial;
	border-image-width: initial;
	border-image-outset: initial;
	border-image-repeat: initial;
	padding: 1em 2em;
	background: #c8b35a;
	color: #fff;
	font-size: 16px;
	letter-spacing: 1px;
	text-transform: uppercase;
	cursor: pointer;
	display: inline-block;
	margin: 1% 0;
	border-radius: 10px;
}
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing key vocabulary related to... fossils"); ?></h1>

				<div class="md-modal md-effect" id="modal-1">
					<div class="md-content">
						<h3><?php echo _("Sedimentary Rock"); ?></h3>
						<div>
							<img src="images/12/sedimentary.jpg"/>
							<p><?php echo _("Sedimentary rock is rock formed from deposits of mud and sand from rivers, streams, lakes and oceans. Most fossils are found in or near deposits of sedimentary rock."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-2">
					<div class="md-content">
						<h3><?php echo _("Fossils"); ?></h3>
						<div>
							<img src="images/12/fossil.jpg"/>
							<p><?php echo _("Fossils are the preserved remains or traces of organisms that were once alive. The organism became a fossil through its body being quickly buried in sediment."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-3">
					<div class="md-content">
						<h3><?php echo _("Mold"); ?></h3>
						<div>
							<img src="images/12/mold.jpg"/>
							<p><?php echo _("In some cases, the remains of an organism trapped in a rock formation just leave an impression of the organism. This type of fossil is called a mold."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-4">
					<div class="md-content">
						<h3><?php echo _("Cast"); ?></h3>
						<div>
							<img src="images/12/cast.jpg"/>
							<p><?php echo _("If a mold fossil later fills with other materials, the fossil formed is then called a cast."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-5">
					<div class="md-content">
						<h3><?php echo _("True form fossil"); ?></h3>
						<div>
							<img src="images/12/trueform.jpg"/>
							<p><?php echo _("Sometimes the actual organism or parts of the organism are preserved. This kind of fossil is called a <span class='key'>true form fossil</span>. Insects preserved in tree sap are true form fossils. So are woolly mammoths found trapped and frozen in glacial ice. These true form fossils are very rare."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-6">
					<div class="md-content">
						<h3><?php echo _("Trace fossil"); ?></h3>
						<div>
							<img src="images/12/trace.jpg"/>
							<p><?php echo _("A fossil can consist of some mark or evidence of an organism such as a footprint, a nest or even its waste (poop). This type of fossil is called a trace fossil."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-7">
					<div class="md-content">
						<h3><?php echo _("Paleontologist"); ?></h3>
						<div>
							<img src="images/12/paleontologist.jpg"/>
							<p><?php echo _("Paleontologists study fossils because they can learn lots of useful things about the Earth and how it has changed. Paleontologists also can learn many useful things about the living organisms that inhabited the Earth in the past."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-8">
					<div class="md-content">
						<h3><?php echo _("Fossil record"); ?></h3>
						<div>
							<img src="images/12/fossilrecord.jpg"/>
							<p><?php echo _("The collection of all the fossils that have ever been found is called the fossil record. The fossil record consists of billions of dead things, buried in rock layers, buried by water and sediment, all over the Earth!"); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-9">
					<div class="md-content">
						<h3><?php echo _("Extinct"); ?></h3>
						<div>
							<img src="images/12/extinct.jpg"/>
							<p><?php echo _("A species of organisms is said to have gone extinct when no more individuals remain alive. An extinct species has no living individuals in it; all have died out."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-modal md-effect" id="modal-10">
					<div class="md-content">
						<h3><?php echo _("Non-renewable resources"); ?></h3>
						<div>
							<img src="images/12/nonrenewable.jpg"/>
							<p><?php echo _("Some natural resources, such as fossil fuels, are replenished slowly or not at all, making them non-renewable. Non-renewable resources cannot be quickly or easily replaced once they are all used up."); ?></p>
							<button class="md-close"><?php echo _("Close me!"); ?></button>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="main">
						<div class="column">
							<button class="md-trigger md-setperspective" data-modal="modal-1"><?php echo _("Sedimentary Rock"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-2"><?php echo _("Fossils"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-3"><?php echo _("Mold"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-4"><?php echo _("Cast"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-5"><?php echo _("True form fossil"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-6"><?php echo _("Trace fossil"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-7"><?php echo _("Paleontologist"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-8"><?php echo _("Fossil record"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-9"><?php echo _("Extinct"); ?></button>
							<button class="md-trigger md-setperspective" data-modal="modal-10"><?php echo _("Non-renewable resources"); ?></button>
						</div>
					</div>
				</div>

				<div class="md-overlay"></div>
			</div>
		</div>
	</div>

	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="11.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>

	<div class="buttons" title="<?php echo _('Next'); ?>">
		<a href="13.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Words and explanations"); ?></strong></section></section>

	<script src="scripts/classie.js"></script>
	<script src="scripts/modalEffects.js"></script>
	<script>var polyfilter_scriptpath = '/scripts/';</script>
	<script src="scripts/cssParser.js"></script>
	<script src="scripts/css-filters-polyfill.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<?php require("setlocale.php"); ?>
</body>
</html>
