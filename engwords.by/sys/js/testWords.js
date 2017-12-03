var wordNum = 0;//Следующее загружаемое слово
var currentEngWord, currentRusWord = null;//Текущее слово
var nextEngWord, nextRusWord = null;//Следующее слово

function loadWord(first) {
	$.ajax({
		type:'POST',
		url:'/api/api.index.php?func=loadTestWord',
		data: 'wordNum='+wordNum,
		success: function(msg) {
			if(msg == '-1')
				showMessage('.error', 'Ошибка авторизации!', 2000);
			else if(msg == '-2') {
				$('.showRow, #answer').hide();
				$('.testContent').append('<p id="emptyDict">Словарь пуст.</p>');
			}
			else if(msg == '-3' && first !== 'second') {
				showMessage('.success', 'Конец списка!', 2000);
				wordNum = 0;
				loadWord();
			}
			else {
				$('.showRow, #answer').show();
				var word = JSON.parse(msg);

				nextEngWord = word.eng;
				nextRusWord = word.rus;

				wordNum++;

				if(first === 'first')
				{
					currentEngWord = nextEngWord;
					currentRusWord = nextRusWord;
					$('#engWord').text(currentEngWord);
					loadWord('second');
				}
			}
		}
	});
}

function updateWordStat(answer) {
	$.ajax({
		type:'POST',
		url:'/api/api.index.php?func=updateWordStat',
		data: 'eng='+currentEngWord+'&success='+answer,
		success: function(msg) {
			if(msg == '-1')
				showMessage('.error', 'Ошибка авторизации!', 2000);
		}
	});
}

$(document).ready(function(){
	var isTranslate = false;

	loadWord('first');

	$('#rusWord').click(function(){
		$('#rusWord').text(currentRusWord);
		$('#answer div').css('color', '');
		isTranslate = true;
	});

	$('#yes, #no').click(function(){
		if(isTranslate == false)
			return showMessage('.error', 'Переведите слово', 2000);

		var id = $(this).attr('id');

		if(id == 'yes') {
			updateWordStat(1);
		}
		else {
			updateWordStat(2);
		}


		currentEngWord = nextEngWord;
		currentRusWord = nextRusWord;

		$('#engWord').text(currentEngWord);
		$('#rusWord').text('?');

		loadWord();
		isTranslate = false;
	});
});