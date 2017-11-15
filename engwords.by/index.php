<?php
	include_once "config.php";

	if($_POST["submit"]) {

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>engwords</title>
	<link rel="stylesheet" href="/style/style.css">
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				EngDict
			</div>
			<div class="links">
				<ul>
					<li><a href="#">Add words</a></li>
					<li><a href="#">Pass the test</a></li>
				</ul>
			</div>
		</div>
		<div class="content">
			<div class="loginborder">
				<h1>Войдите в аккаунт</h1>
				<form action="/" method="POST" id="login">
					Логин<br>
					<input class="formlogtext" type="text" name="login">
					<br><br>
					Пароль<br>
					<input class="formlogtext" type="password" name="password">
					<br><br>
					<input id="formlogsub" type="submit" value="Войти" name="submit">
				</form>
			</div>
		</div>
	</div>

</body>
</html>