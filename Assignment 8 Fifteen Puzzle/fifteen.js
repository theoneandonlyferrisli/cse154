/*
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	5/27/2014
	Assignment #8

	This is the JavaScript file of fifteen puzzle project.
*/
"use strict";

(function() {
	var emptySquareRow; // Keep track of empty square's row
	var emptySquareCol; // Keep track of empty square's column

	// Onload function which will be loaded automatically.
	window.onload = function() {
		emptySquareCol = 4;
		emptySquareRow = 4;
		var winAlert = document.createElement("p");
		winAlert.id = "gameWon";
		document.getElementById("controls").appendChild(winAlert);
		for (var i = 0; i < 15; i++) {
			createTile(Math.floor(i / 4) + 1, i % 4 + 1, i + 1, null);
		}

		checkMovable();
		var shuffle = document.getElementById("shufflebutton");
		shuffle.onclick = shuffleTiles;
	};

	// Move the tile passed in to the empty square and make relevant changes
	function move(tile) {
		var win = document.getElementById("gameWon");
		win.innerHTML = "";
		createTile(emptySquareRow, emptySquareCol, tile.innerHTML, tile.style.backgroundPosition);
		emptySquareRow = getRow(tile);
		emptySquareCol = getCol(tile);
		tile.classList.remove("tiles");
		tile.parentNode.removeChild(tile);
		checkMovable();
		if (isSolved()) {
			win.innerHTML = "Congratulations! You Win!";
		}
	}

	// Test if the tile passed in can move which means if it's adjacent to empty
	// square
	function canMove(tile) {
		var thisRow = getRow(tile);
		var thisCol = getCol(tile);
		if (thisRow == emptySquareRow) {
			return ((thisCol == emptySquareCol - 1) || (thisCol == emptySquareCol + 1));
		} else if (thisCol == emptySquareCol) {
			return ((thisRow == emptySquareRow - 1) || (thisRow == emptySquareRow + 1));
		} else {
			return false;
		}
	}

	// Get the tile according to the row and col passed in
	function getTile(row, col) {
		var idString = "square_" + row + "_" + col;
		return document.getElementById(idString);
	}

	// Give the tile a class to highlight when mouse is over it
	function tileMouseOver() {
		this.classList.add("highlight");
	}

	// Cancel the hightlight when mouse is out
	function tileMouseOut() {
		this.classList.remove("highlight");
	}

	// Create a tile
	function createTile(row, col, inner, background) {
		var tile = document.createElement("div");
		tile.className = "tiles";
		var toppos = (row - 1) * 100;
		var leftpos = (col - 1) * 100;
		tile.style.left = leftpos + "px";
		tile.style.top = toppos + "px";
		if (background !== null) {
			tile.style.backgroundPosition = background;
		} else {
			tile.style.backgroundPosition = -1 * leftpos + "px" + " " + -1 * toppos + "px";
		}
		tile.innerHTML = inner;
		var idString = "square_" + row + "_" + col;
		tile.id = idString;
		document.getElementById("puzzlearea").appendChild(tile);
	}

	// Get the tile's row
	function getRow(tile) {
		return parseInt(tile.style.top) / 100 + 1;
	}

	// Get the tile's column
	function getCol(tile) {
		return parseInt(tile.style.left) / 100 + 1;
	}

	// The procedure to check all the tiles which of them is movable
	function checkMovable() {
		var tiles = document.querySelectorAll(".tiles");
		for (var i = 0; i < tiles.length; i++) {
			if (canMove(tiles[i])) {
				tiles[i].onmouseover = tileMouseOver;
				tiles[i].onmouseout = tileMouseOut;
				tiles[i].onclick = function() {
					move(this);
				};
			} else {
				tiles[i].onmouseover = null;
				tiles[i].onclick = null;
			}
		}
	}

	// Shuffle the tiles 1000 times so it is randomly distributed
	function shuffleTiles() {
		for (var i = 0; i < 1000; i++) {
			var neighbors = [];
			var tiles = document.querySelectorAll(".tiles");
			var up = getTile(emptySquareRow - 1, emptySquareCol);
			checkOk(neighbors, up);
			var down = getTile(emptySquareRow + 1, emptySquareCol);
			checkOk(neighbors, down);
			var left = getTile(emptySquareRow, emptySquareCol - 1);
			checkOk(neighbors, left);
			var right = getTile(emptySquareRow, emptySquareCol + 1);
			checkOk(neighbors, right);
			move(neighbors[parseInt(Math.random() * neighbors.length)]);
		}
	}

	// Check if the tile is a neighbor of the empty square. If it is, the 
	// array neighbors will add it in. This is used in shuffleTiles.
	function checkOk(neighbors, tile) {
		if (tile !== null) {
			neighbors.push(tile);
		}
	}

	// Check if the puzzle is solved
	function isSolved() {
		var solved = true;
		for (var i = 0; i < 15; i++) {
			var thisTile = getTile(Math.floor(i / 4) + 1, i % 4 + 1);
			if (thisTile === null) {
				return false;
			}
			var equal = parseInt(thisTile.innerHTML) == i + 1;
			solved = solved && equal;
			if (!solved) {
				return false;
			}
		}
		return solved;
	}
}) ();