<?php
function registrationCode() {
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['password1'] !== $_POST['password2'])
			return 'Пароли не совпадают!';
		if(strlen($_POST['password1']) < 6 || strlen($_POST['password1']) > 30)
			return 'Пароль не может быть менее 6 и более 30 символов!';
		if(strlen($_POST['login']) < 1 || strlen($_POST['login']) > 10)
			return 'Логин не может быть менее 1 и более 10 символов!';

		$msg = dbRegister(dbInit(), $_POST['login'], $_POST['email'], $_POST['password1']);
		if($msg == '') {
			header('Location: /login');
		}
		else
			return $msg;
	}
	return '';
}
?>