<?php
	
	require_once 'init.php';

	// Redirect::to(404);
	// echo password_hash('qwer', PASSWORD_DEFAULT);

	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			$validate = new Validate();
			$validation = $validate->check($_POST, [
				'email' => [
					'require' => true,
					'email' => true,
				],

				'password' => [
					'require' => true,
				],
			]);




			if( $validation->passed() ){

				$user = new User;

				$remember = (Input::get('remember')) === 'on' ? true : false;

				$login = $user->login(Input::get('email'), Input::get('password'), $remember);

				if( $login ){
					Redirect::to('index.php');
				}else{
					echo 'login failed';
				}

				// Session::flash('success', 'register success');
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
		<title>Страница логирования в системе</title>
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
					<label for="email">Email</label>
					<input type="text" name="email" value="<?php echo Input::get('email') ?>">
				</div>

				<div class="field">
					<label for="password">Password</label>
					<input type="text" name="password">
				</div>

				<div class="field">
					<label for="remember">Remember me</label>
					<input type="checkbox" name="remember" id="remember">
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

				<div class="field">
					<button type="submite">Submite</button>
				</div>
			</form>

		</div>


	</body>
</html>