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
<link rel="stylesheet" type="text/css" href="css/booking.css">
<link rel="stylesheet" type="text/css" href="css/movies.css">
<link rel="stylesheet" type="text/css" href="css/cart.css">
<link rel="stylesheet" type="text/css" href="css/checkout.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/calc.js"></script>
<script src="scripts/cart.js"></script>
<?php

if (isset($_SESSION["cart"]["voucher"]))
{
	$inputVoucher = $_SESSION["cart"]["voucher"];
}


$hasDiscount = false;

//perform regex
$regexFormat = "/^[0-9]{5}\-[0-9]{5}\-[A-Z]{2}$/";
if (preg_match($regexFormat, $inputVoucher))
{
	if (strlen($inputVoucher) == 14)
	{
		$num1 = $inputVoucher[0];
		$num2 = $inputVoucher[1];
		$num3 = $inputVoucher[2];
		$num4 = $inputVoucher[3];
		$num5 = $inputVoucher[4];
		
		$num6 = $inputVoucher[6];
		$num7 = $inputVoucher[7];
		$num8 = $inputVoucher[8];
		$num9 = $inputVoucher[9];
		$num10 = $inputVoucher[10];
		
		$letterOffset = ord('A');
		$chkSum1 = ord($inputVoucher[12]) - $letterOffset;
		$chkSum2 = ord($inputVoucher[13]) - $letterOffset;
		
		$calcSum1 = (($num1 * $num2 + $num3) * $num4 + $num5) % 26;
		$calcSum2 = (($num6 * $num7 + $num8) * $num9 + $num10) % 26;
		
		if ($calcSum1 == $chkSum1 &&
			$calcSum2 == $chkSum2)
		{
			$hasDiscount = true;
		}
	}
}


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

if ($hasScreenings)
{
	$name = htmlspecialchars($_POST["name"]);
	
	$_SESSION["name"] = $name;
	
?>
<script>
function toggleStub()
{
	//only hide rows if JS is enabled, otherwise it's hidden for non-JS users
<?php
for ($i = 0; $i < $numScreenings; $i++)
{
?>
	toggleRow(".seating-<?php echo $i; ?>");
<?php
}
?>
}
</script>
<?php
}
?>
</head>
<body>
<?php
$page = 'cart';
include("header.php");
?>


<main class="content-overlay-no-center">

<section class="content-overlay">
<ul class="text-list list-adjust-bottom">
<li class="title-style">Complete</li>
<li class="caption-style list-item-spacing">
<?php
if ($hasScreenings)
{
?>
Your purchase was successful!
<?php
}
?>

</li>

<li class="list-item-spacing">
<?php
if ($hasScreenings)
{
	for ($i = 0; $i < $numScreenings; $i++)
	{
		$existingScreening = $existingScreenings[$i];
		
		$movie = $existingScreening["movie"];
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
				$title = "Mission Impossible: Rogue Nation";
				break;
		}
		$day = $existingScreening["day"];
		$time = $existingScreening["time"];
		
		$seats = $existingScreening["seats"];
?>
<table class="input-table">

<tr class="select-tab-header-mini">
<td class="align-left" colspan="3">
<img src="images/Silverado_Logo.png" id="logo-img">
</td>
</tr>

<tr class="select-tab-mini">
<td class="align-left" colspan="3">

<p><label class="checkout-caption-style">SILVERADO CINEMAS</label>
<br><label class="checkout-text-style"><?php echo $title; ?></label>

<p><label class="checkout-caption-style">SHOWTIME</label>
<br><label class="checkout-text-style"><?php echo $day . ", " . $time; ?></label>
</td>
</tr>

<?php
foreach ($seats as $seatId => $seatData)
{
	$ticketType = "";
	
	switch ($seatId)
	{
		case "SA":
			$seatName = "Adult";
			$ticketType = "Standard";
			break;
			
		case "SP":
			$seatName = "Concession";
			$ticketType = "Standard";
			break;
			
		case "SC":
			$seatName = "Child";
			$ticketType = "Standard";
			break;
			
		case "FA":
			$seatName = "Adult";
			$ticketType = "First Class";
			break;
			
		case "FC":
			$seatName = "Concession";
			$ticketType = "First Class";
			break;
			
		case "B1":
			$seatName = "Adults";
			$ticketType = "Beanbag";
			break;
			
		case "B2":
			$seatName = "Adult&nbsp;+&nbsp;Child";
			$ticketType = "Beanbag";
			break;
		
		case "B3":
			$seatName = "3&nbsp;Children";
			$ticketType = "Beanbag";
			break;
	}
	
	$ticketPrice = $seatData["price"];
	$ticketQuantity = $seatData["quantity"];
?>
<tr class="select-tab-mini noselect">
<td class="align-left">
<label class="checkout-caption-style">QUANTITY</label>
<br><label class="checkout-text-style"><?php echo $ticketQuantity; ?></label>
</td>
<td class="align-left">
<label class="checkout-caption-style">TYPE</label>
<br><label class="checkout-text-style"><?php echo $ticketType; ?></label>
</td>
<td class="align-left">
<label class="checkout-caption-style">TICKETS</label>
<br><label class="checkout-text-style"><?php echo $seatName; ?></label>
</td>
</tr>
<?php
}
?>

<tr height="50px"><!-- spacer --></tr>
</table>
<?php
	}
	
	unset($_SESSION["cart"]["screenings"]);
	$existingScreenings = null;
}
else
{
header("location:cart.php");
}
?>
</li>

</ul>

</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>