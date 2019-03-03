<?php
	require "includes/db.php";

	$data = $_POST;
	if( isset($data['do_login']))
	{
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if( $user )
		{
			if( password_verify($data['password'], $user->password))
			{

				$_SESSION['logged_user'] = $user;
				echo '<div style="color:green;">Вы успешно авторизованы!</div><hr>';
			} else
			{
				$errors[] = 'Пароль введён не верно!' ;
			}
	} else
	{
		$errors[] = 'Пользвоатель с таким логином не найден!';
	}
	if(!empty($errors))
		{
			echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
		}
	}
?>

<meta charset="utf-8">

<form action="login.php" method="POST">
	
	<p>
		<input type="text" name="login" placeholder="Логин" value="<?php echo $data['login'];?>">
	</p>

	<p>
		<input type="password" name="password" placeholder="Пароль" value="<?php echo $data['password'];?>">
	</p>

	<p>
		<button type="submit" name="do_login">Войти</button>
	</p>

</form>