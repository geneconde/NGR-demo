<?php     
require_once '../session.php';
$userid = $user->getUserid();
$subid = $sub->getID();
$teacher_count = $uc->countUserType($user->getSubscriber(), 0);

/*
 * examples/mysql/loaddata.php
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
                              


/**
 * This script loads data from the database and returns it to the js
 *
 */
       
require_once('config.php');      
require_once('EditableGrid.php');            

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli,$query){
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}


// Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
//$grid->addColumn('user_ID', 'ID', 'integer', NULL, false);
$grid->addColumn('username', 'Username', 'string'); 
$grid->addColumn('first_name', 'First Name', 'string');  
$grid->addColumn('last_name', 'Last Name', 'string');  
$grid->addColumn('gender', 'Gender', 'string', fetch_pairs($mysqli,'SELECT gender_id, gender_name FROM gender'),true);  
$grid->addColumn('grade_level', 'Grade Level', 'string');
if($sub->getTeachers() != $teacher_count) {
	$grid->addColumn('type', 'Role Type', 'string' , fetch_pairs($mysqli,'SELECT type_id, type_name FROM user_type WHERE type_id NOT IN ("3", "1")'),true);  
} else {
	$grid->addColumn('type', 'Role Type', 'string' , fetch_pairs($mysqli,'SELECT type_id, type_name FROM user_type WHERE type_id NOT IN ("3", "1", "0")'),true);  
}    
$grid->addColumn('teacher_id', 'Teacher', 'string' , fetch_pairs($mysqli,"SELECT user_ID, first_name FROM users WHERE type = 0 AND subscriber_id = '" . $subid . "'"),true);    
$grid->addColumn('password', 'Password', 'html', NULL, false, 'user_ID'); 
//$grid->addColumn('trash', 'Move to', 'html', NULL, false, 'user_ID');   
$grid->addColumn('action', 'Action', 'html', NULL, false, 'user_ID');  

//$mydb_tablename = (isset($_GET['db_tablename'])) ? $_GET['db_tablename'] : 'demo';
                                                                       
// $result = $mysqli->query('SELECT *, date_format(lastvisit, "%d/%m/%Y") as lastvisit FROM demo ');
//$result = $mysqli->query("SELECT * FROM users WHERE subscriber_id = '" .$subid. "'");
 $result = $mysqli->query("SELECT * FROM users WHERE subscriber_id = '" .$subid. "' AND user_ID NOT IN ('".$userid."') AND type = 2 AND is_deleted = 0");
$mysqli->close();

// send data to the browser
$grid->renderXML($result);

