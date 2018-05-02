<?php
$weather = "";
if($_GET['city']){

  $_GET['city'] = str_replace(' ', '', $_GET['city']);

  $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

  if($file_headers[0] == "HTTP/1.1 404 Not Found"){
    $error = "The city could not be found";
  }
  else{
  $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

  $pageArray = explode(' sun, wind, humidity and temperature. <span class="read-more-small"><span class="read-more-content">', $forecastPage);

  if(sizeof ($pageArray) >1){

  $secondPageArray = explode('<p class="large-loc">', $pageArray[1]);
  if(sizeof ($secondPageArray) >1){
  $weather = $secondPageArray[0];

  $weather = str_replace('also', '', $weather);
}
else {
   $error = "That city could not be found";
}
}
else
{
  $error = "That city could not be found";
}
}
}




?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Weather Update</title>

    <style type="text/css">
    html { 
          background: url("https://i.ytimg.com/vi/c7oV1T2j5mc/maxresdefault.jpg") no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              
          }

          .container{
            color: white;
            text-align: center;
            margin-top: 200px;
            width: 450px;
          }

          #weather {
            margin-top:15px;
          }
    </style>
  </head>
  <body>

    <div class= "container">

      <h1>
      What's The Weather
    </h1>
    <form>
  <div class="form-group">
    <label for="city">Enter a city</label>
    <input type="text" class="form-control" name = "city" id="city" placeholder="Eg. Dhaka, Chittagong" value="">
  </div>
  <button type="submit" class="btn btn-light">Submit</button>
</form>

<div id ="weather"> <?php

if ($weather){
  echo '<div class="alert alert-light" role="alert">'.
  $weather.
'</div>';
}

else if($error){
  echo '<div class="alert alert-danger" role="alert">'
  .$error.
'</div>';
}
?>
  </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>