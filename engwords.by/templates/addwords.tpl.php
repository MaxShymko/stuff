<h1>Добавить слова</h1>
<br><br>
<div class="addWordsBorder">
	<form id="addwordsform">
		<div class="newword" id="newword_0">
			<input class="engWord" type="text" name="eng_0" id="eng" placeholder="word" maxlength="20" required>
			<input class="rusWord" type="text" name="rus_0" id="rus" placeholder="перевод" maxlength="20" required>
		</div>
	</form>
	<div class="addWordsButtons">
		<button id="sendWords">Добавить в словарь</button>
		<button id="addWordInp" title="Добавить поле">+</button>
	</div>
	<br>

	<table border="1" id="wordsTable">
		<caption>Всего слов: <span id="wordsCounter"><?=getWordsCount($GLOBALS['pdo'], $GLOBALS['this_id']);?></span></caption>
		<tr>
			<th>Номер</th>
			<th>Английский</th>
			<th>Русский</th>
		</tr>
		<?=generateWordsTable($GLOBALS['pdo'], $GLOBALS['this_id']);?>
	</table>

	<button id="loadMoreWords">Загрузить ещё</button>

</div>
