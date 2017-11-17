<?php
function logoutCode() {
	setcookie("id", $id, time() - 60*60*24*7);
	setcookie("hash", $hash, time() - 60*60*24*7);
	header('Location: /login');
}
?>