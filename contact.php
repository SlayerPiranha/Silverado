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

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
</head>
<body>
<?php
$page = 'contact';
include("header.php");
?>

<main class="content-page-center">

<section class="content-overlay-no-center">
<form method="post" action="http://titan.csit.rmit.edu.au/~e54061/wp/testcontact.php">
<ul class="text-list list-adjust-bottom">
<li class="title-style">Contact Us</li>
<li class="caption-style list-item-spacing">We're here to help.</li>

<li class="list-item-spacing">
<table class="input-table">

<tr>
<td width="50" class="align-right"><label>Email</label></td>
<td>
<input type="email" class="text-field" name="email" required>
</td>
</tr>

<tr>
<td class="align-right"><label>Subject</label></td>
<td>
<select class="input-field" name="subject">
<option>General Enquiry</option>
<option>Group and Corporate Bookings</option>
<option>Suggestions & Complaints</option>
</select>
</td>
</tr>

<tr>
<td class="align-right"><label>Message</label></td>
<td>
<textarea class="fill-space input-field input-field-large" name="message" required></textarea>
</td>
</tr>

</table>
</li>
<li>
<input type="submit" value="Ask us" class="button">
</li>
</ul>
</form>
</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>