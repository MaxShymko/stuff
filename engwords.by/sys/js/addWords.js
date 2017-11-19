$(document).ready(function(){
	var nextid = 1;
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
		$('#addwordsform').submit();
	});

});