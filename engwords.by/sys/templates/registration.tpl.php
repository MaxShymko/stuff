<div class="loginborder registerborder">
	<h1>Зарегистрировать аккаунт</h1>
	<form action="/registration" method="POST" id="login">
		Логин<br>
		<input class="formlogtext" type="text" name="login" placeholder="login" maxlength="10" required>
		<br><br>
		email<br>
		<input class="formlogtext" type="email" name="email" placeholder="email" maxlength="50" required>
		<br><br>
		Пароль<br>
		<input class="formlogtext" type="password" name="password1" placeholder="password" maxlength="30" required>
		<br><br>
		Повторите пароль<br>
		<input class="formlogtext" type="password" name="password2" placeholder="password" maxlength="30" required>
		<br><br>
		<input id="formlogsub" type="submit" value="Регистрация" name="submit">
	</form>
	<?php if($error !== '') { echo '<div class="error">'.$error.'</div>'; } ?>
</div>