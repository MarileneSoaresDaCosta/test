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
    	<div class="jumbotron">
	    <h2 class="display-4">SAT vocab</h2>
	    </div>
		    <div class="panel panel-default">
		    <button id="nextWord"> next word </button>
		    <br> <br>
	    	<div class="display-4" id="word"> </div>
	    	<br> <br>
	    	<button  id="flip"> Show definition </button>
	    	<br> 	
    	
    	<!-- <div class="well well-lg"> -->
	    	

	    	<div class="well well-lg" id="def"> </div>
    	</div>

    	<!-- <button id="getDone"> got json? </button> -->

    	
    </div>
    
		



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<script> 
// var keyword = "<?php echo $randKeyword; ?>";
// var definition = "<?php echo $randValue; ?>";

var wordslisturl = 'getVocab.php'; // fixed initial list (json file)

var username = "<?php echo 'user1'; ?>";
var dynamicUrl = wordslisturl + "?user=" + username;
var wordsArray = [];

$(document).ready(function(){
	// console.log(keyword);
	// console.log(definition);
	loadWords(dynamicUrl);

    $("#flip").click(function(){
      flipCard();
    });

    $("#getDone").click(function(){
      console.log("getDone pressed", window.wordsArray.length);
    });

    $("#nextWord").click(function(){
      console.log("nextword pressed", window.wordsArray.length);
      nextWord();
    });
}); // end of document ready

function nextWord(){
	console.log("nextWord fn");
	var rand = wordsArray[Math.floor(Math.random() * wordsArray.length)];
	console.log(rand["word"]);
	$("#word").html(rand["word"]);
	$("#def").html(rand["definition"]);
	$("#def").css("display", "none");
}


function loadWords(url){
	console.log("loadWords", url);
    $.get(url, function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
            console.log(url, data.length);
            var lines = data.split('\n');
			for(var i = 0;i < lines.length;i++){
				line = lines[i];
				// if(line.length < 4) continue;
				try {
			    	js = JSON.parse(line);
				}
				catch(err) {
			    	continue;
				}
				// console.log(js['word']);
				window.wordsArray.push(js);
            }
        });
}


// now we parse the string as an json obj
function flipCard(){
	$("#def").css("display", "block");
  	}

</script>

</html>
