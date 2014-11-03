<?php
/*
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	5/8/2014
	Assignment #5

	My version of homework includes all the extra features.
*/
#Setting up page.
session_start();
include("common.php");
unloggedindirection();
$name = $_SESSION["name"];
#Delete item listed.
if ($_POST["action"] == "delete") {
	$content = file("todo-$name.txt");
	$index = $_POST["index"];
	if (!preg_match("/\d/", '$index' || $content[$index] == null)) {
		send_error("Invalid operation", "todolist.php");
	}
	$content[$index] = "";
	file_put_contents("todo-$name.txt", $content);
#Add item passed in as item.
} else if ($_POST["action"] == "add") {
	$item = $_POST["item"];
	if (preg_match("/^\s$/", subject)) {
		send_error("You must write something down!", "todolist.php");
	}
	$item = htmlspecialchars($item, ENT_QUOTES);
	file_put_contents("todo-$name.txt", $item . "\n", FILE_APPEND);
#Send error message back to todolist.php
} else {
	send_error("Invalid operation", "todolist.php");
}
#Back to todolist after completing required operations.
header("Location: todolist.php");
?>