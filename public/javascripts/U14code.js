/**
 *  javascript for usufruct2014.htm
 * 
 */

$(document).ready(function() {
	$("#tabs").tabs();
	
	$("#inviteTab div p").hide();

	$("#inviteTab div h2").nextAll().fadeIn(2000);

/*
	?Do I want to use image width pecentage for placement of text?
	var imgUProgBkgrnd = document.getElementById('uProgBkgrnd');
	var imgWidth = imgUProgBkgrnd.clientWidth;
	console.log('image width: ' + imgWidth);
*/
});

/*
Tried this first:
	$("h2").click(function() {
		$(this).nextAll().slideToggle(300);
	});
	
Chaining sample code:	
$(document).ready(function () {
	var $grid = $('#bab_grid');
	var $lists = $grid.find('li');

	$lists.css('background', '#600');
	$lists.animate({width: '-=100'}, 2000);
	$lists.fadeOut()
	$lists.fadeIn('slow');
});
*/