$movieSrc = "";

$(document).ready(function(){

$("#movie-short-description").show();
$("#movie-long-description").hide();
$movieSrc = $("#trailer").attr("src");
$("#trailer").attr("src", "");

});

function showFullDescription()
{
  $("#movie-short-description").hide();
  $("#movie-long-description").show();
  $("#poster").hide();
  $("#trailer").attr("src", $movieSrc);
}
