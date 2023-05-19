$(document).ready(function(){
})

let slides = [".slide1",".slide2",".slide3",".slide4",".slide5",".slide6",".slide7",".slide8",".slide9",".slide10"];
let active = slides[0]

 function slide_next(){
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
 function slide_prev(){
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