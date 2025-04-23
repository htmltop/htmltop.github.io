function changeleft() {
	var left = $('#special-offers .left');
	var center = $('#special-offers .center');
	var right = $('#special-offers .right');
	left.addClass('center');
	center.addClass('right');
	right.addClass('left');
	left.removeClass('left');
	center.removeClass('center');
	right.removeClass('right');
}
function changeright() {
	var left = $('#special-offers .left');
	var center = $('#special-offers .center');
	var right = $('#special-offers .right');
	left.addClass('right');
	center.addClass('left');
	right.addClass('center');
	left.removeClass('left');
	center.removeClass('center');
	right.removeClass('right');
}