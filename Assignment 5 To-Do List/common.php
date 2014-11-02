<?php
/*
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	5/8/2014
	Assignment #5

	My version of homework includes all the extra features.
*/
#Depict the head part of start.php and todolist.php
function head() { ?>	
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Remember the Cow</title>
			<link rel="stylesheet" type="text/css" href="https://webster.cs.washington.edu/css/cow-provided.css">
			<link rel="stylesheet" type="text/css" href="cow.css">
			<link rel="shortcut icon" type="image/ico" href="https://webster.cs.washington.edu/images/todolist/favicon.ico">
		</head>
		<body>
			<div class="headfoot">
				<h1>
					<img alt="logo" src="https://webster.cs.washington.edu/images/todolist/logo.gif">
					Remember
					<br>
					the Cow
				</h1>
			</div>
<?php		
}
#Depict the head tail of start.php and todolist.php
function tail() {
?>
			<div class="headfoot">
				<p>
					"Remember The Cow is nice, but it's a total copy of another site." - PCWorld
					<br>
					All pages and content © Copyright CowPie Inc.
				</p>
				<div id="w3c">
					<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
					<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
				</div>
			</div>
		</body>
	</html>
<?php
}
#Display the error message of present error in the page.
function error_message() {
	if (isset($_SESSION["error"])) {
?>
		<p id="error">
			<?= $_SESSION["error"] ?>
		</p>
<?php
		unset($_SESSION["error"]);
	}
}
#Direct the error message in the certain webpage which is 
#the location parameter passed in.
function send_error($message, $location) {
	$_SESSION["error"] = $message;
	header("Location: $location");
	die();
}
#Test whether it has name or password session. If do, automatically
#direct to todolist.php
function loggedindirection() {
	if (isset($_SESSION["name"]) || isset($_SESSION["password"])) {
		header("Location: todolist.php");
		die();
	}
}
#Test whether it has name or password session. If do not, automatically
#direct to start.php
function unloggedindirection() {
	if (!isset($_SESSION["name"]) || !isset($_SESSION["password"])) {
		header("Location: start.php");
		die();
	}
}
?>