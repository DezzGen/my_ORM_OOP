<?php
	
	require_once 'init.php';

	$user = new User;

	$validate = new Validate();

	$validate->check($_POST, [
		'username' => [
			'require' => true,
			'min' => 2
		]
	]);

	// echo Input::get('username');

	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			if( $validate->passed() ){

				$user->update(['username' => Input::get('username')]);
				Redirect::to('update.php');
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
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?php echo Input::get('username') ?>">
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

				<div class="field">
					<button type="submite">Submite</button>
				</div>
			</form>

		</div>


	</body>
</html>