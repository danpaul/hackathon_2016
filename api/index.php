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
}