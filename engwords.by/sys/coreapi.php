<?php
function API_addWords($mas)
{
	$sql_insert = 'INSERT INTO `ed_words` (eng,rus,owner) VALUES ';
	$sql_delete = 'DELETE FROM `ed_words` WHERE';
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
			$len  = strlen($eng);
			if($len == 0 || $len > 20)
				return '-2';
			$len = strlen($word);
			if($len == 0 || $len > 20)
				return '-3';
			
			$word = $pdo->quote($word);
			$eng = $pdo->quote($eng);
			$sql_delete .= " eng LIKE $eng OR";
			$sql_insert .= "($eng,$word,$owner),";
		}
		$i++;
	}
	$sql_insert = substr($sql_insert, 0, -1).';';
	$sql_delete = substr($sql_delete, 0, -3).';';

	//return $sql_delete.$sql_insert;
	$pdo->exec($sql_delete);
	return $pdo->exec($sql_insert) * 1;
}
?>