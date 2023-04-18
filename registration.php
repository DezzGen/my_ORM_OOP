<?php
	
	require_once 'init.php';

	// Redirect::to(404);
	

	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			$validate = new Validate();
			$validation = $validate->check($_POST, [

				'username' => [
					'require' => true,
					'min' => 2,
					'max' => 15,
				],

				'email' => [
					'require' => true,
					'email' => true,
					'unique' => 'users'
				],

				'password' => [
					'require' => true,
					'min' => 3
				],

				'password_again' => [
					'require' => true,
					'matches' => 'password'
				]

			]);


			if( $validation->passed() ){

				$user = new User;

				$user->create([
					'username' => Input::get('username'),
					'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
					'email' => Input::get('email')
				]);

				Session::flash('success', 'register success');
				// header('Location: /test.php');
			}else{
				foreach ($validation->errors() as $error) {
					echo $error . '<br/>';
				}
			}



		}
	}

?>


<html>
<head>
	<title>Моя прослойка PDO</title>
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
				<input type="text" name="username" value="<?php echo Input::get('username') ?>">
			</div>

			<div class="field">
				<label for="email">Email</label>
				<input type="text" name="email" value="<?php echo Input::get('email') ?>">
			</div>

			<div class="field">
				<label for="password">Password</label>
				<input type="text" name="password">
			</div>

			<div class="field">
				<label for="password_again">Password again</label>
				<input type="text" name="password_again">
			</div>

			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

			<div class="field">
				<button type="submite">Submite</button>
			</div>
		</form>

	</div>


</body></html>