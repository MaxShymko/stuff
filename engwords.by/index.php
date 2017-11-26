<?php
//https://golos.io/@rusldv
	define(ROOT, $_SERVER['DOCUMENT_ROOT']);
	require_once(ROOT.'/sys/core.php');

	//db connect
	$pdo = dbInit();

	$request = explode("/", $_SERVER["REQUEST_URI"]);

	//is authorize
	$this_id = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);
	if(!$this_id && $request[1] != 'registration')
		$request[1] = 'login';

	switch($request[1]) {
		case 'registration':
			$error = registrationCode();
			$tpl = 'registration';
		break;
		case 'logout':
			logoutCode();
		break;
		case 'login':
			$error = loginCode();
			$tpl = "login";
		break;
		case 'test':
			$error = testCode();
			$tpl = "test";
		break;
		case 'addwords':
			//$error = addwordsCode();
			$tpl = "addwords";
		break;
		case 'mywords':
			//$error = mywordsCode();
			$tpl = "mywords";
		break;
		default:
			header('Location: /mywords');
		break;
	}
	include_once(ROOT.'/templates/index.tpl.php');
?>