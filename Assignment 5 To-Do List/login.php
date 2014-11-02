<?php
/*
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	5/8/2014
	Assignment #5

	My version of homework includes all the extra features.
*/
session_start();
include("common.php");

loggedindirection();

$name = $_POST["name"];
$password = $_POST["password"];
#Test to avoid nothing passing in.
if ($name == "" || $password == "") {
	send_error("Please Fill the Information to Regist", "start.php");
}
#Test to avoid password containing username in it.
if (preg_match("/$name/", $password)) {
	send_error("Password cannot contain username", "start.php");
}
#Iterate through users.txt to put all the contents into an array.
$database = array();
$content = file("users.txt", FILE_IGNORE_NEW_LINES);
foreach ($content as $match) {
	$userinfo = explode(":", $match);
	$database[$userinfo[0]] = $userinfo[1];
}
#Test if the username or password is the required form.
if (!array_key_exists($name, $database)) {
	$namecheck = preg_match("/^[a-z][a-z0-9]{2,7}$/", $name);
	$passwordcheck = preg_match("/^\d.*\W$/", $password);
	if ($namecheck && $passwordcheck) {
		file_put_contents("users.txt", $name . ":" . $password . "\n" , FILE_APPEND);
		$database[$name] = $password;
	} else if (!$namecheck) {
		send_error("Invalid Username Form", "start.php");
	} else {
		send_error("Invalid Password Form", "start.php");
	}
}
#Test whether the password is correct.
if ($password == $database[$name]) {
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $password;
	date_default_timezone_set("America/Los_Angeles");
	setcookie("time", date("D y M d, g:i:s a"), time()+ 7 * 24 * 3600);
	header("Location: todolist.php");
} else {
	send_error("Password Incorrect", "start.php");
}
?>