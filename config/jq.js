$(document).ready(function(){
$('#keluhan').keyup(function () {
    var left = 255 - $(this).val().length;
	if($(this).val().length > 255){
        $(this).val($(this).val().substr(0, characters));
        }
    if (left < 0) {
        left = 0;
		$('#count').css('color','red');
		$('#count').text('* Characters left: ' + left);
    }else{
    $('#count').text('Characters left: ' + left);
}});});