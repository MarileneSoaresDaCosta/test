<?php
// echo readfile("playlist.m3u");
// $vocabList = fopen("SATvocab.json", "r") or die("unable to open file");
$str = file_get_contents('SATvocab.json');


// echo json_encode($temp_array);
$json = json_decode($str, true);
// print_r ($json);
// echo "<p>" .count($json);
$randKeyword = array_rand($json);
$randValue = $json[$randKeyword];



// echo "<p>" .$randKeyword;
// echo "<p>" .$randValue;

// fclose($vocabList);
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
	    <h2 class="display-4">SAT vocab</h2>
	    

    	<p> <?php echo "<p>" .$randKeyword;?> </p>

    	<button id="flip"> Flip </button>


    	<p id="definition"> <?php echo "<p>" .$randValue;?></p>
    </div>
    <!-- <div class="container">
	    <br>
	    <h2 class="display-4">SAT vocab</h2>
	    <h3  class="display-6">  </h3>
	    <br>
	 -->    
		 <!-- <?php
		    foreach($json as $keyword => $definition){
			?>	
				<div class="row" style="background-color: lightgrey;" >
					
					<div class="col-sm-2">
				      <?php echo $keyword; ?>
				    </div>
				    
				    <div class="col-sm-10">
				      <?php echo $definition; ?>
				    </div>

				    
				</div>
			<?php 
			}
		    ?>
 -->
	    </div>
		
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script> 
var n = 0;
var keyword = "<?php echo $randKeyword; ?>";
var definition = "<?php echo $randValue; ?>";

$(document).ready(function(){
	console.log(keyword);
	console.log(definition);
	
    $("flip").click(function(){
      flipCard("definition",definition);
    });


});
// now we parse the string as an json obj
  function flipCard(elemID, replacementTxt){
    console.log("changeText", elemID, replacementTxt + n);
    $.get("playlist.php", function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
            js = JSON.parse(data);
            console.log(js);
            out = "";
            console.log("playlist length", js["playlist"].length);
    //         for (var i = 0; i < js["playlist"].length; i++) {
    //           // out += js["playlist"][i]["song"]+"<br>";
				// out +=	'<div class="row">'
				// 			+' <div class="col-4">' + js["playlist"][i]["song"] + '</div>'
				// 			+' <div class="col">' + js["playlist"][i]["band"] + '</div>'
				// 			+' <div class="col-5"> <audio controls> <source src="'+js["playlist"][i]["song"]+'"type="audio/mpeg">Message </audio> </div>'
				// 			+' <div class="col">' + js["playlist"][i]["rating"] + '</div>'	
				// 		+'</div>';
            // }
            $(elemID).html(out);

        });
    n++;


  };

</script>

</html>
