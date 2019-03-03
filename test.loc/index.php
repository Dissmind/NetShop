<?php
	require "includes/db.php";
?>
<meta charset="utf-8">

<?php if(isset ($_SESSION['logged_user'])) : ?>

	<p>Авторизован!</p>
	<p>Привет, <?php echo $_SESSION['logged_user']->login; ?>!</p>

	<img height="100px" width="100px" src="<?php echo $_SESSION['logged_user']->image; ?>" alt="Аватар"><br/>
	
	<a href="/userprofile.php">Профиль</a>

	<hr>
	<a href="/logout.php">Выйти</a>

<?php else : ?>
<a href="/login.php">Авторизация</a><br/>
<a href="/signup.php">Регистрация</a>
<?php endif; ?>