<!--
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
-->
<?php
#Setting up pages according to the parameters posted by signup.php.
include("common.php");
$name = $_POST["name"];
$gender = $_POST["gender"] . ",";
$age = $_POST["age"] . ",";
$type = $_POST["type"] . ",";
$os = $_POST["os"] . ",";
$min = $_POST["minage"] . ",";
$max = $_POST["maxage"] . ",";
$sexuality = "";
foreach ($_POST['sexuality'] as $prefer) {
	$sexuality .= $prefer;
}
#Uoploads the new user's photo.
if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
	move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . usernaming($name) . ".jpg");
}
chmod("images/" . usernaming($name) . ".jpg", 0777);

start();
#Edit the singles2.txt file to add new user's information.
$info = $name . "," . $gender . $age . $type . $os . $min . $max . $sexuality . "\n";
file_put_contents("singles2.txt", $info, FILE_APPEND);
?>

		<p>Welcome to NredLuv, <?= $name ?>!</p>
		<p>Now <a href="matches.php">log in to see your matches!</a></p>

<?= tail() ?>