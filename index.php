<?php

	require_once 'init.php';

	echo Session::flash('success');
	echo '<br/>';
	$user = new User;

	if($user->isLoggedIn()){
		echo "Hi, <a href='#'>{$user->data()->username}</a>";
		echo '<p><a href="logout.php">Logout</a></p>';
		echo '<p><a href="update.php">Update profile</a></p>';
		echo '<p><a href="changepassword.php">Change password</a></p>';

		if($user->hasPermissions('admin')){
			echo 'You are admin!';
		}
	}else{
		echo '<a href="login.php">Login</a> or <a href="registration.php">Registration</a>';
	}
