$(document).ready(function(){

$("#movie-short-description").show();
$("#movie-long-description").hide();

//only hide rows if JS is enabled, otherwise it's hidden for non-JS users
toggleRow(".pricing-row-mt");
toggleRow(".pricing-row-wf");
toggleRow(".pricing-row-ss");

toggleRow(".ticket-row-standard");
toggleRow(".ticket-row-firstclass");
toggleRow(".ticket-row-beanbag");
$(".row-total-payable").hide();

var schedule1 =
{
  "1pm": "CH",
  "6pm": "AF",
  "9pm": "RC"
};

var schedule2 =
{
  "1pm": "RC",
  "6pm": "CH",
  "9pm": "AC"
};

var schedule3 =
{
  "12pm": "CH",
  "3pm": "AF",
  "6pm": "CH",
  "9pm": "AC"
};

var schedules = {};
schedules["Monday"] = schedule1;
schedules["Tuesday"] = schedule1;
schedules["Wednesday"] = schedule2;
schedules["Thursday"] = schedule2;
schedules["Friday"] = schedule2;
schedules["Saturday"] = schedule3;
schedules["Sunday"] = schedule3;

//initial setup
filterDays(schedules);
filterTime(schedules);

$("#movie").change(function(){
  filterDays(schedules);
  filterTime(schedules);
});

$("#day").change(function(){
  filterTime(schedules);
});

updatePrices();
$(".booking-option").each(function(){
  $(this).change(function(){
    updatePrices();
  });
});

});

function showFullDescription()
{
  $("#movie-short-description").hide();
  $("#movie-long-description").show();
}

function addUniqueOptionToSelect(value, display, selectName)
{
  if ($(selectName).find("option[value='" + value + "']").length == 0)
  {
    $(selectName).append("<option value=" + value + ">" + display + "</option>");
  }
}

function filterDays(schedules)
{
  $("#day").find("option").remove();
  $("#time").find("option").remove();

  var chosenMovie = $("#movie").val();
  for (var day in schedules)
  {
    var schedule = schedules[day];
    for (var time in schedule)
    {
      var movie = schedule[time];
      if (movie == chosenMovie)
      {
        addUniqueOptionToSelect(day, day, "#day");
        addUniqueOptionToSelect(time, time, "#time");
      }
    }
  }
}

function filterTime(schedules)
{
  $("#time").find("option").remove();
  var chosenMovie = $("#movie").val();
  var chosenDay = $("#day").val();
  for (var day in schedules)
  {
    if (day == chosenDay)
    {
      var schedule = schedules[day];
      for (var time in schedule)
      {
        var movie = schedule[time];
        if (movie == chosenMovie)
        {
          addUniqueOptionToSelect(time, time, "#time");
        }
      }
    }
  }
}
