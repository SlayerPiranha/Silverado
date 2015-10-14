<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Silverado Cinema</title>
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/index.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
</head>
<body>
<?php
$page = 'index';
include("header.php");
?>

<main class="content-page-center">

<section class="fill-sizeof-page stretch-background content-section-center" id="index-background1">
<ul class="content-overlay text-list list-middle index-text-default">
<li class="title-style list-item-spacing">Welcome to the brand new<br>Silverado experience.</li>
<li class="caption-style">We think you'll love it! Scroll down to learn more.</li>
</ul>
</section>

<section class="fill-sizeof-page stretch-background" id="index-background2">
<ul class="content-overlay text-list list-middle index-text-default">
<li class="title-style">Luxurious seating.</li>
<li class="caption-style">Our renovations brought comfort to a whole new level.</li>
</ul>
</section>

<section class="fill-sizeof-page stretch-background" id="index-background3">
<ul class="content-overlay text-list list-middle index-text-default">
<li class="title-style">Realistic 3D.</li>
<li class="caption-style">With all the vivid detail that leaps out at you - seeing is believing.</li>
</ul>
</section>

<section class="fill-sizeof-page stretch-background" id="index-background4">
<ul class="content-overlay text-list list-middle index-text-default">
<li class="title-style">Dolby Cinema.</li>
<li class="caption-style list-item-spacing">Perfected surround sound that brings epic immersion.</li>
<li><a href="http://www.dolby.com/us/en/platforms/dolby-cinema.html" class="header-link description-style">Learn&nbsp;more&nbsp;about Dolby&nbsp;Cinema&nbsp;></a></li>
</li>
</ul>
</section>

</main>

<?php include("footer.php"); ?>
</body>
</html>