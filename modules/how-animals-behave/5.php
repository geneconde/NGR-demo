<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'how-animals-behave';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(5, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'how-animals-behave-qc1-a');
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
<script src="scripts/jquery-1.9.1.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/button.js"></script>
<script src="scripts/jpreloader.js"></script>
<script src="scripts/saveanswer.js"></script>
<script src="scripts/jquery.ui.touch-punch.min.js"></script>
<!-- <script src="scripts/rightclick.js"></script> -->
<style>
	 html { background-color: #FFFFFF; }
	 body { display: none; }
	img.next-toggle {  display:none; }
	.bg { 
		background: url(images/bg/qbg.jpg) 0 0 no-repeat;  
		background-size: 100% 100%; 
		width:100%; 
		height:100%; 
		position:relative; 
	}
		#questionA, #questionB { overflow: hidden; background-color: rgba(255, 255, 212, .3); margin: 0 auto; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; margin-bottom: 10px; padding: 0 10px; width: 97%; min-height: 180px}
	#answerSpan { display: none; }
	#youAnswered { font-size: 24px; display: none; text-align:center; margin: 0px; padding: 0px;}
	#answer { display: none; color: red; margin: 0px; padding: 0px;}
	#answerA { color: red; margin-left: 0px; padding: 0px; font-size: 24px; text-align: center; }
	#answerB { color: green; margin: 0px; padding: 0px; font-size: 24px; text-align: center; }
	#answerC { color: red; margin: 0px; padding: 0px; font-size: 24px; text-align: center; }
	#answerD { color: red; margin: 0px; padding: 0px; font-size: 24px; text-align: center; }	#q2li { margin-left: 2% }	
	#sortable { list-style-type: none; min-width: 223px; margin: 0; padding: 0;}
	#sortable ul { margin: 0; padding: 0; }
	#sortable li { height: 35px; margin-top: 5px; background-color: #fdce59; cursor: pointer; line-height: 35px; padding-left: 10px; padding-right: 10px; border-radius: 10px 0px 0px 10px;}
	#response li { height: 35px; margin-top: 5px; line-height: 35px; padding-left: 10px; padding-right: 10px; list-style-type: none; background-color: #c4bdb7; border-radius: 0px 10px 10px 0px; }	
	#response {  }
	#q2table { margin-top: 2%; margin-left: 2%; }
	#q2table div{ height: 70px;  }
	#q2table th { font-size: 24px; margin: 0px; padding: 0px; background-color: #65bcff; border-radius: 5px; color: white  }
	#sortable div{ height: 70px;  }
	td { padding: 0px; margin: 0px; }
	#td1 { padding: 0px; margin: 0px }
	#td2 {  padding: 0px; margin: 0px }		#qaAnswer { width: 100%; }	#qbAnswer { width: 100%; }	
	#q2correct { color: green; margin: 0px; padding: 0px; }
	#q2correct p{ width: 100%; color: green; }
	#q2wrong { color: red; margin: 0px; padding: 0px; }
	#q2wrong p{ width: 100%; color: red; }	input[type=radio].css-checkbox {		display:none;	}		input[type=radio].css-checkbox + label.css-label {		padding-left:37px;		height:32px; 		display:inline-block;		line-height:32px;		background-repeat:no-repeat;		background-position: 0 0;		font-size:24px;		vertical-align:middle;		cursor:pointer;		}		input[type=radio].css-checkbox:checked + label.css-label {		background-position: 0 -32px;	}	label.css-label {		background-image:url(images/5/csscheckbox.png);		-webkit-touch-callout: none;		-webkit-user-select: none;		-khtml-user-select: none;		-moz-user-select: none;		-ms-user-select: none;		user-select: none;	}
	#q2li li { padding:5px 0; }

	html[dir="rtl"] input[type=radio].css-checkbox + label.css-label { background-position-x: right;padding-right: 37px;width:90%; }
	html[dir="rtl"] input[type=radio].css-checkbox:checked + label.css-label { background-position: right -32px; }
	html[dir="rtl"] #q2wrong p { width: 95%; }

	html[dir="rtl"] #sortable li { border-radius: 0px 10px 10px 0px; }
	html[dir="rtl"] #response li { border-radius: 10px 0px 0px 10px; }	

	#qaAnswer img, #qbAnswer img { vertical-align: sub; }
</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<h1 id="h1"><?php echo _("Quick Check #1"); ?></h1> 
			<h1 id="answerSpan"><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?") ?></h1> 
			<div id="screen1">
				<section>
					<div id="questionA">
						<h2><?php echo _("Question A. Click on the statement that best explains behavior. "); ?></h2>					
						<div id="youAnswered"><?php echo _("You answered..."); ?></div>
							<div class="choices-container">	
								<ul>																											<div id="q2li"> 
										<li id="a">	<input name="answer" type="radio"  id="a1" value="A" class="css-checkbox"/> 											<label class="css-label" for="a1">A. <?php echo _("All the good and bad actions a person does."); ?> </label>										</li>										
										<li id="b">	<input name="answer" type="radio"  id="b1" value="B" class="css-checkbox"/> 											<label class="css-label" for="b1">B. <?php echo _("The way an organism acts in an environment."); ?></label>										</li>	
										<li id="c">	<input name="answer" type="radio"  id="c1" value="C" class="css-checkbox"/> 											<label class="css-label" for="c1">C. <?php echo _("All an organism has learned to survive in an environment."); ?></label>										</li>	
										<li id="d">	<input name="answer" type="radio"  id="d1" value="D" class="css-checkbox"/> 											<label class="css-label" for="d1">D. <?php echo _("The way an organism fights off their predators."); ?></label>										</li>										</div>
								</ul>
							</div>							
							<p id="qaAnswer"></p>							
					</div>
						<div id="questionB">
							<h2><?php echo _("Question B. Drag the items up or down (left column) to match the most probable response."); ?></h2>							
							<table id="q2table">
								<tr id="tr1">
									<th><?php echo _("Stimuli"); ?></th>
									<th><?php echo _("Response"); ?></th>
								</tr>
								<tr>
									<td id="td1" style="padding:0px">
										<ul id="sortable">
											<li class="ui-state-default"><span data-name="A"></span><div id="predator"><?php echo _("Predator attacking"); ?></div></li>
											<li class="ui-state-default"><span data-name="B"></span><div id="attract"><?php echo _("Attract a mate (courtship)"); ?></div></li>
											<li class="ui-state-default"><span data-name="C"></span><div id="change"><?php echo _("Change in temperature"); ?></div></li>
											<li class="ui-state-default"><span data-name="D"></span><div id="friendship"><?php echo _("Friendship and conversation"); ?></div></li>
										</ul>
									</td>
									<td id="td2">
										<ul id="response">
											<li><div><?php echo _("Singing, fluffing up, spreading out feathers"); ?></div></li>
											<li><div><?php echo _("Use social media sites"); ?></div></li>
											<li><div><?php echo _("Camouflage"); ?></div></li>
											<li><div><?php echo _("Migration"); ?></div></li>
										</ul>
									</td>
								</tr>
							</table>							
							<p id="qbAnswer"></p>
							
						</div>
				</section>
			</div>
		</div>

	</div>
	
	<div class="buttons-back" ><a href="" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png" title="<?php echo _("Back"); ?>" ></a></div>
	<div class="buttons" ><a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/checkanswer.png" title="<?php echo _("Check answer"); ?>" ></a></div>
	<div class="buttons" ><a href="6.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>" ></a></div>
<script>	
var answered = <?php echo $answered; ?>;
var studentAnswer ="";
var studentAnswer2 ="";
var hash = window.location.hash.slice(1);	
	$(document).ready(function() {	
		$( "#sortable" ).sortable();	
		$( "#sortable" ).disableSelection();	
		
		$('img.check-toggle').click(function(e){			
			
			if($("input:radio[name=answer]").is(":checked")){	
				$('#h1').hide();				
				$('.choices-container').hide();	
				$('#answerSpan').fadeIn();		
				$(checkAnswers);			
				$('#answer').fadeIn();	
				$('#youAnswered').fadeIn();		
				$('#q2answer').fadeIn();		
				$('img.check-toggle').fadeOut(function(){ $('img.next-toggle').fadeIn(); });
			
			} else { alert('<?php echo _("Please select your answers."); ?>'); e.preventDefault(); }		
		});		
		
		$('img.back-toggle').click(function(){	
			if ($('#answerSpan').is(':hidden')) {		
				$('img.back-toggle').parent().attr('href','4.php#screen2');	
			} else {			
				$('img.back-toggle').parent().attr('href','5.php');		
				   }		
			});	
		});	
		
function checkAnswers() {	
	var val= $('input[type="radio"]:checked').val();
	if (val=="A"){		
		$('#q2li').fadeOut(function(){	
		$('#qaAnswer').append('A. <?php echo _("All the good and bad actions a person does."); ?>');	
		$('#qaAnswer').append('<div id="answerA" > <img src="images/others/wrong.png" /> <?php echo _("No, behavior is the way an organism acts, not necessarily if the actions are good or bad."); ?></div>');	
	});
	
	} else if (val=="B"){	
		$('#q2li').fadeOut(function(){	
		$('#qaAnswer').append('B. <?php echo _("The way an organism acts in an environment."); ?>');		
		$('#qaAnswer').append('<div id="answerB" ><img src="images/others/check.png" />  <?php echo _("Correct, different organisms respond to their environment in many ways, which is considered behavior. "); ?></div>');
	});	
	
	} else if (val=="C"){
		$('#q2li').fadeOut(function(){		
		$('#qaAnswer').append('C. <?php echo _("All an organism has learned to survive in an environment."); ?>');		
		$('#qaAnswer').append('<div id="answerC" ><img src="images/others/wrong.png" /> <?php echo _("No, behavior is not just learned behavior, it includes instinct as well. Behavior is the way an organism acts in an environment. "); ?></div>')	
	});	
	
	} else if (val=="D"){	
		$('#q2li').fadeOut(function(){		
		$('#qaAnswer').append('D. <?php echo _("The way an organism fights off their predators."); ?>');	
		$('#qaAnswer').append('<div id="answerD" > <img src="images/others/wrong.png" /><?php echo _("Not quite, the way they fight off predators is just an example, not the entire definition of behavior. Behavior is the way an organism acts in an environment. "); ?></div>')		
	});
	
	}else{	
		$('#noAnswer').fadeIn();	
	}	
	studentAnswer2 = val;
	var answers = "B,D,A,C";

	$('#sortable span').each(function(index){		
		var name = $(this).data('name');
		studentAnswer = studentAnswer + "," + name;		
	});
	
	studentAnswer = studentAnswer.substring(1,8);
	var sanswers = studentAnswer.split(',');
	
	if (studentAnswer == answers) {		
		$('#q2paragraph').fadeOut();	
			$('#q2table').fadeOut(function(){	
			$('#qbAnswer').append('<div id="q2correct"><p><img src="images/others/check.png" /> <?php echo _("Correct!  Even predators use their natural camouflage to blend in with their surroundings. Birds use songs and feathers to attract mates, but so do humans when they groom themselves to look nice. Since humans are the only organism that know how to heat and cool their homes, other animals such as ducks and geese migrate to warmer or cooler places.  Today, many people use social media sites and actual gathering places to meet and talk with other people."); ?></p></div>');	
		});	
		
	} else 
	{	
		$('#q2paragraph').fadeOut();	
			$('#q2table').fadeOut(function(){		
			$('#qbAnswer').append('<div id="q2wrong"><p> <img src="images/others/wrong.png" /> <?php echo _("Check your matches again.  Even predators use their natural camouflage to blend in with their surroundings. Birds use songs and feathers to attract mates, but so do humans when they groom themselves to look nice. Since humans are the only organism that know how to heat and cool their homes, other animals such as ducks and geese migrate to warmer or cooler places.  Today, many people use social media sites and actual gathering places to meet and talk with other people."); ?></p></div>');	
			});	
	}

	if(answered == 0){	
		saveAnswer('how-animals-behave-qc1-a',studentAnswer2);
		saveAnswer('how-animals-behave-qc1-b',sanswers[0]);
		saveAnswer('how-animals-behave-qc1-c',sanswers[1]);
		saveAnswer('how-animals-behave-qc1-d',sanswers[2]);
		saveAnswer('how-animals-behave-qc1-e',sanswers[3]);
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
	ev.preventDefault();	var data=ev.dataTransfer.getData("Text");	ev.target.appendChild(document.getElementById(data));	
}
</script>
	<section id="preloader">
		<section class="selected">
			<strong><?php echo _("Preparing your first quick check!"); ?></strong>
		</section>
	</section>
<?php require("setlocale.php"); ?>
</body>
</html>
