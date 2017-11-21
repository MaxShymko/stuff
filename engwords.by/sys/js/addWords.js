var nextid = 1;//Ид полей для добавления
var totalWords = 0;//Сколько слов уже загружено

function showMoreWords() {
	totalWords = $('table#wordsTable tr').length-1;
	$.ajax({
		type:'POST',
		url:'/api/api.index.php?func=loadWords',
		data: 'wordsCount='+totalWords,
		success: function(msg) {
			var words = JSON.parse(msg);			

			if(!words.length)
				return;

			var i = totalWords + 1;

			words.forEach(function(word){
				$("#wordsTable").append("<tr><td>"+i+"</td><td>"+word.eng+"</td><td>"+word.rus+"</td></tr>");
				i++;
			});
		}
	});
}

$(document).ready(function(){
	$('#addWordInp').click(function(){
		$('#addwordsform').append('\
			<div class="newword" id="newword_'+(nextid)+'">\
				<input type="text" name="eng_'+(nextid)+'" placeholder="word" maxlength="20" required>\
				<input type="text" name="rus_'+(nextid)+'" placeholder="перевод" maxlength="20" required>\
			</div>'
		);
		nextid++;
	});
	$('#sendWords').click(function(){
		var words = {};
		$('#addwordsform').find ('input').each(function() {
			words[this.name] = $(this).val();
		});

		$.ajax({
			type:'POST',
			url:'/api/api.index.php?func=addWords',
			data: words,
			success: function(msg) {
				if(msg > 0) {
					$('#wordsCounter').text(msg);
					showMessage('.success', 'Слова успешно добавлены!', 2000);
				}
				else{
					showMessage('.error', 'Ошибка добавления!', 2000);
				}
			}
		});
	});

	$(window).scroll(function() {
		if($(window).scrollTop()+$(window).height()>=$(document).height()){
			showMoreWords();
		}
	});
});