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
$id = $mysqli->real_escape_string(strip_tags($_POST['id']));
$is_deleted = $mysqli->real_escape_string(strip_tags($_POST['is_deleted']));
$tablename = $mysqli->real_escape_string(strip_tags($_POST['tablename']));

$return=false;
if ( $stmt = $mysqli->prepare("UPDATE ".$tablename." SET is_deleted = ? WHERE user_ID = ?")) {

	$stmt->bind_param("ii", $is_deleted, $id);
    $return = $stmt->execute();
	$stmt->close();
}             
$mysqli->close();        

echo $return ? "ok" : "error";

      

