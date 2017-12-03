<h1>Мои слова</h1>
<br>
<div class="addWordsBorder">
	<div class="caption">
		<div class="wordsCountContainer">
			Всего слов: <span id="wordsCounter"><?=getWordsCount($GLOBALS['pdo'], $GLOBALS['this_id']);?></span>
		</div>
		<div class="addWordsLinkContainer">
			<a id="addwordslink" href="/addwords">Добавить слова</a>
		</div>
	</div>
	<table border="1" id="wordsTable">
		<tr>
			<th>Номер</th>
			<th>Английский</th>
			<th>Русский</th>
		</tr>
		<?=generateWordsTable($GLOBALS['pdo'], $GLOBALS['this_id']);?>
	</table>
</div>
