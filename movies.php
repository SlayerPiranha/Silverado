<?php
session_start();

$isLocalhost = true;

$sourceUrl = $_SERVER['SERVER_NAME'];
if ($isLocalhost)
{
	$sourceUrl = "titan.csit.rmit.edu.au";
}

$json = file_get_contents("http://" . $sourceUrl . "/~e54061/wp/moviesJSON.php");
$obj = json_decode($json);
?>
<!DOCTYPE html>
<html>
<head>
<title>Silverado Cinema</title>
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/movies.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/movies.js"></script>

</head>
<body>
<?php
$page = 'movies';
include("header.php");

//default text displayed
$title = "Now playing";
$caption = "Available now at all Silverado cinemas.";
$description = "";
$canWatch = true;

if (isset($_GET["id"]))
{
$id = $_GET["id"];
switch ($id)
{
case "AC":
case "CH":
case "AF":
case "RC":
  $title = $obj->{$id}->{'title'};
  $caption = $obj->{$id}->{'summary'};
  $description = $obj->{$id}->{'description'}[0] . $obj->{$id}->{'description'}[1] . $obj->{$id}->{'description'}[2];
  break;
  
default:
  $title = "Oops... can't find this movie.";
  $caption = "Check out other great movies available.";
  $canWatch = false;
  break;
}

$hasLongDescription = strlen($description) > 30;
}
else
{
  //no id exists, impossible to watch
  $canWatch = false;
}
?>

<main class="content-page-center">

<section class="content-overlay-no-center">
<ul class="text-list list-adjust-bottom">
<li class="title-style"><?php echo $title; ?></li>
<li class="caption-style list-item-spacing"><?php echo $caption; ?></li>
<li></li>


<li class="list-item-spacing">
<div class="movie-table">
<?php
if ($canWatch)
{
?>
<table class="movie-panel-large-caption">

<tr>
<td>
<a href="booking.php?id=<?php echo $id; ?>">
<div class="movie-panel-large img-display" id="poster" style="background-image:url('<?php echo $obj->{$id}->{'poster'}; ?>')">
<div class="caption-style" id="rating-panel" style="background-image:url('<?php echo $obj->{$id}->{'rating'}; ?>')"></div>
</div>
</a>
</td>
</tr>

<tr class="movie-description" id="movie-short-description" <?php if ($hasLongDescription) echo "onclick='showFullDescription()'"; ?>>
<td class="movie-caption-style">
<?php
if ($hasLongDescription)
{
  echo substr($description, 0, 30) . "... ";
?>
<label class="description-style">view more</label>
<label id="description1-text">
<?php
}
else
{
  echo $description;
}
?>
</label>
</td>
</tr>

<tr class="movie-description" id="movie-long-description">
<td class="movie-caption-style">
<div class="movie-panel-large img-display">
<iframe src="<?php echo $obj->{$id}->{'trailer'}; ?>" frameborder="0" class="fill-space" id="trailer" allowfullscreen></iframe>
</div>
<label id="description2-text">
<?php
if ($hasLongDescription)
{
  echo $description;
}
?>
</label>
</td>
</tr>

<tr>
<td>
</td>
</tr>

</table>
<?php
}
else
{
  foreach ($obj as $category => $val)
  {
	$posterUrl = $obj->{$category}->{'poster'};
?>
<a href="movies.php?id=<?php echo $category; ?>"><div class="movie-panel-small fill-space img-display" style="background-image:url('<?php echo $posterUrl; ?>')"></div></a>
<?php
  }
}
?>
</div>
</li>

<li>
<?php
if ($canWatch)
{
?>
<nav>
<a href="booking.php?id=<?php echo $id; ?>" class="header-link movie-description-style">Watch&nbsp;this&nbsp;movie&nbsp;></a>
<a href="pricing.php" class="header-link movie-description-style">View&nbsp;pricing&nbsp;></a>
</nav>
<?php
}
?>
</li>
</ul>
</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>