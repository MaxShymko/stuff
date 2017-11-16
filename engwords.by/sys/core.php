<?php 
// Обработка текста
function clearInt($num){
    return abs((int)$num);
}
function clearStr($str){
    return trim(strip_tags($str));
}
function clearHTML($html){
    return trim(htmlspecialchars($html));
}

// Работа с БД
function dbInit(){
	$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"].'/sys/config.ini', true);
	echo '<pre>';
	print_r($config);
	$dsn = "{$config['database']['dbdriver']}:host={$config['database']['dbhost']};dbname={$config['database']['dbname']}";
	return new PDO($dsn, $config['database']['dbuser'], $config['database']['dbpassword']);
}
function dbRegister($pdo, $login, $email, $password){
	$email = $pdo->quote($email);
	$password = $pdo->quote(md5($password));
	$sql_check = "SELECT COUNT(id) FROM ed_users WHERE email=$email";
	$stmt = $pdo->query($sql_check);
	$row = $stmt->fetch(PDO::FETCH_NUM);
	if($row[0] > 0) {
	    return 'Аккаунт с этой почтой уже зарегистрирован!';
	}else{
	    // Добавляем учетную запись в таблицу ts_users
	    $sql_insert = "INSERT INTO ed_users (login, email, password) VALUES ($login, $email, $password)";
	    $stmt = $pdo->query($sql_insert);
	}
	return '';
}

//подключение скриптов страниц
require_once($_SERVER["DOCUMENT_ROOT"].'/sys/pagescode/registrationCode.php');
?>