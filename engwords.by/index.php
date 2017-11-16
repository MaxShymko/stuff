<?php
//https://golos.io/@rusldv
	require_once($_SERVER["DOCUMENT_ROOT"].'/sys/core.php');

	$request = explode("/", $_SERVER["REQUEST_URI"]);

	switch($request[1]) {
		case '':
			$tpl = 'login';
		break;
		case 'registration':
			$error = registrationCode();
			$tpl = 'registration';
		break;
		case 'login':
			$tpl = "login";
		break;
		default:
			$tpl = "test";
	}
	include_once($_SERVER["DOCUMENT_ROOT"].'/sys/templates/index.tpl.php');
?>