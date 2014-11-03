<!DOCTYPE html>
<html>
	<!--
		Name: Dongchang He
		CSE 154
		Section: AI by Daniel Nakamura
		4/23/2014
		Assignment #3

		This file accepts a film parameter and gives the detailed information about that movie.
		This file also accepts a reviews parameter which is the number of reviews this page will display.
	-->
	<!--
		This movie.php and movie.css files have included all extra features mentioned in the spec.
	-->

	<?php
		if (!isset($_GET["film"]) || !is_dir($_GET["film"])) { ?>
			<head>
				<title>Page Not Found</title>
				<link rel="stylesheet" type="text/css" href="movie.css">
			</head>

			<body>
				<h1>Page Not Found (ﾟДﾟ≡ﾟдﾟ)!?</h1>
			</body>
	<?php
		} else {
			#Following codes assign value to global variables.
			$movie = $_GET["film"];                      //Movie name
			$info = file("$movie/info.txt");             //Movie info.txt file content
			$overview = file("$movie/overview.txt");     //Movie overview.txt file content
			$freshornot = "fresh";                       //A string that implies the evaluation
			if ($info[2] < 60) {
				$freshornot = "rotten";                  //When the movie has bad evaluation
			}
			$reviews = glob("$movie/review*.txt");       //An array contains all path to reviews' directory
			$number = count($reviews);                   //Number of reviews
			$seenreview = $number;                       //This implies how many reviews we can see
			if (isset($_GET["reviews"])) {
				$seenreview = $_GET["reviews"];          //This value equals the parameter reviews
			}
			if ($seenreview < 0) {
				$seenreview = 0;                         //If the parameter less equal to 0, we set this valiue to 0
			}
	?>

			<head>
				<title>
					<?= $info[0] ?> - Rancid Tomatoes
				</title>

				<link rel="stylesheet" type="text/css" href="movie.css">
				<meta charset="utf-8" />
				<link href="https://webster.cs.washington.edu/images/<?= $freshornot ?>.gif"
				type="image/gif" rel="shortcut icon" />
				<meta name="description" content="Movie Evaluation">
				<meta name="keywords" content="Moive, Rancid Tomatoes, Movie Review, Movie Overview">
			</head>

			<body>
				<?= banner("up") ?>
				<?= banner("down") ?>

				<h1>
					<?= trim($info[0]) . " (" . trim($info[1]) . ")" ?>
				</h1>

				<div id="content">
					<?= rating($number, $freshornot, $info) ?>

					<div id="right">
						<div>
							<img src="<?= $movie ?>/overview.png" alt="general overview" />
						</div>

						<dl>
							<?php
								foreach ($overview as $elemnet) {
									$intro = explode(":", $elemnet);
							?>
									<dt><?= $intro[0] ?></dt>
									<dd>
										<?= $intro[1] ?>
									</dd>
							<?php
								}
							?>
						</dl>
					</div>

					<div id="left">
						<div id="comments">
							<?= writecolumn(0, round($seenreview / 2), $reviews) ?>
							<?= writecolumn(round($seenreview / 2), $seenreview, $reviews) ?>
						</div>
					</div>

					<p id="page">(<?= page($seenreview) ?>) of <?= $number ?></p>

					<?= rating($seenreview, $freshornot, $info) ?>
				</div>

				<div id="links">
					<a href="https://webster.cs.washington.edu/validate-html.php">
						<img class="validator" src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" />
					</a>
					<br />
					<a href="https://webster.cs.washington.edu/validate-css.php">
						<img class="validator" src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" />
					</a>
				</div>
			</body>
	<?php		
		}
	?>
</html>

<?php
#This function make the fixed banner of the webpage. It accepts a string parameter as this banner's id
#and the id decides the position (up or down) of this banner.
function banner($position) { ?>
	<div id="<?= $position ?>">
		<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
	</div>
<?php }
#This function will make the rating bar which contains the overall rating score and the number of reviews and a picture representing
#if this movie is fresh or rotten. The totalreviews parameter refer to the number of reviews and freshornot represents if it's fresh
#or not. And info is an array which provides the score of this movie.
function rating($totalreviews, $freshornot, $info) {
?>
	<div class="rating">
		<img src="https://webster.cs.washington.edu/images/<?= $freshornot ?>large.png" alt="<?= $freshornot ?>" class="brand" />
		<span class="score"><?= $info[2] ?></span><span class="implement">% (out of <?= $totalreviews ?> reviews)</span>
	</div>
<?php }
#The writecolumn function write two columns in the left section of user's review. It accepts two parameters which implies the starting 
#point and end point of a single column. The third parameter reviews provides the user's review.
function writecolumn($start, $end, $reviews) {
?>
	<div class="columns">
		<?php
			for ($i = $start; $i < $end; $i++) {
				$singlereview = file($reviews[$i])
		?>
				<p class="quote">
					<img src="https://webster.cs.washington.edu/images/<?= strtolower(trim($singlereview[1])) ?>.gif" 
					alt="<?= $singlereview[1] ?>" />
					<q><?= trim($singlereview[0]) ?></q>
				</p>
				<p class="reviewer">
					<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
					<?= $singlereview[2] ?><br />
					<span><?= $singlereview[3] ?></span>
				</p>
		<?php
			}
		?>
	</div>
<?php }
#Function page will give the text of the last green bar which provides the information of how many reviews are shown and
#how many reviews in total.
function page($seenreview) {
	$pagedispay = "";
	if ($seenreview <= 1) {
		$pagedisplay = "$seenreview";
	} else {
		$pagedisplay = "1-$seenreview";
	}
	return $pagedisplay;
}
?>