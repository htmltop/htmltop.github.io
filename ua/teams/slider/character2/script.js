$(document).ready(function() {
	$(".plus").click(function() {
		$(this).closest(".character2").find(".all-characters").toggleClass("active");
	});

	$(".img").click(function() {
		$(this).closest(".character2").find(".all-characters").toggleClass("active");
		$("#speci").attr("src", this.src);
	});
	$(".role").click(function() {
		$(this).closest(".character2").find(".all-roles").toggleClass("active");
	});
	$(".dps").click(function() {
		$(this).closest(".character2").find(".role").text($(this).text());
		$(this).closest(".character2").find(".all-roles").toggleClass("active");
	});
	$(".sub-dps").click(function() {
		$(this).closest(".character2").find(".role").text($(this).text());
		$(this).closest(".character2").find(".all-roles").toggleClass("active");
	});
	$(".support").click(function() {
		$(this).closest(".character2").find(".role").text($(this).text());
		$(this).closest(".character2").find(".all-roles").toggleClass("active");
	});
	$(".healer").click(function() {
		$(this).closest(".character2").find(".role").text($(this).text());
		$(this).closest(".character2").find(".all-roles").toggleClass("active");
	});
});