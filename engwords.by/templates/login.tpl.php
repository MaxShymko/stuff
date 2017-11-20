<div class="loginborder">
	<h1>Войдите в аккаунт</h1>
	<form action="/login" method="POST" id="login">
		Логин<br>
		<input class="formlogtext" type="text" name="login" maxlength="10" value="<?=$_POST['login']?>" required>
		<br><br>
		Пароль<br>
		<input class="formlogtext" type="password" name="password" maxlength="30" required>
		<br><br>
		<input id="formlogsub" type="submit" value="Войти" name="submit">
	</form>
	<p>Ещё нет аккаутна? <a href="/registration">Создать</a></p>
	<?php if($error !== '') { echo '<div class="logError">'.$error.'</div>'; } ?>
</div>