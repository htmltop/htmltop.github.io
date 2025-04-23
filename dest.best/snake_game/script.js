let cell_w = 30;

class Snake_Game{
	constructor(){
		document.addEventListener("keydown", evt => {
			if(!this.direction_changed && (evt.code == "KeyW" || evt.code == "ArrowUp")){
				if (this.snake_direction != "b") {
						this.snake_direction = "t"
						this.direction_changed = true
				}
			}
			else if(!this.direction_changed && (evt.code == "KeyS" || evt.code == "ArrowDown")){
				if (this.snake_direction != "t") {
						this.snake_direction = "b"
						this.direction_changed = true
				}
			}
			else if(!this.direction_changed && (evt.code == "KeyA" || evt.code == "ArrowLeft")){
				if (this.snake_direction != "r") {
						this.snake_direction = "l"
						this.direction_changed = true
				}
			}
			else if(!this.direction_changed && (evt.code == "KeyD" || evt.code == "ArrowRight")){
				if (this.snake_direction != "l") {
						this.snake_direction = "r"
						this.direction_changed = true
				}
			}
		})
		this.playing = false
		this.direction_changed = false
		this.step = 0
		// створюємо масив даних поля:
		this.field = [];
		for (let i = 0; i < 17; i++) {
			let temp_arr = []
			for (let j = 0; j < 17; j++) {
				temp_arr.push(0);
			}
			this.field.push(temp_arr);
		}
		// створюємо властивості для змійки:
		this.snake_direction = "r"
		this.snake_position = [[8, 8], [7, 8], [6, 8]]
		// this.snake_x = 8
		// this.snake_y = 8
		// створюємо інструменти для малювання:
		let canvas = document.getElementById("canvas");
		this.pen = canvas.getContext("2d");
		this.pen.fillStyle = "#8D8";
		this.pen.fillRect(0, 0, 510, 510);
		// просто перевірка:
		// alert("Об'єкт гри створено")
		this.Print()

	}
	Print_field(){
		this.pen.fillStyle = "#8D8";
		this.pen.strokeStyle = "#000";
		for (let i = 0; i < this.field.length; i++) {
			for (let j = 0; j < this.field[i].length; j++) {
				this.pen.fillRect(  j * cell_w, i * cell_w, cell_w, cell_w);
				this.pen.strokeRect(j * cell_w, i * cell_w, cell_w, cell_w);
			}
		}
	}
	Print_snake(){
		this.pen.fillStyle = "#FA4";
		for (var i = 0; i < this.snake_position.length; i++) {
			this.pen.fillRect(
				this.snake_position[i][0] * cell_w,	
				this.snake_position[i][1] * cell_w,	
				cell_w, cell_w			
				);
			this.pen.strokeRect(
				this.snake_position[i][0] * cell_w,	
				this.snake_position[i][1] * cell_w,	
				cell_w, cell_w
				);
			this.pen.fillStyle = "#D82";
		}
	}
	Print_apples(){
		this.pen.fillStyle = "#F00";
		for (var i = 0; i < this.field.length; i++) {
			for (var j = 0; j < this.field[i].length; j++) {
				if(this.field[i][j] == 1){
					this.pen.fillRect(
					j * cell_w,	
					i * cell_w,	
					cell_w, cell_w			
					);
				this.pen.strokeRect(
					j * cell_w,	
					i * cell_w,	
					cell_w, cell_w
					);
				}
			}
		}
	}
	Print(){
		this.Print_field()
		this.Print_snake()
		this.Print_apples()
	}
	Move(){
		let x = this.snake_position[0][0]
		let y =	this.snake_position[0][1]
		if      (this.snake_direction == "r") {x += 1}
		else if (this.snake_direction == "l") {x -= 1}
		else if (this.snake_direction == "t") {y -= 1}
		else if (this.snake_direction == "b") {y += 1}
		let killed = false
		for (var i = 1; i < this.snake_position.length; i++) {
			if(x == this.snake_position[i][0] && y == this.snake_position[i][1]){
				killed = true;
				break
			}
		}
		if(x < 0 || x > 16 || y < 0 || y > 16 || killed){
			alert("Ви програли");
			Start()
			game_1 = new Snake_Game()
			return false
		}
		this.snake_position.unshift([x, y])
		this.snake_position.pop()
		return true	
	}
	Spawn_Apples(){
		if (this.step > 5) {
			this.step = 0
			let x = rand_Int(17);
			let y = rand_Int(17);
			this.field[y][x] = 1
		}
		
	}
	Eat_Apples(){
		let x = this.snake_position[0][0]
		let y =	this.snake_position[0][1]
		if (this.field[y][x] == 1) {
			this.field[y][x] = 0
			let new_el_x = this.snake_position[1][0]
			let new_el_y = this.snake_position[1][1]
			this.snake_position.push([new_el_x, new_el_y])
		}
	}
	Step(){
		this.step += 1;	
		this.Spawn_Apples()
		this.direction_changed = false
		if(!this.Move()) return
		this.Eat_Apples()
		this.Print()
	}
}

let game_1;

$(document).ready(function(){
	game_1 = new Snake_Game();
})

let interval;
function Start(){
	if (game_1.playing == false) {
		game_1.playing = true
		interval = setInterval(function() {
			game_1.Step();
		}, 250)
	}
	else{
		game_1.playing = false;
		clearInterval(interval)
	}
}

function rand_Int(max) {
	let answer = Math.floor(Math.random() * max);
	return answer
}