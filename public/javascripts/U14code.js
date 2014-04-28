/**
 *  javascript for usufruct2014.htm
 * 
 */

$(document).ready(function() {
	$("p").hide();
	$("h2").click(function() {
		$(this).nextAll().slideToggle(300);
	});
	var imgUProgBkgrnd = document.getElementById('uProgBkgrnd');
	var imgWidth = imgUProgBkgrnd.clientWidth;
	console.log('image width: ' + imgWidth);
});
