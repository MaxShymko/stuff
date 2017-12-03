<?php 
//Возвращает ошибку или её отсутствие
function loginCode() {
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30)
			return 'Пароль не может быть менее 6 и более 30 символов!';
		if(strlen($_POST['login']) < 1 || strlen($_POST['login']) > 30)
			return 'Логин не может быть менее 1 и более 30 символов!';

		$msg = dbLogin($GLOBALS['pdo'], $_POST['login'], $_POST['password']);
		if($msg == '') {
			header('Location: /mywords');
		}
		else
			return $msg;
	}
	return '';
}
?>