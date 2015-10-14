<?php
session_start();

$bookMovie = htmlspecialchars($_POST["movie"]);
$bookDay = htmlspecialchars($_POST["day"]);
$bookTime = htmlspecialchars($_POST["time"]);

$SA = intval(htmlspecialchars($_POST["SA"]));
$SP = intval(htmlspecialchars($_POST["SP"]));
$SC = intval(htmlspecialchars($_POST["SC"]));

$FA = intval(htmlspecialchars($_POST["FA"]));
$FC = intval(htmlspecialchars($_POST["FC"]));

$B1 = intval(htmlspecialchars($_POST["B1"]));
$B2 = intval(htmlspecialchars($_POST["B2"]));
$B3 = intval(htmlspecialchars($_POST["B3"]));

//calc.js port
$normalPrice = 18.50;
$hasDiscount = false;

if ($bookDay == "Monday" || $bookDay == "Tuesday")
{
	$hasDiscount = true;
}
else if ($bookTime == "1pm" && ($bookDay != "Saturday" && $bookDay != "Sunday"))
{
	$hasDiscount = true;
}

$seatPrices = array(
"SA" => $hasDiscount ? 12 : 18,
"SP" => $hasDiscount ? 10 : 15,
"SC" => $hasDiscount ? 8 : 12,
"FA" => $hasDiscount ? 25 : 30,
"FC" => $hasDiscount ? 20 : 25,
"B1" => $hasDiscount ? 20 : 30,
"B2" => $hasDiscount ? 20 : 30,
"B3" => $hasDiscount ? 20 : 30);

$bookSeats = array(
"SA" => $SA,
"SP" => $SP,
"SC" => $SC,
"FA" => $FA,
"FC" => $FC,
"B1" => $B1,
"B2" => $B2,
"B3" => $B3
);

if (isset($_SESSION["cart"]) &&
	isset($_SESSION["cart"]["screenings"]))
{
	//we're adding on to an existing cart
	$hasUpdated = false;
	$existingScreenings = $_SESSION["cart"]["screenings"];
	for ($i = 0; $i < count($existingScreenings); $i++)
	{
		$existingScreening = $existingScreenings[$i];
		
		if ($existingScreening["movie"] == $bookMovie &&
			$existingScreening["day"] == $bookDay &&
			$existingScreening["time"] == $bookTime)
		{
			//updating
			foreach ($bookSeats as $bookSeatName => $bookSeatQuantity)
			{
				if ($bookSeatQuantity != 0)
				{
					if (isset($existingScreening["seats"][$bookSeatName]))
					{
						$currentNum = $existingScreening["seats"][$bookSeatName]["quantity"];

						$existingScreening["seats"][$bookSeatName]["quantity"] = $bookSeatQuantity;
					}
					else
					{
						//update with new seat, if not previously included
						$existingScreening["seats"][$bookSeatName] = array(
						"quantity" => $bookSeatQuantity,
						"price" => $seatPrices[$bookSeatName]
						);
					}
					
					$_SESSION["cart"]["screenings"][$i] = $existingScreening;
				}
			}
			$hasUpdated = true;
			break;
		}
	}
	
	if (!$hasUpdated)
	{
		foreach ($bookSeats as $bookSeatName => $bookSeatQuantity)
		{
			if ($bookSeatQuantity != 0)
			{
				$seats[$bookSeatName] = array(
				"quantity" => $bookSeatQuantity,
				"price" => $seatPrices[$bookSeatName]
				);
			}
		}
		
		$newScreening = array(
		"movie" => $bookMovie,
		"day" => $bookDay,
		"time" => $bookTime,
		"seats" => $seats);
		
		$_SESSION["cart"]["screenings"][] = $newScreening;
	}
}
else
{
	foreach ($bookSeats as $bookSeatName => $bookSeatQuantity)
	{
		if ($bookSeatQuantity != 0)
		{
			$seats[$bookSeatName] = array(
			"quantity" => $bookSeatQuantity,
			"price" => $seatPrices[$bookSeatName]
			);
		}
	}
	
	$newScreening = array(
	"movie" => $bookMovie,
	"day" => $bookDay,
	"time" => $bookTime,
	"seats" => $seats);
	
	$_SESSION["cart"]["screenings"][] = $newScreening;
}

header("location:cart.php");

?>