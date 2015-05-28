<?php
require_once '../session.php';
$userid = $user->getUserid();
$subid = $sub->getID();
/*
 * 
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
      
require_once('config.php');         

// Database connection                                   
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 

// Get all parameter provided by the javascript
$lastname = $mysqli->real_escape_string(strip_tags($_POST['lastname']));
$firstname = $mysqli->real_escape_string(strip_tags($_POST['firstname']));
$sub_id = $subid;
$user_type = 2;
$username = $mysqli->real_escape_string(strip_tags($_POST['username']));

$password	= $mysqli->real_escape_string(strip_tags($_POST['password']));
$salt 		= sha1(md5($password));
$password2 	= md5($password.$salt);

$gender = $mysqli->real_escape_string(strip_tags($_POST['gender']));
$grade_level = $mysqli->real_escape_string(strip_tags($_POST['grade_level']));

$tablename = $mysqli->real_escape_string(strip_tags($_POST['tablename']));

$return=false;
if ( $stmt = $mysqli->prepare("INSERT INTO ".$tablename."  (username, password, first_name, last_name, subscriber_id, type, gender, grade_level) VALUES (  ?, ?, ?, ?, ?, ?, ?, ?)")) {

	$stmt->bind_param("sssssisi", $username, $password2, $lastname, $firstname, $sub_id, $user_type, $gender, $grade_level);
    $return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

