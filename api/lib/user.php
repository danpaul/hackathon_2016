<?php

$USER_EXPIRY = 15;

function user_create(){
	$user = array();
	$user['user_name'] = helpers_generate_random_string();
	$user['last_checked'] = time();
	$user['long'] = 0.0;
	$user['lat'] = 0.0;
	$user['paused'] = false;
	$user['matches'] = array();
	return $user;
}

function user_save(&$user_array, &$user){
	$user_array[$user['user_name']] = $user;
	data_set('user', $user_array);
}

function user_update_position(&$user_array, $user, $lat, $long){
	global $USER_EXPIRY;

	$now = time();
	$user_array[$user]['lat'] = floatval($lat);
	$user_array[$user]['long'] = floatval($long);

	$user_array[$user]['last_checked'] = $now;
	
	// clean expired users
	$clean_array = array();
	foreach ($user_array as $user_name => $user) {
		if( !($user['last_checked'] < ($now - $USER_EXPIRY))  ){
			$clean_array[$user_name] = $user;
		}
	}
	data_set('user', $clean_array);
}

// function user_clean_and_set()