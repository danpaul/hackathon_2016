<?php

function user_create(){
	$user = array();
	$user['user_name'] = helpers_generate_random_string();
	$user['last_checked'] = time();
	$user['long'] = 0.0;
	$user['lat'] = 0.0;
	$user['paused'] = false;
	return $user;
}

function user_save(&$user_array, &$user){
	$user_array[$user['user_name']] = $user;
	data_set('user', $user_array);
}

function user_update_position(&$user_array, $user, $lat, $long){
	$user_array[$user]['lat'] = floatval($lat);
	$user_array[$user]['long'] = floatval($long);
	data_set('user', $user_array);
}