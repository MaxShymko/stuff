<h1>Добавить слова</h1>
<br><br>
<div class="addWordsBorder">
	<div class="preWordPlace">
		<button id="addWordInp" title="Добавить поле">+/-</button>
		<a href="http://translate.yandex.ru/" id="yandexLink" target="_blank">Переведено сервисом Яндекс</a>
	</div>
	<form id="addwordsform">
		<div class="newword" id="newword_0">
			<input class="engWord" type="text" id="eng_0" placeholder="word" maxlength="20" required>
			<input type="text" id="rus_0" placeholder="перевод" maxlength="20" required>
		</div>
	</form>
	<button id="sendWords">Добавить в словарь</button>
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
</div>
