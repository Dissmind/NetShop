<meta charset="utf-8">

<?php
	require "includes/db.php";

	$data = $_POST;
	$user = $_SESSION['logged_user'];

if ( isset($_POST['do_apply']) ){

/*if ( isset($_POST['do_image']) ){

if ( $_FILES['userfile']['error'] > 0 ) {

	echo '<div style="color:red;">Ошибка!</div>';

	switch ( $_FILES['userfile']['error'] ) {

		case 1:
			$errors[] = 'Размер фала больше допустимого (upload_max_filesize в php.ini).';
		break;

		case 2:
			$errors[] = 'Размер фала больше допустимого (max_file_size в форме).';
		break;

		case 3:
			$errors[] = 'Загружена только часть файла.';
		break;

		case 4:
			$errors[] = 'Файл не был загружен.';
		break;

		case 6:
			$errors[] = 'Загрузка невозможна: не задан временный каталог.';
		break;

		case 7:
			$errors[] = 'Загрузка не выполнена: невозможна запись на диск.';
		break;
	}
};
if(!is_uploaded_file($_FILES["userfile"]["tmp_name"])){
    $errors[] = "Файл не загружен.";
}
if($_FILES["userfile"]['size'] > 10485760){
    $errors[] = "Файл слишком большой";
};

if ( ($_FILES['userfile']['type'] != 'image/png') && ($_FILES['userfile']['type'] != 'image/jpeg') && ($_FILES['userfile']['type'] != 'image/bmp') ) {

	$errors[] = 'Данный файл не являесться изображением!';

};

if( empty($errors) ){
	$upload_file = 'uploads/' . ($_FILES['userfile']['name']);
	//$_SERVER['DOCUMENT_ROOT']."/Files/".$_FILES["filename"]["name"]
	move_uploaded_file($_FILES["userfile"]["tmp_name"], $upload_file);

	echo '<div style="color:green;">Файл успешно загружен.</div><hr>';
} else {
	echo '<div style="color:red;">Ошибка! '.array_shift($errors).'</div><hr>';
}
}*/

	$user_id = $_SESSION['logged_user']->id;

	$user = R::load('users', $user_id);
	$user->login = $data['login'];
	R::store($user);

	$user = R::load('users', $user_id);
	$user->email = $data['email'];
	R::store($user);

	$user = R::load('users', $user_id);
	$user->telephone = $data['telephone'];
	R::store($user);

/*else {
	foreach($errors AS $error){
	    print $error."<br>";
	}
}*/

//if (is_upploaded_file($_FILES['userfile']['tmp_name'])){

	/*if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file)) {
		echo 'Успех!';
	} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}*/
//print_r($_FILES);
/*} else {
		echo 'Возможно атака через загрузку файла';
		exit();
}*/

}

?>

<meta charset="utf-8">

<h3>Профиль: </h3>

	<input type="hidden" name="max_file_size" value="30000">
	<form enctype="multipart/form-data" method="post" action="/userprofile.php">

		<p>
			<input type="text" name="login" placeholder="Логин" value="<?php echo $user->login; ?>">
		</p>

		<p>
			<input type="email" name="email" placeholder="Email" value="<?php echo $user->email; ?>">
		</p>

		<p>
			<input type="text" name="telephone" placeholder="Номер телефона" value="<?php echo $user->telephone; ?>">
		</p>

		<img height="100px" width="100px" src="<?php echo $user->image; ?>" alt="Аватар"><br/>

		<label for="userfile">Выберите файл: </label>
		<input type="file" name="userfile">
		<input type="submit" name="do_image" value="Применить изображение"></br>

		<input type="submit" name="do_apply" value="Применить">

	</form>