<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(11, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'how-animals-behave-qc4-a');
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
<script src="scripts/jquery-1.9.1.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/blink.js"></script>
<script src="scripts/saveanswer.js"></script>
<script src="scripts/jquery.ui.touch-punch.min.js"></script>
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
	}	#questionA, #questionB { overflow: hidden; background-color: rgba(255, 255, 212, .3); 		margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; 		border-radius: 10px; margin-bottom: 10px; padding: 0 10px; width: 97%;	}		#q1li { margin-bottom: 10px; margin-left: 2% }
		#noAnswer { display: none; color: red;}
	#answer { display: none; }
	#q2correct { display: none; color: green; margin: 0px; padding: 0px; }	#q2correct p{ color: green; margin: 0px; padding: 0px; }
	#q2wrong { display: none; color: red; margin: 0px; padding: 0px; }	#q2wrong p{ color: red; margin: 0px; padding: 0px; }
		#qaAnswer { display: none }	
	#q2answer p{
		color: red;
	}	
	#q2answer {	
		display: none;	
	}	
	#sortable { list-style-type: none; margin: 0; padding: 0;}	
	#sortable li { margin-left: 0px; padding: 7px; height: 30px; background-color: #FFD47F; margin-bottom: 5px; border-radius: 5px; cursor: pointer; }		#number { width: 35px }
	#number li{ height: 30px; padding: 7px; width: 20px; list-style-type: none; background: #E4676D; border-radius: 50px 0px 0px 50px; margin-bottom: 5px;}	
	table td{ border-radius: 7px;}	
	#td2 { width: 95%; }
	#q2table { margin-left: 2% }		input[type=radio].css-checkbox {		display:none;	}		input[type=radio].css-checkbox + label.css-label {		padding-left:37px;		height:32px; 		display:inline-block;		line-height:32px;		background-repeat:no-repeat;		background-position: 0 0;		font-size:24px;		vertical-align:middle;		cursor:pointer;		}		input[type=radio].css-checkbox:checked + label.css-label {		background-position: 0 -32px;	}		label.css-label {		background-image:url(images/11/csscheckbox.png);		-webkit-touch-callout: none;		-webkit-user-select: none;		-khtml-user-select: none;		-moz-user-select: none;		-ms-user-select: none;		user-select: none;	}

	html[dir="rtl"] input[type=radio].css-checkbox + label.css-label { padding-right:37px;background-position-x:right;  }
	html[dir="rtl"] input[type=radio].css-checkbox:checked + label.css-label { background-position: right -32px; }
	html[dir="rtl"] #number li { border-radius: 0 50px 50px 0; }	

	#questionB img, .h2cr1 img { vertical-align: sub; }

	<?php if($language == "es_ES") { ?>
		input[type=radio].css-checkbox + label.css-label { font-size:22px; }
	<?php } ?>
</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			
			<h1 id="h1"><?php echo _("Quick Check #4"); ?></h1>
			<h1 id="answer"><?php echo _("Quick Check #4"); ?> - <?php echo _("How did I do?"); ?></span></h1> 
			<div id="screen1">
				<div id="questionA">
						<h2><?php echo _("Question A. In what way is the nervous system <span class='blink'>not</span> similar to a cell phone network?"); ?></h2>
							<div id="q1li" >	
								<ul>
									<li id="a"><input name="answer" type="radio"  id="a1" value="A" class="css-checkbox" >										<label for="a1" class="css-label">A. <?php echo _("There is a clear pathway for sending messages in both networks."); ?></label>									</li>
									<li id="b"><input name="answer" type="radio"  id="b1" value="B" class="css-checkbox" >										<label for="b1" class="css-label">B. <?php echo _("Both networks can send or receive information."); ?></label>									</li>
									<li id="c"><input name="answer" type="radio"  id="c1" value="C" class="css-checkbox" >										<label for="c1" class="css-label">C. <?php echo _("Both networks have a desired target when they send messages."); ?></label>									</li>
									<li id="d"><input name="answer" type="radio"  id="d1" value="D" class="css-checkbox" >										<label for="d1" class="css-label">D. <?php echo _("Both networks have a center that combines all the incoming and outgoing messages."); ?></label>									</li>
								</ul>
							</div>														
							<div id="qaAnswer">									
							<p><?php echo _("You answered..."); ?></p>			
							<p class="choice1"></p>							
							<p class="h2cr1"></p>								
							</div>					
							</div>
							
						<div id="questionB">
							<h2><?php echo _("Question B. How does the brain interpret a feeling or sensation of pain? Re-arrange the sentences by dragging them up and down from first to last."); ?></h2>
						
						<div id="q2correct">
							<p><img src="images/others/check.png" /> <?php echo _("Correct! First the nerve cells are stimulated by something like heat or pain. Then they respond and send an electrical signal to the brain.  The brain makes sense of the stimulus, and responds by creating a memory, and sending a response signal out to the body.  This message gets to a muscle cell (for instance) and causes muscle cells to contract."); ?></p> 
						</div>
						<div id="q2wrong">
							<p><img src="images/others/wrong.png" /> <?php echo _("Not quite. First the nerve cells are stimulated by something like heat or pain. Then they respond and send an electrical signal to the brain.  The brain makes sense of the stimulus, and responds by creating a memory, and sending a response signal out to the body.  This message gets to a muscle cell (for instance) and causes muscle cells to contract."); ?></p> 
						</div>
							<table id="q2table">
								<tr>
									<td id="td1">
										<ul id="number">
											<li>1</li>
											<li>2</li>
											<li>3</li>
											<li>4</li>
											<li>5</li>
										</ul>
									</td>
									<td id="td2">
										<ul id="sortable">
												<li class="ui-state-default"><span data-name="A"></span><?php echo _("The brain sends a response electrical signal to the body."); ?></li>
												<li class="ui-state-default"><span data-name="B"></span><?php echo _("Nerve cells send an electrical signal to the brain."); ?></li>
												<li class="ui-state-default"><span data-name="C"></span><?php echo _("Nerve cells are stimulated by an object."); ?></li>
												<li class="ui-state-default"><span data-name="D"></span><?php echo _("Muscles receive and interpret the signal from the brain."); ?></li>
												<li class="ui-state-default"><span data-name="E"></span><?php echo _("The brain interprets the electrical signal and creates a memory."); ?></li>
										</ul>
									</td>
								</tr>
							</table>
						</div>
			</div>
		</div>

	</div>
	

	<div class="buttons-back" ><a href="11.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="checkanswer-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="12.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>

	<section id="preloader">

		<section class="selected">
			<strong><?php echo _("Last quick check!"); ?></strong>
		</section>

	</section>

	<script>
		var answered = <?php echo $answered; ?>;
		var studentAnswer = '';
		var studentAnswer2 = '';

	$(document).ready(function() {	
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();	
	/* screen transition */		
	$('img.back-toggle').click(function(){
	if( $('#answer').is(':visible') ) {		
	$('img.back-toggle').parent().attr('href','11.php');
	} else {	
	$('img.back-toggle').parent().attr('href','10.php#screen2');
	}	
	});	
	$('img.checkanswer-toggle').click(function(e){
		
	if( $("input:radio[name=answer]").is(":checked") ){	
		
		$('#h1').fadeOut( function (){	
			checkAnswers();
			$('#answer').fadeIn();								
			$('img.back-toggle').fadeIn(); 	
			$('img.checkanswer-toggle').fadeOut(); 	
			$('img.next-toggle').fadeIn(); 					
		});		
	} else { alert('<?php echo _("Please select your answers."); ?>'); e.preventDefault(); }	

	});		
	$('.blink').blink({ speed: 500, blinks: 1000 });
	});
	function checkAnswers(){		
	var val= $('input[type="radio"]:checked').val();
	
	if (val=="A"){		
	$('#q1li').fadeOut(function(){		
		$('.h2cr1').css('color', 'red');	
		$('.choice1').html('A. <?php echo _("There is a clear pathway for sending messages in both networks."); ?>');
		$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("Sorry... This is a correct statement... an electrical signal gets taken to the brain, and the message is interpreted there, then a new signal is sent out and the brain’s command is interpreted by the cell (muscle, skin, etc.)"); ?>');
		$('#qaAnswer').fadeIn();			
	});		
	
	}else if (val=="B"){		
		$('#q1li').fadeOut(function(){	
		$('.h2cr1').css('color', 'green');	
		$('.choice1').html('B. <?php echo _("Both networks can send or receive information."); ?>');	
		$('.h2cr1').html('<img src="images/others/check.png" /> <?php echo _("You got it! Both networks can send AND receive information. Electrical signals are sent both ways on the pathway."); ?>');	
		$('#qaAnswer').fadeIn();		
	});		
	}else if (val=="C"){	
		$('#q1li').fadeOut(function(){	
			$('.h2cr1').css('color', 'red');		
			$('.choice1').html('C. <?php echo _("Both networks have a desired target when they send messages."); ?>');	
			$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("Sorry... This is a correct statement... when you make call, you dial a specific number. In the nervous system, the message goes to the brain or a command to a certain cell on the way back."); ?>');		
			$('#qaAnswer').fadeIn();	
		});	
	
	}else if(val == "D") {		
		$('#q1li').fadeOut(function(){		
		$('.h2cr1').css('color', 'red');	
		$('.choice1').html('D. <?php echo _("Both networks have a center that combines all the incoming and outgoing messages."); ?>');	
		$('.h2cr1').html('<img src="images/others/wrong.png" /> <?php echo _("Sorry... This is a correct statement... the brain is the control center for the nervous system as the telecommunication center is for the phone network."); ?>');		
		$('#qaAnswer').fadeIn();	
		});		
	}	
	studentAnswer = val;
	//if(studentAnswer == "A" || studentAnswer == "C" || studentAnswer == "D") studentAnswer = "A,C,D";
	var answers = "C,B,E,A,D";	
	$('#sortable span').each(function(index){	
		var name = $(this).data('name');			
		studentAnswer2 = studentAnswer2 + "," + name;			
	});

	studentAnswer2 = studentAnswer2.substring(1,10);

	var sa2 = studentAnswer2.split(',');

	if (studentAnswer2 == answers) {		
		$('#instruction').fadeOut();	
		$('#q2table').fadeOut(function(){	
		$('#q2correct').fadeIn();});		
	} else { 			
		$('#instruction').fadeOut();	
		$('#q2table').fadeOut(function(){	
		$('#q2wrong').fadeIn();});	
		}
		
	if(answered == 0){			
		saveAnswer('how-animals-behave-qc4-a',studentAnswer);
		saveAnswer('how-animals-behave-qc4-b',sa2[0]);
		saveAnswer('how-animals-behave-qc4-c',sa2[1]);
		saveAnswer('how-animals-behave-qc4-d',sa2[2]);
		saveAnswer('how-animals-behave-qc4-e',sa2[3]);
		saveAnswer('how-animals-behave-qc4-f',sa2[4]);
		answered = 1;
		}
	}
	
	function allowDrop(ev)	{
		ev.preventDefault();	
	}		
	function drag(ev)
	{	
		ev.dataTransfer.setData("Text",ev.target.id);
	}		
	function drop(ev)
	{	
		ev.preventDefault();	
		var data=ev.dataTransfer.getData("Text");	ev.target.appendChild(document.getElementById(data)); 
	}
	
	
</script>
<?php require("setlocale.php"); ?>
</body>
</html>
