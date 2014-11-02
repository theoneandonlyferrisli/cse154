<?php
/*
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	5/14/2014
	Assignment #6
*/
//Setting up variables which will be used later.
	include("common.php");
	heading();
	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	$db = new PDO("mysql:dbname=imdb;host=localhost;charset=utf8", "ziming3", "BTKzvpAx6U");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$actor = actor_id($firstname, $lastname, $db);
	$fullname = $firstname . " " . $lastname;
?>
<!-- The main part of this page which displays the table of the movies which this actor has
    been in -->
<div id="main">
	<h1>Results for <?= $fullname ?></h1>
<?php
	if ($actor == null) {
?>
		<p>Actor <?= $fullname ?> not found</p>
<?php
	} else {
		$id = $db->quote($actor);
		$rows = $db->query("SELECT name, year FROM movies m JOIN roles r ON m.id = r.movie_id JOIN actors a ON a.id = r.actor_id WHERE a.id = $id ORDER BY m.year DESC, m.name");
		make_table($rows, "All Films");
	}
	tail();
?>