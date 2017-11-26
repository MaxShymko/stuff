<h1>Мои слова</h1>
<br>
<div class="addWordsBorder">
	<table border="1" id="wordsTable">
		<caption>Всего слов: <span id="wordsCounter"><?=getWordsCount($GLOBALS['pdo'], $GLOBALS['this_id']);?>. </span><a id="addwordslink" href="/addwords">Добавить слова</a></caption>
		<tr>
			<th>Номер</th>
			<th>Английский</th>
			<th>Русский</th>
		</tr>
		<?=generateWordsTable($GLOBALS['pdo'], $GLOBALS['this_id']);?>
	</table>
</div>
