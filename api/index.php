<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (dirname(__FILE__). '/lib/index.php');

$users = data_get('user');

$method = $_GET['method'];

// /api/index.php?method=create
if( $method === 'create' ){
	$user = user_create();
	user_save($users, $user);
	echo json_encode($user);
// /api/index.php?method=update&user=...&long=74.0059&lat=40.7128
} elseif( $method === 'update' ) {
	$user = $_GET['user'];

	if( empty($users) || empty($users[$user]) ){
		echo json_encode(array('error' => 'Could not find user, please refresh!'));
		return;
	}

	if( empty($_GET['lat']) || empty($_GET['long']) ){
		echo json_encode(array('error' => 'Missing coordinates'));
		return;
	}

	user_update_position($users, $user, $_GET['lat'], $_GET['long']);

	echo json_encode(new stdClass);
}