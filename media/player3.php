<?php
$arr = array( "Miracles" => "mp3Files/Miracles.mp3",
	     "Something" => "mp3Files/Something_Just_Like_This.mp3" ,
	     "Speed" => "mp3Files/Speed_Of_Sound.mp3");

// foreach ($arr as $val) {
// 	echo "<p> $val ";
// };
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
    <h2 class="display-4">MP3 Player Version 3</h2>
    <h3  class="display-6"> php, fixed array </h3>
    <br>

	<?php
	foreach ($arr as $key => $val) { ?>
		<div class="row ">
	        <div class="col"> 
	         <?php echo $key; ?>
	        </div>
	        <div class="col">
	          <audio controls>
	        <source src="<?php echo $val; ?>" type="audio/mpeg">
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

