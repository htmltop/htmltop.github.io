let word = "СЛОВО"
if(confirm("Бажаєте ввести своє слово?")){
	word = prompt("Введіть бажане слово:");
}
else{
	let arr = ["УКРАЇНА", "КАЛИНА", "ЯБЛУКО", "ГОТЕЛЬ", "ГАНТЕЛІ"];
	let number = parseInt(Math.random() * arr.length);
	word = arr[number];
}

alert(word[0])
let img_list = ["shyb0.jpg","shyb1.jpg","shyb2.jpg","shyb3.jpg","shyb4.jpg","shyb5.jpg","shyb6.jpg","shyb7.jpg","shyb8.jpg","shyb9.jpg","shyb10.jpg"];

document.getElementById("image").innerHTML = "<img src=\"img/"+ img_list[0] + "\">"

let mistakes = 0
let index = 1
let guessed = word[0]
function Next(){
	char = prompt("Початок слова: " + guessed + ". Введіть наступну літеру:")
	if(char == word[index]){
		guessed += word[index]
		index++;
		alert("Правильно")
	}
	else{
		mistakes++;
		document.getElementById("image").innerHTML = "<img src=\"img/" + img_list[mistakes] + "\">"
		alert("Неправильно. Помилок: " + mistakes)
	}
	if(index >= word.length){
		alert("Ви перемогли!")
		// break;
	}
	if(mistakes >= 10){
		alert("Ви програли...")
		mistakes = 0;
		guessed = word[0];
		document.getElementById("image").innerHTML = "<img src=\"img/" + img_list[mistakes] + "\">"
		// break;
	}
}

// for (let i = 0; i < word.length; i++) {
// 	char = prompt("Введіть літеру:");
// 	word[i];
// 	if(mistakes < 10){
		
// 	}
// }