<?php

	header("Content-Type: text/html; charset=utf-8");
	
	session_start();
	
	require 'classes/my_pdo.php';
	require 'classes/config.php';
	require 'classes/validate.php';
	require 'classes/input.php';
	require 'classes/token.php';
	require 'classes/session.php';
	require 'classes/user.php';
	require 'classes/redirect.php';
	require 'classes/cookie.php';

	

	$GLOBALS['config'] = [
		'mysql' => [
			'host' => 'localhost',
			'dbname' => 'test',
			'username' => 'apecoder',
			'password' => 'privetadmin',
		],
		'session' => [
			'token_name' => 'token',
			'user_session' => 'user'
		],
		'cookie' => [
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800
		]
	];


	if(Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))){
		$hash = Cookie::get(Config::get('cookie.cookie_name'));
		$hashCheck = Database::getInstance()->get('user_session', ['hash', '=', $hash]);

		if($hashCheck->count()){
			$user = new User($hashCheck->first()->user_id);
			$user->login(); 
		}
	}
