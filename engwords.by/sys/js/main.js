
function include(url) {
	$('body').append('<script src="'+url+'"></script>')
}
var showMessage = (function() {
	var i = 0;
	var messCount = 0;
	var maxMessCount = 3;//Количество возможных отображаемых сообщения одновременно
	return function(type, msg, delay) {
		if(messCount >= maxMessCount) {
			var remElem = $('#showMessWrapper_'+(i-maxMessCount));
			remElem.slideUp(300, function() {
				remElem.remove();
				messCount = messCount > 0 ? messCount - 1 : 0;
			});
		}
		$('.messageDiv').append('<div id="showMessWrapper_'+i+'"><div class="'+type.match(/\w+$/)+'" id="showMess_'+i+'" style="display: none;">'+msg+'</div></div>');
		messCount++;
		$('#showMess_'+i).slideDown(300, function(){
			$(this).delay(delay).slideUp(300, function(){
				if($(this).length) {
					console.log($(this).parent().attr('id'));
					$(this).parent().remove();
					messCount = messCount > 0 ? messCount - 1 : 0;
				}
			});
		});
		i++;
		return false;
	}
})();


$(document).ready(function(){

	include('/sys/js/addWords.js');
});