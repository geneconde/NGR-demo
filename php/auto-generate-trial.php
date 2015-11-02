<?php
	include_once(dirname(__FILE__)."/../libraries/fpdf.php");
	include_once(dirname(__FILE__)."/pdfmc.class.php");
	include_once(dirname(__FILE__)."/../controller/User.Controller.php");
	include_once(dirname(__FILE__)."/../controller/TeacherModule.Controller.php");
	include_once(dirname(__FILE__)."/../controller/StudentGroup.Controller.php");

	function generateUsers($fname, $lname, $school, $tnum, $snum, $tid, $tusername, $tpassword) {
		//$gender	   		= ['M', 'F'];
		$create_date	= date('Y-m-d G:i:s');
		$expire_date	= date('Y-m-d G:i:s', strtotime("+30 days"));

		$uc 		= new UserController();
		$tmc 		= new TeacherModuleController();
		$dgroup 	= new StudentGroupController();

		$users 		= $uc->getAllUsers();
		$usernames 	= array();

		// $tc     = new TrialController();
  //       $trials   = $tc->getAllTrialUsers();
  //       $ids = array();

  //       foreach($trials as $trial){
  //           array_push($ids, $trial->getTrialId());
  //       }

		foreach($users as $user) {
			array_push($usernames, $user->getUsername());
		}

		$pdf = new FPDF();
		$pdf->SetAutoPageBreak(true);
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(180, 5, 'FREE TRIAL USER ACCOUNTS', 0, 1, 'C');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(80, 5, 'Here is the list of user accounts you can use for a month of free trial.', 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Contact Person: ', 0, 0, 'L');
		$pdf->Cell(90, 5, $trialUser, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'School District:', 0, 0, 'L');
		$pdf->Cell(90, 5, $school, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Date Created:', 0, 0, 'L');
		$pdf->Cell(90, 5, $create_date, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Expiration of User Accounts:', 0, 0, 'L');
		$pdf->Cell(90, 5, $expire_date, 0, 1, 'L');
		$pdf->Ln(5);

		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(180, 5, 'Go to dev.jigzen.com/shymansky/demo', 0, 1, 'C');
		for($i = 1; $i <= $tnum; $i++) {
			//$uname = generateUsername('T', $i); //added $ctr to add extra value in username - raina 01-30-2015
			//$pw = generatePassword();
			$uname 	= $tusername;
			$pw = $uc->hashPassword($tpassword);

			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(80, 5, 'Teacher Account', 0, 0, 'C');
			$pdf->Ln(5);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(40, 5, 'Username', 1, 0, 'C');
	    	$pdf->Cell(40, 5, 'Password', 1, 1, 'C');
			
			$pdf->SetFont('Arial', '', 12);
			$pdf->Cell(50, 10, ' ', 0, 0, 'L');
			$pdf->Cell(40, 10, $uname, 1, 0, 'L');
			$pdf->Cell(40, 10, $tpassword, 1, 1, 'L');
			$pdf->Ln(5);

			//$gender[rand(0,1)]
			// $_SESSION['username'] = $uname;
			// $_SESSION['password'] = $pw;

			$teacher = array(
				'username' 		=> $uname,
				'password' 		=> $pw,
				'type'	   		=> 0,
				'first_name'	=> $fname,
				'last_name'		=> $lname,
				'gender'		=> '',
				'grade_level'	=> 0,
				'teacher_id'	=> 0,
				'demo_id'		=> $tid,
				'create_date'	=> $create_date,
				//'expire_date'	=> $expire_date,
				'is_first_login'=> 1
			);
			
			// $Tgroup		= $dgroup->getUserGroup($tid);
			$TUserID = $uc->addUser($teacher);
			//$TUserID 	= $uc->getTeacherUserID($teacher['username']);
			// echo "<script>alert($TUserID);</script>";
			$groupID = $dgroup->addGroup("Default Group", $TUserID);

			$tuname = $uc->loadUser($teacher['username']);
			$uid   = $tuname->getUserid();

			$tmc->addTeacherModule($uid, 'gathering-data');
			$tmc->addTeacherModule($uid, 'fossils');
			$tmc->addTeacherModule($uid, 'how-animals-behave');
			$tmc->addTeacherModule($uid, 'behaviors');
			$tmc->addTeacherModule($uid, 'biodiversity');
			$tmc->addTeacherModule($uid, 'built-to-survive');
			$tmc->addTeacherModule($uid, 'changing-life-forms');
			$tmc->addTeacherModule($uid, 'changing-to-survive');
			$tmc->addTeacherModule($uid, 'composition-of-matter');
			$tmc->addTeacherModule($uid, 'doing-science');
			$tmc->addTeacherModule($uid, 'earth-materials-and-systems');
			$tmc->addTeacherModule($uid, 'ecosystems-interactions');
			$tmc->addTeacherModule($uid, 'energy-and-its-forms');
			$tmc->addTeacherModule($uid, 'energy-for-life');
			$tmc->addTeacherModule($uid, 'food-chains');
			$tmc->addTeacherModule($uid, 'genetic-codes');
			$tmc->addTeacherModule($uid, 'healthy-body');
			$tmc->addTeacherModule($uid, 'heating-and-cooling');
			$tmc->addTeacherModule($uid, 'history-of-earth');
			$tmc->addTeacherModule($uid, 'how-animals-respond');
			$tmc->addTeacherModule($uid, 'how-diseases-destroy');
			$tmc->addTeacherModule($uid, 'life-cycle-of-plants');
			$tmc->addTeacherModule($uid, 'natural-hazards');
			$tmc->addTeacherModule($uid, 'natural-resources');
			$tmc->addTeacherModule($uid, 'plants-are-producers');
			$tmc->addTeacherModule($uid, 'properties-of-matter');
			$tmc->addTeacherModule($uid, 'reproduction');
			$tmc->addTeacherModule($uid, 'role-of-water');
			$tmc->addTeacherModule($uid, 'solar-power');
			$tmc->addTeacherModule($uid, 'staying-alive');


			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(180, 5, 'Go to dev.jigzen.com/shymansky/demo', 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(80, 5, 'Student Accounts', 0, 0, 'C');
			$pdf->Ln(5);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(40, 5, 'Username', 1, 0, 'C');
    		$pdf->Cell(40, 5, 'Password', 1, 1, 'C');

			for($j = 1; $j <= $snum; $j++) {
				$suname = generateUsername('S', $j);
				$spw = '123456';
		        
	    		$pdf->SetFont('Arial', '', 12);
	    		$pdf->Cell(50, 10, ' ', 0, 0, 'L');
				$pdf->Cell(40, 10, $suname, 1, 0, 'L');
				$pdf->Cell(40, 10, $spw, 1, 1, 'L');

				$spw = $uc->hashPassword($spw);

				$student = array(
					"username" 		=> $suname,
					"password" 		=> $spw,
					"type"	   		=> 2,
					"first_name"	=> '',
					"last_name"	=> '',
					"gender"		=> '',
					"grade_level"	=> 1,
					"teacher_id"	=> $uid,
					'demo_id'		=> $tid,
					'create_date'	=> $create_date,
					//'expire_date'	=> $expire_date,
					'is_first_login'=> 1
				);

				$SUserID = $uc->addUser($student);
				$dgroup->addUserInGroup($groupID, $SUserID);
			}

			//$stdID = $uc->getStudents($tid, $suname);
			//$teacherUserID = $use->getTeacher();
			

			$pdf->Ln(5);
		}

		$pdfdoc = $pdf->Output('UserAccounts.pdf','S');
		return $pdfdoc;
	}

	function generateUsername($type, $ctr) { //removed username param because we're now sure there is no duplicate, added $ctr to add extra value in username - raina 01-30-2015

		// $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		// $date_time = date("Y-m-d G:i:s");
		// $date_time = str_replace(":","-",$date_time); 
		// $pieces = explode(" ",$date_time);
		// $id = '';
		// for($x=0;$x<=1;$x++){
		// 	$date= explode("-",$pieces[$x]);
		// 	for($y = 0; $y <= 2; $y++) { 
		// 		if($x==0 && $y==0){
		// 		$id .= $date[0];
		// 		continue;
		// 		}
		// 		$id .=$string{$date[$y]}; 
		// 	}
		// }
		// echo $id;

		$string = $type. time() . $ctr; //updated to get time plus counter - raina 01-30-2015

		//if(in_array($string, $usernames)) return t($usernames, $type);
		//else
		//commented out bec. we're sure there is no duplicate - raina 01-30-2015
		return $string;
	}

	function generatePassword() {
		$alphas		= range('a', 'z');
		$numbers	= range(0, 9);
		$characters = array_merge($alphas, $numbers);

		$string = '';

		for($i = 0; $i < 9; $i++) {
			$string .= $characters[rand(0,35)];
		}

		return $string;
	}
?>