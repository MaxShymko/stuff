//var totalWords = 0;//Сколько слов уже загружено

function showMoreWords() {
	var totalWords = $('table#wordsTable tr').length-1;
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
	$(window).scroll(function() {
		if($(window).scrollTop()+$(window).height()>=$(document).height()){
			showMoreWords();
		}
	});
});