$(document).ready(function(){
})

let slides = [".slide1",".slide2",".slide3"];
let active = slides[0]

 function block1_slide_next(){
 	for (var i = 0; i < slides.length; i++) {
 		if (slides[i] == active) {
 			$(slides[i]).toggleClass("active")
 			if(i + 1 == slides.length){
 				$(slides[0]).toggleClass("active")
 				active = slides[0]
 			}
 			else{
 				$(slides[i + 1]).toggleClass("active")
 				active = slides[i + 1]
 			}
 			break
 		}
 	}
 }
 function block1_slide_prev(){
 	for (var i = 0; i < slides.length; i++) {
 		if (slides[i] == active) {
 			$(slides[i]).toggleClass("active")
 			if(i == 0){
 				$(slides[slides.length - 1]).toggleClass("active")
 				active = slides[slides.length - 1]
 			}
 			else{
 				$(slides[i - 1]).toggleClass("active")
 				active = slides[i - 1]
 			}
 			break
 		}
 	}
 }