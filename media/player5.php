<?php
// echo readfile("playlist.m3u");
$playlist = fopen("playlist.csv", "r") or die("unable to open file");
$arr = array();

while(!feof($playlist)) {
	$line = fgets($playlist);
	$arr[]= explode(',', $line);
}
// print_r($arr);
// echo "<br>";
fclose($playlist);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
	    <br>
	    <h2 class="display-4">MP3 Player Version 5</h2>
	    <h3  class="display-6"> php, read CSV file with multiple columns </h3>
	    <br>
	    
		<div class="row" style="background-color: lightgrey;" >
		    <div class="col-4">
		      Song
		    </div>
		    <div class="col">
		      Band
		    </div>
		    <div class="col-5">
		      Player
		    </div>
		    <div class="col" style="text-align: left;">
		      Rating
		    </div> 
		</div>

		 <?php
		    foreach($arr as $subarr){
				$path = $subarr[0];
				$arr_path = explode('/', $path);
				$song = $arr_path[1];
				$band = $subarr[1];
				$rating = $subarr[2];
			?>	
				<div class="row" style="background-color: lightgrey;" >
					<div class="col-4">
				      <?php echo $song; ?>
				    </div>
				    <div class="col">
				      <?php echo $band; ?>
				    </div>
				    <div class="col-5">
				      <audio controls>
				        <source src="<?php echo $path; ?>" type="audio/mpeg">
				         Your browser does not support the audio element.
				        </audio>
							    </div>
				    <div class="col">
				      <?php echo $rating; ?>
				    </div>
				</div>
			<?php 
			}
		    ?>

	    </div>
		
    </div>

	


    <!-- Optional JavaScript - jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>