<?php 
error_reporting(0);

		$city="";
		$error="";
	if($_GET['city']){
	
	$urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city']).",uk&appid=ad2164ea0775b6b5813d61345c1c6b59");
		
		$weatherArray = json_decode($urlContents, true);
		
		//print_r($weatherArray);
		
		if ($weatherArray['cod']==200){
		
		$weather = "The weather in ".$_GET['city']." is curently '".$weatherArray['weather'][0]['description']."'.";
		
		$temp = intval($weatherArray['main']['temp'] - 273);
		
		$weather .= "<br/> The temperature is ".($temp)." &degC and the wind speed is ".$weatherArray['wind']['speed']." m/s.";
			
			}else{
					$error = "Could not find city - please try again.";
				
			}
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Weather Scraper</title>
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
 
	<style type="text/css">
	
	html { 
		  background: url(backweather2.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		body{
		background:none;
		}
		.container{
		width:75%;
		color:white;
		text-align:center;
		margin-top:100px;
		margin-bottom:100px;
		}
		#weather{
		margin-top:10px;
		}
		
	
	</style>

 </head>
  <body>
	
	<div class="container">
	<h1>What is the weather?</h1>
	
	<form>
  <div class="form-group">
    <label for="city">Enter the name of the city</label>
    <input type="text" name="city" class="form-control" id="city"  placeholder="London, Tokyo, Zagreb, Sarajevo, Mostar..." value="<?php if(isset($_GET['city'])) {echo $_GET['city'];} ?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

		<div id="weather">
			<?php
				if(isset($weather)){
					echo '<div class="alert alert-success" role="alert">
					'.$weather.'
					</div>';
				}
				else if($error){
					echo '<div class="alert alert-danger" role="alert">
					'.$error.'
					</div>';
				}
			?>
		</div>
	
	</div>
	
   

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>