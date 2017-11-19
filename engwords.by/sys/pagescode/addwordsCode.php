<?php 
//Возвращает ошибку или её отсутствие
function addwordsCode() {
	
	return '';
}
function getWordsCount() {
	$sql_check = "SELECT COUNT(id) FROM ed_words WHERE owner=".$GLOBALS['this_id'];
	$stmt = $GLOBALS['pdo']->query($sql_check);
	return $stmt->fetch(PDO::FETCH_NUM)[0];
}
?>