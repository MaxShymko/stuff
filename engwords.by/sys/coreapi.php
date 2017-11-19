<?php 
function API_addWords($mas)
{
	$sql = 'INSERT INTO `ed_words` (eng,rus,owner) VALUES ';
	$i = 0;
	$eng = NULL;
	$pdo = dbInit();
	$owner = check($pdo, $_COOKIE['id'], $_COOKIE['hash']);
	if($owner == 0)
		header('Location: /login');
	foreach ($mas as $word) {
		if($i % 2 == 0) {//eng
			$eng = $word;
		}
		else {//rus
			$eng = $pdo->quote($eng);
			$word = $pdo->quote($word);
			$sql .= "($eng,$word,$owner),";
		}
		$i++;
	}
	$sql = substr($sql, 0, -1).';';

	$pdo->exec($sql);
	
	header('Location: /addwords');
}
?>