$(document).ready(function(){
	function include(url) {
		$('body').append('<script src="'+url+'"></script>')
	}
	

	include('/sys/js/addWords.js');
});