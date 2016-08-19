<?php

function user_create(){
	$user = array();
	$user['user_name'] = helpers_generate_random_string();
	$user['last_checked'] = time();
	return $user;
}

function user_save(&$user_array, &$user){
	$user_array[$user['user_name']] = $user;
	data_set('user', $user_array);
}