

function updatePrices()
{
  var normalPrice = 18.50;
  var hasDiscount = false;

  var day = $("#day").val();
  var time = $("#time").val();
  if (day == 'Monday' || day == 'Tuesday')
  {
    hasDiscount = true;
  }
  else if (time == '1pm' && (day != 'Saturday' && day != 'Sunday'))
  {
    hasDiscount = true;
  }

  var saPrice = calcAndUpdatePrice("#SA", hasDiscount ? 12 : 18);
  var spPrice = calcAndUpdatePrice("#SP", hasDiscount ? 10 : 15);
  var scPrice = calcAndUpdatePrice("#SC", hasDiscount ? 8 : 12);
  var faPrice = calcAndUpdatePrice("#FA", hasDiscount ? 25 : 30);
  var fcPrice = calcAndUpdatePrice("#FC", hasDiscount ? 20 : 25);
  var b1Price = calcAndUpdatePrice("#B1", hasDiscount ? 20 : 30);
  var b2Price = calcAndUpdatePrice("#B2", hasDiscount ? 20 : 30);
  var b3Price = calcAndUpdatePrice("#B3", hasDiscount ? 20 : 30);
  var totalPrice = saPrice + spPrice + scPrice + faPrice + fcPrice + b1Price + b2Price + b3Price;
  updatePrice("#total", totalPrice);

  $("#price").val(totalPrice);

  $("#book_button").prop("disabled", totalPrice == 0);
  if (totalPrice == 0)
  {
    $("#row-total-payable").hide();
  }
  else
  {
    $("#row-total-payable").show();
  }
}

function calcPrice(name, paxPrice)
{
  var fieldValue = $(name).val();
  if (typeof fieldValue == 'undefined')
  {
	return 0;
  }
  else
  {
    return fieldValue * paxPrice;
  }
}

function updatePrice(name, value)
{
  $(name + "-price").val("$" + value.toFixed(2));
}

function calcAndUpdatePrice(name, paxPrice)
{
  var result = calcPrice(name, paxPrice);
  updatePrice(name, result);
  return result;
}

