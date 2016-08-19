<?php


$DATA_PATH = dirname(__FILE__). '/../data';

// $test = array('a' => 'bar');

// $result = file_put_contents(($data_path. '/test.json'), json_encode($test));

// $contents = json_decode(file_get_contents($data_path. '/test.json'), TRUE);

// var_dump($contents);
// die();

function data_get($stor_name){
	$path = data_get_path($stor_name);
	$data = json_decode(file_get_contents($path), TRUE);

	if( !$data ){
		$data = array();
	}

	return $data;
}

function data_set($stor_name, $data){
	$path = data_get_path($stor_name);
	file_put_contents($path, json_encode($data));
}

function data_get_path($stor_name){
	global $DATA_PATH;
	return $DATA_PATH. '/'. $stor_name. '.json';	
}