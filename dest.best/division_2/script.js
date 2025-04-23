$(document).ready(function(){

	function make_imgs(count){
		for(var i = 0; i < count; i++){
			var num = Math.floor(Math.random() * 10)
			$("#gallery").append(
			'<a"><div class="gallery-img" style="background-image: url(\'img/' +
			num + '.png\');"></div></a>'
			)

		}
	}

	make_imgs(20)

	$(".div-more").click(function(){
		make_imgs(10)
	})

	$("#sidebar .toggle").on("click", function(){
		if($("#sidebar").hasClass("inactive")){
			$("#sidebar").animate({
				"left": "auto",
				"rigth": "20px"
			}, 1000)
			$("#sidebar").toggleClass("inactive")
		}
		else{
		$("#sidebar").animate({
			"left": "100%",
			"rigth": "auto"
		}, 1000)			
		}
	})

	$(".gallery-img").on("click", function(){
		$(this).slideUp(1000);
	})

})

////// 15.06: // робить, а тоді перевіряє

// do{
// 	var password = window.prompt("Enter password:")
// }while(password != "1")

// location.href = "https://google.com"

////// 15.06:

// document.getElementById("text-block").innerHTML += "<br><br><br>"
// // перевіряє, збільшує значення
// var i = 0
// while(i < 10){
// 	document.getElementById("text-block").innerHTML += "<br>" + i.toString() + ". while 0 - 9"
// 	i += 1
// }

// document.getElementById("text-block").innerHTML += "<br><br><br>"
// // перевіряє, зменшує значення
// var i = 10
// while(i > 0){
// 	i -= 1
// 	document.getElementById("text-block").innerHTML += "<br>" + i.toString() + ". while 9 - 0"
// }

// document.getElementById("text-block").innerHTML += "<br><br><br>"
// // робить. а тоді перевіряє
// var i = 0
// do{
// 	document.getElementById("text-block").innerHTML += "<br>" + i.toString() + ". do while 0 - 9"
// 	i += 1
// }while(i < 10)

// document.getElementById("text-block").innerHTML += "<br><br><br>"
// // for. Компактно вказуються усі три дії - на початку / превірка / під кінець кроку
// for(var i = 0; i < 10; i += 1){
// 	document.getElementById("text-block").innerHTML += "<br>" + i.toString() + ". for 0 - 9"
// }

////// Старе

// var color = window.prompt("Choose color (red/dark/white):");
// if (color == "red"){
// 	document.getElementById("content").style.backgroundColor = "#f00"
// }
// else if(color == "dark"){
// 	document.getElementById("content").style.backgroundColor = "#111"
// }
// else if(color == "white"){
// 	document.getElementById("content").style.backgroundColor = "#ccc"
// }

// var user = window.prompt("Enter username:")
// var pass = window.prompt("Enter password:")
// if(pass == "qwerty" && user == "Dmytro"){
// 	alert("! ! ! Це Дмитро ! ! !")
// }
// else if(pass == "123" && user == "Ya"){
// 	alert("! ! ! Це Ти ! ! !")
// }
// else if(pass == "54321" && user == "User1"){
// 	alert("! ! ! Це перший користувач ! ! !")
// }
// else{
// 	document.body.innerHTML = ""
// }

// > ; >= ; < ; <= ; == ; !=

// логічне "і"/"та"/"and"
// false && false = false
// false && true  = false
// true  && false = false
// true  && true  = true
// логічне "або"/"чи"/"or"
// false || false = false
// false || true  = true
// true  || false = true
// true  || true  = true

// int - integer - цілі числа
// float - десяткові дроби
// string - рядок - текст
// bool - boolean - булеві - двійкові - true/false

// Для назв змінних можна використовувати:
// літери англійської абетки; цифри; знак "_"
// Не можна почнати назву з цифри

// " += " : додати
// " -= " : відняти
// " *= " : помножити
// " /= " : розідити

// document.getElementById("text-block").textContent += "TEST TEXT TEST"