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
	$config = parse_ini_file(ROOT.'/sys/config.ini', true);
	$dsn = "{$config['database']['dbdriver']}:host={$config['database']['dbhost']};dbname={$config['database']['dbname']}";
	try {
		$pdo = new PDO($dsn, $config['database']['dbuser'], $config['database']['dbpassword']);
	}catch(PDOException $e) {
		exit('Возникла ошибка соединения с БД: '.$e->getMessage());
	}
	return $pdo;
}
function dbRegister($pdo, $login, $email, $password){
	if(iconv_strlen($login) > 30)
		return 'Максимальная длина логина 30 символов!';
	if(iconv_strlen($email) > 30)
		return 'Максимальная длина почты 30 символов!';
	
	$login = $pdo->quote($login);
	$email = $pdo->quote($email);
	$password = $pdo->quote(md5($password));

	$sql_check = "SELECT COUNT(id) FROM ed_users WHERE login=$login";
	$stmt = $pdo->query($sql_check);
	$row = $stmt->fetch(PDO::FETCH_NUM);
	if($row[0] > 0) {
	    return 'Аккаунт с таким логином уже зарегистрирован!';
	}
	$sql_check = "SELECT COUNT(id) FROM ed_users WHERE email=$email";
	$stmt = $pdo->query($sql_check);
	$row = $stmt->fetch(PDO::FETCH_NUM);
	if($row[0] > 0) {
	    return 'Аккаунт с этой почтой уже зарегистрирован!';
	}
	else
	{
	    // Добавляем учетную запись в таблицу ts_users
	    $sql_insert = "INSERT INTO ed_users (login, email, password) VALUES ($login, $email, $password)";
	    $stmt = $pdo->exec($sql_insert);
	}
	return '';
}
function dbUpdateHash($pdo, $id){
	$hash = md5(rand(0, 6400000));
	$sql_update = "UPDATE ed_users SET hash='$hash' WHERE id='$id'";
	if($pdo->exec($sql_update)){
		setcookie("id", $id, time() + 60*60*24*7);
		setcookie("hash", $hash, time() + 60*60*24*7);
		return $hash;
	}
	else{
		exit('Ошибка в запросе dbUpdateHash');
	}
}
function dbLogin($pdo, $login, $password){
	$login = $pdo->quote($login);
	$password = md5($password);

	$sql = "SELECT id, password FROM ed_users WHERE login=$login OR email=$login LIMIT 1";
	if(!$stmt = $pdo->query($sql)){
		exit('Ошибка в запросе dbLogin 1');
	} 
	else {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$row)
			return 'Логин не найден!';
		else {
			$db_password = $row['password'];
			$db_id = $row['id'];

			if($password == $db_password){
				dbUpdateHash($pdo, $db_id);
				return '';
			}
			return 'Неверный пароль!';
		}
	}
}
function check($pdo, $cookie_id, $cookie_hash){  
    if(empty($cookie_id) || empty($cookie_hash)){
        return 0;
    } else {
        $sql = "SELECT hash FROM ed_users WHERE id='$cookie_id'";
        if(!($stmt = $pdo->query($sql))){
            return 0;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return 0;
            } else {
                $db_hash = $row['hash'];
                if($cookie_hash == $db_hash){
                    return $cookie_id;
                }
                return 0;
            }
        }
    }
}

//подключение скриптов страниц
foreach (glob(ROOT."/sys/pagescode/*Code.php") as $filename) {
    require_once($filename);
}
?>