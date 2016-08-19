<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (dirname(__FILE__). '/lib/index.php');

$users = data_get('user');
$user = user_create();
user_save($users, $user);

echo 'success';