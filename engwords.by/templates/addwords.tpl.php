<h1>Добавить слова</h1>
<br><br>
<div class="addWordsBorder">
	<div class="preWordPlace">
		<button id="addWordInp" title="Добавить поле">+/-</button>
		<a href="http://translate.yandex.ru/" id="yandexLink" target="_blank" style="visibility: hidden;">Переведено сервисом Яндекс</a>
	</div>
	<form id="addwordsform">
		<div class="newword" id="newword_0">
			<input class="engWord" type="text" id="eng_0" placeholder="английский" maxlength="20" required>
			<input type="text" id="rus_0" placeholder="русский" maxlength="20" required>
		</div>
		<p id="translateItem_0" style="display: none;">Примерный перевод: <span class="translate" id="translateWord_0" title="Добавить перевод"></span></p>
	</form>
	<button id="sendWords">Добавить в словарь</button>
</div>
