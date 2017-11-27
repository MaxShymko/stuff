<?php 
//Возвращает ошибку или её отсутствие
function mywordsCode() {
	
	return '';
}
function getWordsCount($pdo, $id) {
	$sql_check = "SELECT COUNT(id) FROM ed_words WHERE owner=$id";
	$stmt = $pdo->query($sql_check);
	return $stmt->fetch(PDO::FETCH_NUM)[0];
}
function generateWordsTable($pdo, $id){
	$str = '';
	$sql_select = "SELECT eng, rus FROM ed_words WHERE owner=$id ORDER BY id DESC LIMIT 20";
	$i = 1;
    foreach ($pdo->query($sql_select) as $row) {
		$str .= "<tr><td>".$i."</td><td>".$row['eng']."</td><td>".$row['rus']."</td></tr>";
		$i++;
    }
	return $str;
}
?>