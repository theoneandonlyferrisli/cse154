<?php
/*
	Name: Dongchang He
	CSE 154
	Section: AI by Daniel Nakamura
	5/8/2014
	Assignment #5

	My version of homework includes all the extra features.
*/
#User will log out through this page. All the session variables will be deleted.
session_start();
session_destroy();
session_regenerate_id();
header("Location: start.php");
?>