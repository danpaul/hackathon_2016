<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (dirname(__FILE__). '/lib/index.php');

$users = data_get('user');
$userQuestions = data_get('userQuestion');
$questions = data_get('question');

$settings = json_decode(file_get_contents(dirname(__FILE__). '/../settings.json'), TRUE);
$questionCopy = json_decode(file_get_contents(dirname(__FILE__). '/../questions.json'), TRUE);

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
// /api/index.php?method=hasquestion&user=BVweTaBQZm
} elseif( $method === 'hasquestion' ){

	$user = $_GET['user'];

	if( empty($users) || empty($users[$user]) ){
		echo json_encode(array('error' => 'Could not find user, please refresh!'));
		return;
	}

	$result = question_user_get($users, $user, $userQuestions, $questions, $questionCopy);
	echo json_encode($result);

// /api/index.php?method=unpause&user=...
} elseif( $method === 'unpause' ){
	// TODO
	// clear questions on unpause
	// update user object on unpause
}