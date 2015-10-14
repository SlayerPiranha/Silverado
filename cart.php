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

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/calc.js"></script>
<script src="scripts/cart.js"></script>
<?php

$hasDiscount = false;

$inputVoucher = "";
$isDefinedVoucher = false;
$isInvalidVoucher = false;
if (isset($_POST["voucher-code"]))
{
	$isDefinedVoucher = true;
	$inputVoucher = htmlspecialchars($_POST["voucher-code"]);
}
else if (isset($_SESSION["cart"]["voucher"]))
{
	$isDefinedVoucher = true;
	$inputVoucher = $_SESSION["cart"]["voucher"];
}

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
		else
		{
			$isInvalidVoucher = true;
		}
		
		$_SESSION["cart"]["voucher"] = $inputVoucher;
	}
}
else if ($isDefinedVoucher)
{
	$isInvalidVoucher = true;
}


$hasScreenings = false;
if (isset($_SESSION["cart"]) &&
	isset($_SESSION["cart"]["screenings"]))
{	
	$existingScreenings = $_SESSION["cart"]["screenings"];
	if (isset($_GET["remove"]))
	{
		$removeAt = $_GET["remove"];
		if ($removeAt == "all")
		{
			unset($_SESSION["cart"]["screenings"]);
			$existingScreenings = null;
		}
		else
		{
			unset($existingScreenings[$removeAt]);
			$existingScreenings = array_values($existingScreenings);
		
			$_SESSION["cart"]["screenings"] = $existingScreenings;
		}
	}
	$numScreenings = count($existingScreenings);
	if ($numScreenings > 0)
	{
		$hasScreenings = true;
	}
}

if ($hasScreenings)
{
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
	toggleRow(".vouchers");
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
<li class="title-style">Cart</li>
<li class="caption-style list-item-spacing">
<?php
if ($hasScreenings)
{
?>
Review your reservations.
<?php
}
else
{
?>
There's nothing inside.
<?php
}
?>

</li>

<li class="list-item-spacing">
<?php
if ($hasScreenings)
{
	$grandTotal = 0;
	
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

<tr>
<td class="align-left select-tab-header" colspan="3" rowspan="2">
<label class="movie-name-style"><?php echo $title; ?></label>
<br><label class="caption-mini-style">Showing on <?php echo $day . ", " . $time; ?></label>
</td>
<td class="remove-tab-mini">
<a href="cart.php?remove=<?php echo $i; ?>" class="header-link movie-description-style">Remove</a>
</td>
</tr>

<tr class="edit-tab-mini">
<td>
<a href="booking.php?edit=<?php echo $i; ?>" class="header-link movie-description-style">Edit ></a>
</td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.seating-<?php echo $i; ?>')">
<td class="align-center" colspan="4"><label class="description-style">Tickets</label></td>
</tr>

</tr>

<?php

$hasStandard = false;
$hasFirstClass = false;
$hasBeanbag = false;

$hasSetStandard = false;
$hasSetFirstClass = false;
$hasSetBeanbag = false;

$movieTotal = 0;

foreach ($seats as $seatId => $seatData)
{
	switch ($seatId)
	{
		case "SA":
			$seatName = "Adult";
			$hasStandard = true;
			break;
			
		case "SP":
			$seatName = "Concession";
			$hasStandard = true;
			break;
			
		case "SC":
			$seatName = "Child";
			$hasStandard = true;
			break;
			
		case "FA":
			$seatName = "Adult";
			$hasFirstClass = true;
			break;
			
		case "FC":
			$seatName = "Concession";
			$hasFirstClass = true;
			break;
			
		case "B1":
			$seatName = "Adults";
			$hasBeanbag = true;
			break;
			
		case "B2":
			$seatName = "Adult&nbsp;+&nbsp;Child";
			$hasBeanbag = true;
			break;
		
		case "B3":
			$seatName = "3&nbsp;Children";
			$hasBeanbag = true;
			break;
	}
?>

<?php
	if ($hasStandard &&
		!$hasSetStandard)
	{
?>
<tr class="select-tab-mini seating-<?php echo $i; ?>">
<td class="align-center">
<label class="summary-text-style"><b>STANDARD</b></label>
</td>
<td class="align-center">
<label class="summary-text-style">PRICE</label>
</td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>
<?php
		$hasSetStandard = true;
	}
?>

<?php
	if ($hasFirstClass &&
		!$hasSetFirstClass)
	{
?>
<tr class="select-tab-mini seating-<?php echo $i; ?>">
<td class="align-center">
<label class="summary-text-style"><b>FIRST&nbsp;CLASS</b></label>
</td>
<td class="align-center">
<label class="summary-text-style">PRICE</label>
</td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>
<?php
		$hasSetFirstClass = true;
	}
?>

<?php
	if ($hasBeanbag &&
		!$hasSetBeanbag)
	{
?>
<tr class="select-tab-mini seating-<?php echo $i; ?>">
<td class="align-center">
<label class="summary-text-style"><b>BEANBAG</b></label>
</td>
<td class="align-center">
<label class="summary-text-style">PRICE</label>
</td>
<td class="align-center">
<label class="summary-text-style">QUANTITY</label>
</td>
<td class="align-center">
<label class="summary-text-style">SUB-TOTAL</label>
</td>
</tr>
<?php
		$hasSetBeanbag = true;
	}
	
	$ticketPrice = $seatData["price"];
	$ticketQuantity = $seatData["quantity"];
	$ticketSubtotal = $ticketPrice * $ticketQuantity;
	
	$movieTotal += $ticketSubtotal;
?>

<tr class="seating-<?php echo $i; ?>">
<td class="align-center"><label><?php echo $seatName; ?></label></td>
<td>
<input type="text" id="<?php echo $seatId; ?>" value="$<?php echo number_format($ticketPrice, 2); ?>" class="price-display" disabled>
</td>
<td>
<input type="text" id="<?php echo $seatId; ?>" value="<?php echo $ticketQuantity; ?>" class="price-display" disabled>
</td>
<td>
<input type="text" id="<?php echo $seatId; ?>-price" value="$<?php echo number_format($ticketSubtotal, 2); ?>" class="price-display" disabled>
</td>
</tr>

<?php
}
$grandTotal += $movieTotal;
?>

<tr class="select-tab-mini row-total-payable">
<td class="align-right" colspan="3"><label>Sub-total</label></td>
<td>
<input type="text" id="total-price" value="$<?php echo number_format($movieTotal, 2); ?>" class="price-display" disabled>

<input type="hidden" id="price" name="price" value="0">
</td>
</tr>
<tr height="50px"><!-- spacer --></tr>
<?php
	}
?>

<tr id="row-total-payable">
<td class="align-right" colspan="3"><label>Total</label></td>
<td>
<input type="text" id="total-price" value="$<?php echo number_format($grandTotal, 2); ?>" class="price-display" disabled>

<input type="hidden" id="price" name="price" value="0">
</td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.vouchers')">
<td class="align-center" colspan="4"><label class="description-style">Vouchers</label></td>
</tr>
<?php
if ($hasDiscount)
{
	$grandTotal *= 0.8;
?>
<tr id="row-total-payable" class="voucher-tab-header-mini">
<td class="align-right" colspan="3"><label><i>Meal and Movie Deal Voucher (<?php echo $inputVoucher; ?>)</i></label></td>
<td>
<input type="text" id="total-price" value="20%" class="price-display" disabled>

<input type="hidden" id="price" name="price" value="0">
</td>
</tr>
<?php
}
?>

<tr class="select-tab-mini row-total-payable vouchers">
<td class="align-center" colspan="4">
<form method="post" action="cart.php">
<table class="fill-space">


<tr>
<td>
<label class="summary-text-style">
<?php
if ($isInvalidVoucher)
{
	echo "INVALID VOUCHER CODE";
}
else
{
	echo "ENTER VOUCHER CODE";
}
?>
</label>
</td>
<td></td>
</tr>
<tr>
<td><input type="text" name="voucher-code" id="voucher-code" value="<?php echo $inputVoucher; ?>" class="text-field <?php if ($isInvalidVoucher) echo "invalid-field"; ?>"></td>
<td></td>
<td><input type="submit" value="Apply voucher" class="button" id="apply_button"></td>
</tr>
</table>
</form>
</td>
</tr>

<tr id="row-total-payable">
<td class="align-right" colspan="3"><label><b>Grand Total</b></label></td>
<td>
<input type="text" id="total-price" value="$<?php echo number_format($grandTotal, 2); ?>" class="price-display" disabled>

<input type="hidden" id="price" name="price" value="0">
</td>
</tr>
</table>
<?php
}
else
{
?>

<a href="movies.php" class="header-link movie-description-style">Find&nbsp;movies&nbsp;to&nbsp;watch&nbsp;></a>

<?php
}
?>
</li>

<?php
if ($hasScreenings)
{
?>
<li class="list-item-spacing">
<form method="post" action="cartDetails.php">
<a href="cart.php?remove=all" class="header-link movie-description-style">Empty the cart</a>&nbsp;&nbsp;&nbsp;
<input type="submit" value="Next" class="button" id="book_button">
</form>
</li>
<?php
}
?>
</ul>

</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>