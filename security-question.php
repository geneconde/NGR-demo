<?php

    session_start();
    ini_set('display_errors', '1');

    include_once('controller/User.Controller.php'); 
    include_once('controller/Security.Controller.php');
    include_once('php/auto-generate.php');

    $uc = new UserController();
    $sec = new SecurityController();
    $questions = $sec->getAllQuestions();

//check username

    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $user = $uc->loadUser($username);

        if($user)
        {
            $type = $user->getType();

            if($type == 2)
            { //if student
                $data['success'] = true;
                $data['type'] = "student";
                $data['message'] = "Please request a password reset from your teacher.";
            } else 
            {
                $uid = $uc->getUserByUsername($username);
                $secid = $sec->getSecurityRecord($uid[0]["user_ID"]);
                
                if (isset($secid[0]['question_id']))
                {
                    foreach ($questions as $question) 
                    {
                        if($secid[0]['question_id'] == $question['question_id']) 
                            $sQuestion = $question["question"]; 
                    }
                    $data['success'] = true;
                    $data['message'] = $sQuestion;
                    $data['id'] = $uid[0]["user_ID"];
                    $data['uType'] = $type;
                } else 
                {
                    $data['success'] = false;
                    $data['message'] = 'Sorry, no security question found.';
                }
            }

        } else { //user not in db

            $data['success'] = false;
            $data['message'] = 'Sorry, the username that you have entered is not registered.';
        }

    }

//security check for username
    if(isset($_POST['sqAnswer'])){
        $userAnswer = $_POST['sqAnswer'];
        $uid = $_POST['id'];
        $type = $_POST['uType'];
        $secid = $sec->getSecurityRecord($uid);
        $secAnswer = $secid[0]['answer'];
      
        if($userAnswer == $secAnswer){
            $new_pass = generatePassword();
            $uc->updateUserPassword($uid, $new_pass); 

            $data['success'] = true;
            $data['message'] = "Your new password is: ".$new_pass;

        } else {
            $data['success'] = false;
            $data['message'] = "Sorry, your answer is incorrect.";
        }
    }

    echo json_encode($data);
?>