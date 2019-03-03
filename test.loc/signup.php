<?php
	require "includes/db.php";

	$data = $_POST;
	if( isset($data['do_signup'])){

		if( trim($data['login']) == ''){

			$errors[] = 'Введите логин!';
		}
		if( trim($data['email']) == ''){

			$errors[] = 'Введите Email!';
		}
		if( trim($data['telephone']) == ''){

			$errors[] = 'Введите номер телефона!';
		}
		if($data['password'] == ''){

			$errors[] = 'Введите пароль!';
		}
		if($data['password_2'] != $data['password']){

			$errors[] = 'Повторный пароль введён не верно!';
		}
		if($data['useragree'] == ''){

			$errors[] = 'Вы не согласились!';
		}

		if(R::count('users', "login = ?", array($data['login'])) > 0){

			$errors[] = 'Пользователь с таким логином уже существует!';
		}

		if(R::count('users', "email = ?", array($data['email'])) > 0){

			$errors[] = 'Пользователь с таким email уже существует!';
		}


		if( empty($errors))
		{
			$standart_avatar = '/img/standart_avatar.png';
			
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->telephone = $data['telephone'];
			$user->password = $data['password']/*, PASSWORD_DEFAULT);*/;
			$user->image = $standart_avatar;
			R::store($user);

			echo '<div style="color:green;">Вы успешно зарегестрированы!</div><hr>';

		} else {

			echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';

		}
	}
?>
	<meta charset="utf-8">
		<form action="/signup.php" method="POST">

			<p>
				<input type="text" name="login" placeholder="Логин" value="<?php echo $data['login'];?>">
			</p>

			<p>
				<input type="email" name="email" placeholder="Email" value="<?php echo $data['email'];?>">
			</p>

			<p>
				<input type="text" name="telephone" placeholder="Номер телефона" value="<?php echo $data['telephone'];?>">
			</p>

			<p>
				<input type="password" name="password" placeholder="Пароль" value="<?php echo $data['password'];?>">
			</p>

			<p>
				<input type="password" name="password_2" placeholder="Подтверждение пароля" value="<?php echo $data['password_2'];?>">
			</p>

			<p>
				<a href="">Пользовательсоке соглашение.</a>
			</p>

			<p>
				<input type="checkbox" name="useragree">Я согласен.</br>
			</p>

			<p>
				<button type="submit" name="do_signup">Зарегистрироваться</button>
			</p>

		</form>