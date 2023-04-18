<?php
	
	require_once 'init.php';

	$user = new User;

	$validate = new Validate();

	$validate->check($_POST, [
		'current_password' => [
			'require' => true,
			'min' => 6
		],
		'new_password' => [
			'require' => true,
			'min' => 6
		],
		'new_password_again' => [
			'require' => true,
			'min' => 6,
			'matches' => 'new_password'
		]
	]);


	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			if( $validate->passed() ){

				if(password_verify(Input::get('current_password'), $user->data()->password)){
					$user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
					Session::flash('success', 'Password has ben update.');
					Redirect::to('index.php');
				}else{
					echo 'Current password is invalid';
				}

			}else{
				foreach ($validate->errors() as $error) {
					echo $error . '<br/>';
				}
			}
		}
	}

?>


<html>
	<head>
		<title>Страница upgrade user</title>
		<meta charset="utf-8">

		<style>
			.wrapper{
				width: 960px;
				border: 1ps solid #313131;
				padding: 10px 10px 10px 10px;
				margin: 0 auto;
			}

		</style>
	</head>

	<body>

		<div class="wrapper">

			<form action="" method="post">
				<?php echo Session::flash('success'); ?>
				<div class="field">
					<label for="current_password">Current password</label>
					<input type="text" name="current_password" id="current_password" value="">
				</div>

				<div class="field">
					<label for="new_password">New password</label>
					<input type="text" name="new_password" id="new_password" value="">
				</div>

				<div class="field">
					<label for="username">New password again</label>
					<input type="text" name="new_password_again" id="new_password_again" value="">
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

				<div class="field">
					<button type="submite">Submite</button>
				</div>
			</form>

		</div>


	</body>
</html>