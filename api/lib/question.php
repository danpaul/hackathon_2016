<?php

function question_user_get(&$users, $user, &$user_questions, &$questions, $question_copy){
	$u = $users[$user];

	// check if user if user is paused, return false if so
	if( $u['paused'] ){ return new stdClass; }

	// check if question exist for user and return question if so
	foreach( $user_questions as $question_id => $question) {
		foreach( $question['answers'] as $user_id => $value) {
			if( $user_id === $user ){
				return $question;
			}
		}
	}

	$matched_user = null;
	// check if any user is in the same radius and is not the user themselves and is not already paused
	foreach ($users as $user_name => $user_data) {
		if( !$user_data['paused'] && $user_name !== $user ){
			// TODO add check if user has already met this user
			// TODO check radius
			$matched_user = $user_data;
		}
	}

	if( !$matched_user ){ return new stdClass; }

// var_dump($matched_user['user_name']);
// die();

	// create a question
	$question = array();

// TODO:
// add radius check
// add check if users already answered

	$question_id = helpers_generate_random_string();
	$number_of_questions = count($question_copy);
	$random_question = rand(0, ($number_of_questions - 1));

	$question['id'] = $question_id;
	$question['question_number'] = $random_question;
	$question['answers'] = array();

	$question['answers'][$user] = null;
	$question['answers'][$matched_user['user_name']] = null;

	$question['match'] = null;
	$question['appearin'] = 'https://appear.in/'. helpers_generate_random_string();

// var_dump($question);
// die();

// var_dump($matched_user['user_name']);
// die();

	// save question
	$questions[$question_id] = $question;
// var_dump($questions);
// die();

	data_set('question', $questions);

	// pause both users
	$users[$user]['paused'] = true;
	$users[$matched_user['user_name']]['paused'] = true;
	data_set('user', $users);

	return $question;	
}


function question_create(&$user_questions, &$questions, $question_copy){
	$question = array();
	$question_id = helpers_generate_random_string();
	$number_of_questions = count($question_copy);
	$random_question = rand(0, ($number_of_questions - 1));

	$question['question_number'] = $random_question;
}

function question_answer(&$questions, $question_id, $user_name, $answer){
	$questions[$question_id]['answers'][$user_name] = $answer;
	data_set('question', $questions);
}

function quesiton_remove_users($user_questions, $user){
	$clean_questions = array();
	foreach( $user_questions as $question_id => $question) {
		$match = false;
		foreach( $question['answers'] as $user_id => $value) {
			if( $user_id === $user ){
				$match = true;
			}
		}
		if( !$match ){
			$clean_questions[$question_id] = $question;
		}
	}
	data_set('question', $clean_questions);
}