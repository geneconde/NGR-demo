<?php
	require_once 'session.php';
	require_once 'controller/StudentCt.Controller.php';

	$ctid = $_POST['ctid'];

	$scc = new StudentCtController();

	$scc->deleteGroupsWithCT($ctid);

	foreach($_POST['gid'] as $gid) {
		$scc->attachGroupToCT($gid, $ctid);
	}