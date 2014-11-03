<!--
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
-->
<?php
#Setting up the variables.
#This page is to display all the matches of the name passed in.
include("common.php");
start();
$name = $_GET["name"];
$database = file("singles2.txt", FILE_IGNORE_NEW_LINES);
$info = array();
foreach ($database as $target) {
	$personinfo = explode(",", $target);
	if ($personinfo[0] == $name) {
		$info = $personinfo;
	}
} ?>

		<h1>Matches for <?= $name ?></h1>
<?php
#Iterate the singles2.txt and check which one match the name we pass in. 
foreach ($database as $person) {
	$personinfo = explode(",", $person);
	$gender = gender($info, $personinfo);
	$age = age($info, $personinfo);
	$type = preg_match("/[$info[3]]/", $personinfo[3]);
	$os = $personinfo[4] == $info[4];
	$match = $gender && $age && $type && $os && ($personinfo[0] != $info[0]);
	if ($match) { ?>
		<div class="match">
			<p><img src=<?= imageurl($personinfo[0]) ?> alt="user image" /><?= $personinfo[0] ?></p>
			<ul>
				<li><strong>gender:</strong><?= $personinfo[1] ?></li>
				<li><strong>age:</strong><?= $personinfo[2] ?></li>
				<li><strong>type:</strong><?= $personinfo[3] ?></li>
				<li><strong>os:</strong><?= $personinfo[4] ?></li>
			</ul>
		</div>
<?php
	}
}
#Return true if the two people's genders match the other's sexuality.
function gender($person1, $person2) {
	$firstok = false;
	$secondok = false;
	if ($person1[7] == "MF" || $person2[1] == $person1[7]) {
		$firstok = true;
	}
	if ($person2[7] == "MF" || $person1[1] == $person2[7]) {
		$secondok = true;
	}
	return ($firstok && $secondok);
}
#Return true if two people's age are within the other's request.
function age($person1, $person2) {
	$firstok = false;
	$secondok = false;
	if ($person1[2] >= $person2[5] && $person1[2] <= $person2[6]) {
		$firstok = true;
	}
	if ($person2[2] >= $person1[5] && $person2[2] <= $person1[6]) {
		$secondok = true;
	}
	return $firstok && $secondok;
}
#Test which directory/url should the user picture directed to.
function imageurl($givenname) {
	$username = usernaming($givenname);
	if (file_exists("images/{$username}.jpg")) {
		return "images/{$username}.jpg";
	} else {
		return "https://webster.cs.washington.edu/images/nerdluv/{$username}.jpg";
	}
}

tail();
?>