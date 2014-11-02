<!--
	Name: Ziming Guo
	CSE 154
	Section: AI by Daniel Nakamura
	4/30/2014
	Assignment #4

	My version of homework includes the extra feature #2 and #3.
-->
<?php
#This page let user to provide their information so that their data will be stored
#into the singles.txt. After providing information, users will be directed to 
#signup-submit.php.
include("common.php");
start();
?>
		<form action="signup-submit.php" method="POST" enctype="multipart/form-data">
			<fieldset>
				<legend>New User Signup:</legend>
				<div>
					<strong>Name:</strong>
					<input type="text" size="16" name="name" />
				</div>

				<div>
					<strong>Gender:</strong>
					<label><input type="radio" name="gender" value="M" /> Male</label>
					<label><input type="radio" name="gender" value="F" /> Female</label>
				</div>

				<div>
					<strong>Age:</strong>
					<input type="text" size="6" maxlength="2" name="age" />
				</div>

				<div>
					<strong>Personality type:</strong>
					<input type="text" size="6" maxlength="4" name="type" />
					(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
				</div>

				<div>
					<strong>Favorite OS:</strong>
					<select name="os">
						<option selected="selected">Windows</option>
						<option>Mac OS X</option>
						<option>Linux</option>
					</select>
				</div>

				<div>
					<strong>Seek Gender(s):</strong>
					<label><input type="checkbox" name="sexuality[]" value="M" checked="checked" /> Male</label>
					<label><input type="checkbox" name="sexuality[]" value="F" /> Female</label>
				</div>

				<div>
					<strong>Seeking age:</strong>
					<input type="text" size="6" maxlength="2" name="minage" />to<input type="text" size="6" maxlength="2" name="maxage" />
				</div>

				<div>
					<strong>Photo:</strong>
					<input type="file" name="photo">
				</div>

				<div>
					<input type="submit" value="Sign Up" />
				</div>
			</fieldset>
		</form>

<?= tail() ?>