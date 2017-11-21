var wordNum = 0;//Следующее загружаемое слово
var rusWord = null;

function wordLoad() {
	$.ajax({
		type:'POST',
		url:'/api/api.index.php?func=loadWord',
		data: 'wordNum='+wordNum,
		success: function(msg) {
			if(msg == '-1')
				showMessage('.error', 'Ошибка авторизации!', 2000);
			else if(msg == '-2') {
				$('.showRow, #nextTestWord').hide();
				$('.testContent').append('<p id="emptyDict">Словарь пуст.</p>');
			}
			else if(msg == '-3') {
				showMessage('.success', 'Конец списка!', 2000);
				wordNum = 0;
			}
			else {
				$('.showRow, #nextTestWord').css('visibility', 'visible');
				var word = JSON.parse(msg);

				$('#engWord').text(word.eng);
				$('#rusWord').text('?');
				rusWord = word.rus;

				wordNum++;
			}
		}
	});
}

$(document).ready(function(){

	wordLoad();

	$('#nextTestWord').click(function(){
		wordLoad();
	});

	$('#rusWord').click(function(){
		$('#rusWord').text(rusWord);
	});
});