<?php
session_start();

$hasScreenings = false;

if (isset($_SESSION["cart"]) &&
	isset($_SESSION["cart"]["screenings"]))
{	
	$existingScreenings = $_SESSION["cart"]["screenings"];
	$numScreenings = count($existingScreenings);
	if ($numScreenings > 0)
	{
		$hasScreenings = true;
	}
}

$isEdit = isset($_GET["edit"]);
if ($hasScreenings &&
	$isEdit)
{
	$editIndex = $_GET["edit"];
	if ($editIndex >= $numScreenings)
	{
		$isEdit = false;
	}
}

if ($hasScreenings &&
	$isEdit)
{
	$existingScreening = $existingScreenings[$editIndex];
	
	$movie = $existingScreening["movie"];
	$title = "";
	switch ($movie)
	{
		case "AF":
			$title = "Girlhood";
			break;
			
		case "CH":
			$title = "Inside Out";
			break;
			
		case "RC":
			$title = "Train Wreck";
			break;
			
		case "AC":
			$title = "Mission Imposible: Rogue Nation";
			break;
	}
	$day = $existingScreening["day"];
	$time = $existingScreening["time"];
	
	$SA = 0;
	$SP = 0;
	$SC = 0;
	$FA = 0;
	$FC = 0;
	$B1 = 0;
	$B2 = 0;
	$B3 = 0;
	
	if (isset($existingScreening["seats"]["SA"]))
	{
		$SA = $existingScreening["seats"]["SA"]["quantity"];
	}
	if (isset($existingScreening["seats"]["SP"]))
	{
		$SP = $existingScreening["seats"]["SP"]["quantity"];
	}
	if (isset($existingScreening["seats"]["SC"]))
	{
		$SC = $existingScreening["seats"]["SC"]["quantity"];
	}
	if (isset($existingScreening["seats"]["FA"]))
	{
		$FA = $existingScreening["seats"]["FA"]["quantity"];
	}
	if (isset($existingScreening["seats"]["FC"]))
	{
		$FC = $existingScreening["seats"]["FC"]["quantity"];
	}
	if (isset($existingScreening["seats"]["B1"]))
	{
		$B1 = $existingScreening["seats"]["B1"]["quantity"];
	}
	if (isset($existingScreening["seats"]["B2"]))
	{
		$B2 = $existingScreening["seats"]["B2"]["quantity"];
	}
	if (isset($existingScreening["seats"]["B3"]))
	{
		$B3 = $existingScreening["seats"]["B3"]["quantity"];
	}
}
else
{
	$SA = 0;
	$SP = 0;
	$SC = 0;
	$FA = 0;
	$FC = 0;
	$B1 = 0;
	$B2 = 0;
	$B3 = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Silverado Cinema</title>
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/booking.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/calc.js"></script>
<script src="scripts/booking.js"></script>
</head>
<body>
<?php
$page = 'booking';
include("header.php");
?>


<main class="content-overlay-no-center">

<section class="content-overlay">
<form method="post" action="processBooking.php">
<ul class="text-list list-adjust-bottom">
<li class="title-style">Bookings</li>
<li class="caption-style list-item-spacing">
<?php
if ($isEdit)
{
?>
Let's make some changes.
<?php
}
else
{
?>
Purchase online. Avoid disappointments.
<?php
}
?>

</li>

<li class="list-item-spacing">
<table class="input-table">

<tr>
<td width="100" class="align-right"><label>Watch</label></td>
<td colspan="2">
<?php
if ($isEdit)
{
?>
<label><?php echo $title; ?><input type="hidden" name="movie" value="<?php echo $movie; ?>"></label>
<?php
}
else
{
?>
<select class="booking-option input-field" id="movie" name="movie">
<?php
if (isset($_GET["id"]))
{
$id = $_GET["id"];

switch ($id)
{
case "AC":
case "CH":
case "AF":
case "RC":
{
?>
<option value="AC" <?php if ($id == "AC") echo "selected='true'"; ?>>Mission Impossible: Rogue Nation</option>
<option value="CH" <?php if ($id == "CH") echo "selected='true'"; ?>>Inside Out</option>
<option value="AF" <?php if ($id == "AF") echo "selected='true'"; ?>>Girlhood</option>
<option value="RC" <?php if ($id == "RC") echo "selected='true'"; ?>>Train Wreck</option>
<?php
break;
}
default:
header("location:movies.php?id=" . $id);
die();
break;
}
}
else
{
?>
<option value="AC">Mission Imposible: Rogue Nation</option>
<option value="CH">Inside Out</option>
<option value="AF">Girlhood</option>
<option value="RC">Train Wreck</option>
<?php
}
?>
</select>
<?php
}
?>
</td>
</tr>

<tr>
<td class="align-right"><label>on</label></td>
<td colspan="2">
<?php
if ($isEdit)
{
?>
<label><?php echo $day; ?><input type="hidden" name="day" value="<?php echo $day; ?>"></label>
<?php
}
else
{
?>
<select class="booking-option input-field" id="day" name="day">
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>
</select>
<?php
}
?>
</td>
</tr>

<tr>
<td class="align-right"><label>at</label></td>
<td colspan="2">
<?php
if ($isEdit)
{
?>
<label><?php echo $time; ?><input type="hidden" name="time" value="<?php echo $time; ?>"></label>
<?php
}
else
{
?>
<select class="booking-option input-field" id="time" name="time">
<option value="12pm">12pm</option>
<option value="1pm">1pm</option>
<option value="3pm">3pm</option>
<option value="6pm">6pm</option>
<option value="9pm">9pm</option>
</select>
<?php
}
?>
</td>
</tr>

<tr height="50px"><!-- spacer --></tr>

<tr class="select-tab-header">
<td class="align-center" colspan="3"><label class="caption-style">Select your tickets</label></td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.ticket-row-standard')">
<td class="align-center" colspan="3"><label class="description-style">Standard</label></td>
</tr>

</tr>
<tr class="select-tab-mini ticket-row-standard">
<td></td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>

<tr class="ticket-row-standard">
<td class="align-right"><label>Adult</label></td>
<td>
<input type="number" min="0" id="SA" name="SA" value="<?php echo $SA; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="SA-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="ticket-row-standard">
<td class="align-right"><label>Concession</label></td>
<td>
<input type="number" min="0" id="SP" name="SP" value="<?php echo $SP; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="SP-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="ticket-row-standard">
<td class="align-right"><label>Child</label></td>
<td>
<input type="number" min="0" id="SC" name="SC" value="<?php echo $SC; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="SC-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.ticket-row-firstclass')">
<td class="align-center" colspan="3"><label class="description-style">First Class</label></td>
</tr>

<tr class="select-tab-mini ticket-row-firstclass">
<td></td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>

<tr class="ticket-row-firstclass">
<td class="align-right"><label>Adult</label></td>
<td>
<input type="number" min="0" id="FA" name="FA" value="<?php echo $FA; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="FA-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="ticket-row-firstclass">
<td class="align-right"><label>Child</label></td>
<td>
<input type="number" min="0" id="FC" name="FC" value="<?php echo $FC; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="FC-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.ticket-row-beanbag')">
<td class="align-center" colspan="3"><label class="description-style">Beanbag</label></td>
</tr>

<tr class="select-tab-mini ticket-row-beanbag">
<td></td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>

<tr class="ticket-row-beanbag">
<td class="align-right"><label>2 Adults</label></td>
<td>
<input type="number" min="0" id="B1" name="B1" value="<?php echo $B1; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="B1-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="ticket-row-beanbag">
<td class="align-right"><label>Adult + Child</label></td>
<td>
<input type="number" min="0" id="B2" name="B2" value="<?php echo $B2; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="B2-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr class="ticket-row-beanbag">
<td class="align-right"><label>3 Children</label></td>
<td>
<input type="number" min="0" id="B3" name="B3" value="<?php echo $B3; ?>" class="booking-option input-field align-center" required>
</td>
<td>
<input type="text" id="B3-price" value="$0.00" class="price-display" disabled>
</td>
</tr>

<tr id="row-total-payable">
<td class="align-right" colspan="2"><label>Total</label></td>
<td>
<input type="text" id="total-price" value="$0.00" class="price-display" disabled>

<input type="hidden" id="price" name="price" value="0">
</td>
</tr>

</table>

</li>
<li>
<?php
if ($isEdit)
{
?>
<input type="submit" value="Save changes" class="button" id="book_button" disabled>
<?php
}
else
{
?>
<input type="submit" value="Add to cart" class="button" id="book_button" disabled>
<?php
}
?>
</li>
</ul>
</form>

</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>