<?php
$error = '';
function registrationCode() {
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['password1'] !== $_POST['password2'])
			return 'Пароли не совпадают!';
		if(strlen($_POST['password1']) < 6 || strlen($_POST['password1']) > 30)
			return 'Пароль не может быть менее 6 и более 30 символов!';

		return dbRegister(dbInit(), $_POST['login']);
	}
	return '';
}
?>