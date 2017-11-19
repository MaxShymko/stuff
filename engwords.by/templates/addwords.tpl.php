<h1>Добавить слова. Всего слов: <?=getWordsCount();?></h1>
<br><br>
<div class="addWordsBorder">
	<form action="/api/api.index.php?func=addWords" method="POST" id="addwordsform">
		<div class="newword" id="newword_0">
			<input type="text" name="eng_0" id="eng" placeholder="word" maxlength="20" required>
			<input type="text" name="rus_0" id="rus" placeholder="перевод" maxlength="20" required>
		</div>
	</form>
	<div class="addWordsButtons">
		<button id="sendWords">Добавить в словарь</button>
		<button id="addWordInp" title="Добавить поле">+</button>
	</div>
</div>

<?php if($error !== '') { echo '<div class="error">'.$error.'</div>'; } ?>
