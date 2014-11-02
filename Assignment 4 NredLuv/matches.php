<!--
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
-->
<?php
#This webpage let user input their name and direct them into matches-submit page
#to display their matches.
include("common.php");
start();
?>
		<form action="matches-submit.php" method="GET">
			<fieldset>
				<legend>Returning User:</legend>
				<div>
					<strong>Name:</strong>
					<input type="text" size="16" name="name" />
				</div>
				<div>
					<input type="submit" value="View My Matches" />
				</div>
			</fieldset>
		</form>

<?= tail() ?>