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
	
	$('#addWordInp').mousedown(function(event){
		if(event.which == 1)//ЛКМ
		{
			$('#addwordsform').append('\
				<div class="newword" id="newword_'+(nextid)+'">\
					<input class="engWord" type="text" id="eng_'+(nextid)+'" placeholder="word" maxlength="20" required>\
					<input type="text" id="rus_'+(nextid)+'" placeholder="перевод" maxlength="20" required>\
				</div>\
				<p id="translateItem_'+(nextid)+'" style="display: none;">Примерный перевод: <span class="translate" id="translateWord_'+(nextid)+'" title="Добавить перевод"></span></p>'
			);
			if(nextid == 1)
				$('#addWordInp').attr('title', 'ПКМ - удалить поле');

			nextid++;
		}
		else if(event.which == 3) {//ПКМ
			if(nextid > 1) {
				nextid--;
				$('#newword_'+nextid).remove();
				$('#translateItem_'+nextid).remove();
			}
			if(nextid <= 1) {
				$('#addWordInp').attr('title', 'Добавить поле');
			}
		}
	});
	$('#addWordInp').bind('contextmenu', function(e) {
		return false;
	});

	$('body').delegate('.translate', 'click', function(){
		var id = /\d$/.exec($(this).attr('id'));
		$('#rus_'+id).val($('#translateWord_'+id).text());
	});
	
	$('body').delegate('.engWord', 'change', function(){
		var id = /\d$/.exec($(this).attr('id'));
		$.ajax({
			type:'POST',
			url:'/api/api.index.php?func=translate',
			data:'text='+$(this).val(),
			success: function(msg) {
				var response = JSON.parse(msg);
				if(response.code == 200) {
					var translate = $('#translateWord_'+id);
					$('#translateWord_'+id).text(response.text);
					$('#translateItem_'+id).css('display', 'inline');
				}
			}
		});
	});

	$('#sendWords').click(function(){
		var words = {};
		$('#addwordsform').find('input').each(function() {
			words[this.id] = $(this).val();
		});

		$.ajax({
			type:'POST',
			url:'/api/api.index.php?func=addWords',
			data: words,
			success: function(msg) {
				if(msg == '0') {
					showMessage('.error', 'Ошибка добавления!', 2000);
				}
				if(msg == '-1') {
					showMessage('.error', 'Ошибка авторизации!', 2000);
				}
				if(msg == '-2' || msg == '-3') {
					showMessage('.error', 'Слово не может не содержать или быть длиннее 20 символов!', 2000);
				}
				if(msg == '-4') {
					showMessage('.error', 'Слово на англ. должно содержать только англ. символы!', 2000);
				}
				if(msg > 0) {
					$('#wordsCounter').text(msg);
					showMessage('.success', 'Слова успешно добавлены!', 2000);
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