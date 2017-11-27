<?php
function API_addWords($mas)
{
	$sql_delete = 'DELETE FROM `ed_words` WHERE';
	$sql_insert = 'INSERT INTO `ed_words` (eng,rus,owner) VALUES ';
	$i = 0;
	$eng = NULL;
	$pdo = dbInit();
	$owner = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);
	if($owner == 0){
		return '-1';
	}

	foreach ($mas as $word) {
		if($i % 2 == 0) {//eng
			$eng = $word;
		}
		else {//rus		
			$len  = mb_strlen($eng);
			if($len == 0 || $len > 20)
				return '-2';
			$len = mb_strlen($word);
			if($len == 0 || $len > 20)
				return $len;//'-3';

			if(preg_match('/[^a-zA-Z_\s\-0-9]+/i', $eng))
				return '-4';
			
			$word = $pdo->quote($word);
			$eng = $pdo->quote($eng);

			$sql_delete .= " eng LIKE $eng OR";
			$sql_insert .= "($eng,$word,$owner),";
		}
		$i++;
	}
	$sql_delete = substr($sql_delete, 0, -3)." AND owner=$owner;";
	$sql_insert = substr($sql_insert, 0, -1).';';

	$pdo->exec($sql_delete);
	$result = $pdo->exec($sql_insert) * 1;
	if($result == 0)
		return '0';
	else
		return getWordsCount($pdo, $owner);
}
function API_loadWords($mas)
{
	$wordsCount = clearInt($mas['wordsCount']);
	$pdo = dbInit();
	$owner = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);

	$sql_select = "SELECT eng,rus FROM ed_words WHERE owner=$owner ORDER BY id DESC LIMIT $wordsCount, 20";
	$result = $pdo->query($sql_select);
	$rows = $result->fetchAll();

	return json_encode($rows);
}
function API_loadTestWord($mas)
{
	$wordNum = clearInt($mas['wordNum']);
	$pdo = dbInit();
	$owner = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);
	if($owner == 0)
		return '-1';

	$sql_select = "SELECT COUNT(id) FROM ed_words WHERE owner=$owner";
	$result = $pdo->query($sql_select);
	$row = $result->fetch(PDO::FETCH_NUM);
	if($row[0] == 0)
		return '-2';

	$sql_select = "SELECT eng,rus FROM ed_words WHERE owner=$owner ORDER BY id DESC LIMIT $wordNum, 1";
	$result = $pdo->query($sql_select);
	$row = $result->fetch(PDO::FETCH_ASSOC);

	if($row['eng'] == null)
		return '-3';

	return json_encode($row);
}
function API_updateWordStat($mas) {
	$pdo = dbInit();
	$owner = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);
	if($owner == 0)
		return '-1';

	$eng = $pdo->quote(clearStr($mas['eng']));
	$success = clearStr($mas['success']);

	$sql_update = 'UPDATE ed_words SET attempts=attempts+1';

	if($success === '1')
		$sql_update .= ', success=success+1';

	$sql_update .= " WHERE eng=$eng AND owner=$owner;";

	$result = $pdo->exec($sql_update) * 1;

	return $result;
}
function API_translate($mas)
{
	$url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
	$params = array(
		'key' => 'trnsl.1.1.20171124T104006Z.59038034f7dd1376.6b3546ca7deedcd0e4e231fff352f8a8f7ac3ceb',
		'lang' => 'en-ru',
	    'text' => $mas['text']
	);
	$result = file_get_contents($url, false, stream_context_create(array(
	    'http' => array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query($params)
	    )
	)));

	echo $result;
}
?>