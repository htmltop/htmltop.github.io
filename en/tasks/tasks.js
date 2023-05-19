$(document).ready(function() {
	$(".new-task").click(function() {
	 	if (i === 10){
	 		console.log("Error: you already have 10 tasks")
	 		alert("You have already 10 tasks");
	 		$(this).css("display", "none");
	 	}
	 	else{
	 		$(tasks[i]).toggleClass("active")
	 	}
	 	i++	
	})
	$(".title").click(function() {
 		text = prompt("Write your own task");
 		$(this).closest(".goal").find(".text").html(text)
	})
		$(".plus").click(function() {
		$(this).closest("#content").find(".all-roles").toggleClass("active");
	});

	$(".img").click(function() {
		$(this).closest("#content").find(".all-roles").toggleClass("active");
		$(this).closest(".task").find(".plusic").attr("src", this.src);
	});
})
let i = 0
let tasks = [".task1",".task2",".task3",".task4",".task5",".task6",".task7",".task8",".task9",".task10"];
let text