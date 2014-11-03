/*
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	5/21/2014
	Assignment #7

	This is the JavaScript file of ASCII project.
*/
"use strict";

var frames;     // The array contains all frames
var interval;   // The time interval of each frame
var size;       // Font size in the text area
var nth;		// N-th key in the array "frames"
var timer;      // The timer object which repeat certain function

(function() {
	// Onload function which will be loaded automatically.
	window.onload = function() {
		// Setting up the variables.
		var start = document.getElementById("start");
		var stop = document.getElementById("stop");
		stop.disabled = true;
		setAnimation();
		setSize();
		var intervals = document.getElementsByName("speed");
		for (var i = 0; i < intervals.length; i++) {
			if (intervals[i].checked) {
				interval = intervals[i].value;
			}
		}

		// Apply changes when user select different value of each property.
		for (var i = 0; i < intervals.length; i++) {
			intervals[i].onchange = function () {
				interval = this.value;
				if (timer) {
					clearInterval(timer);
					timer = null;
					timer = setInterval(flash, interval);
				}
			};
		}
		document.getElementById("animation").onchange = halt;
		document.getElementById("size").onchange = setSize;
		start.onclick = begin;
		stop.onclick = halt;
	};

	// Set up the animation according to the Animation selector
	function setAnimation() {
		var action = document.getElementById("animation").value;
		document.getElementById("text").value = ANIMATIONS[action];
	}

	// Set up the size according to the size selector.
	function setSize() {
		size = document.getElementById("size").value;
		document.getElementById("text").style.fontSize = size + "pt";
	}

	// Start playing the animation
	function begin() {
		frames = document.getElementById("text").value.split("=====\n");
		document.getElementById("stop").disabled = false;
		this.disabled = true;
		nth = 0;
		timer = setInterval(flash, interval);
	}

	// Stop playing the animation.
	function halt() {
		document.getElementById("stop").disabled = true;
		document.getElementById("start").disabled = false;
		clearInterval(timer);
		timer = null;
		setAnimation();
	}

	// Project each frame in the textarea.
	function flash() {
		var frame = frames[nth];
		if (nth < frames.length - 1) {
			nth += 1;
		} else {
			nth = 0;
		}
		document.getElementById("text").value = frame;
	}

}) ();