<?php
    include_once '../demo/controller/Trial.Controller.php';
    include_once '../demo/php/auto-generate-trial.php';
    
    $uc     = new UserController();
    $users  = $uc->getAllUsers();
    $cdate  = array();
    
    foreach($users as $user) {

      array_push($cdate, $user->getCreateDate());

    }

    for($z = 1; $z <= $tot; $z++) {

        $uc->deleteUserDate($cdate[$z]);

    } 

?>



