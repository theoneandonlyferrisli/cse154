<!--
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	5/8/2014
	Assignment #5

	My version of homework includes all the extra features.
-->
<?php
include("common.php");
head();
session_start();
unloggedindirection();
$name = $_SESSION["name"];
$password = $_SESSION["password"];

?>

		<h2><?= $name ?>'s To-Do List</h2>

		<ul id="todolist">
			<?php
				error_message();
				if (file_exists("todo-$name.txt")) {
					$content = file("todo-$name.txt", FILE_IGNORE_NEW_LINES);
					for ($i=0; $i<count($content); $i++) { ?>
						<li>
							<form method="post" action="submit.php">
								<input type="hidden" value="delete" name="action">
								<input type="hidden" value=<?= $i ?> name="index">
								<input type="submit" value="Delete">
							</form>
							<?= $content[$i] ?>
						</li>
				<?php
					}		
				}
			?>
			<li>
				<form method="post" action="submit.php">
					<input type="hidden" value="add" name="action">
					<input type="text" autofocus="autofocus" size="25" name="item">
					<input type="submit" value="Add">
				</form>
			</li>
		</ul>

		<div>
			<a href="logout.php">
			<strong>Log Out</strong>
			</a>
			<em>(logged in since <?=$_COOKIE["time"]?>)</em>
		</div>
<?php
tail();
?>