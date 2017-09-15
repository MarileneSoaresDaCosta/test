<?php
// echo readfile("playlist.m3u");
$playlist = fopen("playlist.m3u", "r") or die("unable to open file");
$arr = array();

// while(!feof($playlist)) {
// 	echo fgets($playlist)."<br>";
// }

while(!feof($playlist)) {
	$arr[] = fgets($playlist);
}

fclose($playlist);

// foreach($arr as $songfile){
// 	echo $songfile."<br>";
// }


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
    <h2 class="display-4">MP3 Player Version 4</h2>
    <h3  class="display-6"> php, read file with names of songs </h3>
    <br>

	<?php
	foreach ($arr as $songfile) { ?>
		<div class="row ">
	        <div class="col"> 
	        <?php echo $songfile;?>
	         
	        </div>
	        <div class="col">
	          <audio controls>
	        <source src="<?php echo $songfile; ?>" type="audio/mpeg">
	         Your browser does not support the audio element.
	        </audio>
	        </div>
	      </div>
	<?php 
	};
	?>
	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>