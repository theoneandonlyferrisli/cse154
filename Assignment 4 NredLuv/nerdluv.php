<!--
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
-->
<?php
#This is the homepage of this homework and user can be directed to signup page and 
#matches page.
include("common.php");
start();
?>

		<div>
			<h1>Welcome!</h1>

			<ul>
				<li>
					<a href="signup.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/signup.gif" alt="icon" />
						Sign up for a new account
					</a>
				</li>

				<li>
					<a href="matches.php">
						<img src="https://webster.cs.washington.edu/images/nerdluv/heartbig.gif" alt="icon" />
						Check your matches
					</a>
				</li>
			</ul>
		</div>

<?= tail() ?>
