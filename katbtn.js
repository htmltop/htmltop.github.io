$(document).ready(function (){
	$(".btn1").click(function() {
		$(this).closest(".buttons").find(".btn2").toggleClass("active");
		$(this).closest(".buttons").find(".btn3").toggleClass("active");
	})
})