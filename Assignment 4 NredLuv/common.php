<!--
CSE 154, Homework 4 (NerdLuv)
This provided file is the front page that links to two of the files
you are going to write, signup.php and matches.php.
You can modify this file as necessary to move redundant code out to common.php.
-->
<!--
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
	
	This file is designed for common function that can be used in other php
	files to reduce redundacy.
-->
<?php
#This is the top part of all hw4's webpages.
function start() { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>NerdLuv</title>
			
			<meta charset="utf-8" />
			
			<!-- instructor-provided CSS and JavaScript links; do not modify -->
			<link href="https://webster.cs.washington.edu/images/nerdluv/heart.gif" type="image/gif" rel="shortcut icon" />
			<link href="https://webster.cs.washington.edu/css/nerdluv.css" type="text/css" rel="stylesheet" />
		</head>

		<body>
			<div id="bannerarea">
				<img src="https://webster.cs.washington.edu/images/nerdluv/nerdluv.png" alt="banner logo" /> <br />
				where meek geeks meet
			</div>
<?php }
#This function is the tail part of all hw4's webpages.
function tail() { ?>
			<div>
				<p>
					This page is for single nerds to meet and date each other!  Type in your personal information and wait for the nerdly luv to begin!  Thank you for using our site.
				</p>
				
				<p>
					Results and page (C) Copyright NerdLuv Inc.
				</p>
				
				<ul>
					<li>
						<a href="nerdluv.php">
							<img src="https://webster.cs.washington.edu/images/nerdluv/back.gif" alt="icon" />
							Back to front page
						</a>
					</li>
				</ul>
			</div>

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</body>
	</html>
<?php } 
#This function is used in signup-submit.php and matches-submit.php. It's used to make a name into lower
#cases and use dashes instead of white space. This form of name is used to name the picture of that user.
function usernaming($username) {
	return strtolower(preg_replace("/\s/", "_", $username));
}
?>