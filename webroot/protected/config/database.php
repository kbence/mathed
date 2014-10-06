<?php

$config = json_decode(file_get_contents(dirname(__FILE__) . '/../../../config.json'));
$mysql = $config->mysql;

// This is the database connection configuration.
return array(
	'connectionString' => "mysql:host=$mysql->host;dbname=$mysql->database",
	'emulatePrepare' => true,
	'username' => $mysql->username,
	'password' => $mysql->password,
	'charset' => 'utf8',
);