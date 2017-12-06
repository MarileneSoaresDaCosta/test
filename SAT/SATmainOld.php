<?php
session_start();
// echo json_encode($_SESSION);

// $user1 = "a";
//check if user logged in and send to login page
if( !isset($_SESSION['fingerprint'])){ 
  header("Location:login.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">
    <style>
		.progress{
		    width: 150px;
		    height: 150px;
		    line-height: 150px;
		    background: none;
		    margin: 0 auto;
		    box-shadow: none;
		    position: relative;
		}
		.progress:after{
		    content: "";
		    width: 100%;
		    height: 100%;
		    border-radius: 50%;
		    border: 12px solid #fff;
		    position: absolute;
		    top: 0;
		    left: 0;
		}
		.progress > span{
		    width: 50%;
		    height: 100%;
		    overflow: hidden;
		    position: absolute;
		    top: 0;
		    z-index: 1;
		}
		.progress .progress-left{
		    left: 0;
		}
		.progress .progress-bar{
		    width: 100%;
		    height: 100%;
		    background: none;
		    border-width: 12px;
		    border-style: solid;
		    position: absolute;
		    top: 0;
		}
		.progress .progress-left .progress-bar{
		    left: 100%;
		    border-top-right-radius: 80px;
		    border-bottom-right-radius: 80px;
		    border-left: 0;
		    -webkit-transform-origin: center left;
		    transform-origin: center left;
		}
		.progress .progress-right{
		    right: 0;
		}
		.progress .progress-right .progress-bar{
		    left: -100%;
		    border-top-left-radius: 80px;
		    border-bottom-left-radius: 80px;
		    border-right: 0;
		    -webkit-transform-origin: center right;
		    transform-origin: center right;
		    animation: loading-1 1.8s linear forwards;
		}
		.progress .progress-value{
		    width: 90%;
		    height: 90%;
		    border-radius: 50%;
		    /* grey center*/
		    background: #44484b; 
		    font-size: 24px;
		    color: #fff;
		    line-height: 135px;
		    text-align: center;
		    position: absolute;
		    top: 5%;
		    left: 5%;
		}
		.progress.blue .progress-bar{
			/* progress bar color */
		    border-color: #0ef278;
		}
		.progress.blue .progress-left .progress-bar{
		    animation: loading-2 1.5s linear forwards 1.8s;
		}
		.progress.yellow .progress-bar{
		    border-color: #fdba04;
		}
		.progress.yellow .progress-left .progress-bar{
		    animation: loading-3 1s linear forwards 1.8s;
		}
		.progress.pink .progress-bar{
		    border-color: #ed687c;
		}
		.progress.pink .progress-left .progress-bar{
		    animation: loading-4 0.4s linear forwards 1.8s;
		}
		.progress.green .progress-bar{
		    border-color: #1abc9c;
		}
		.progress.green .progress-left .progress-bar{
		    animation: loading-5 1.2s linear forwards 1.8s;
		}
		@keyframes loading-1{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(180deg);
		        transform: rotate(180deg);
		    }
		}
		@keyframes loading-2{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(144deg);
		        transform: rotate(144deg);
		    }
		}
		@keyframes loading-3{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(90deg);
		        transform: rotate(90deg);
		    }
		}
		@keyframes loading-4{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(36deg);
		        transform: rotate(36deg);
		    }
		}
		@keyframes loading-5{
		    0%{
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }
		    100%{
		        -webkit-transform: rotate(126deg);
		        transform: rotate(126deg);
		    }
		}
		@media only screen and (max-width: 990px){
		    .progress{ margin-bottom: 20px; }
		}
	</style>
  </head>

  <body>

  	
  	<div class="container">
      <header class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About this project</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Project Portfolio</a>
            </li>
          </ul>
        </nav>

        <?php 
	    echo '<h3 class="text-muted">Hello '.$_SESSION['alias'].'!</h3>';
	    ?>
	    <h6 id="logout" class="text-muted"> <a href="logout.php">Log out</a> </h6>
        
      </header>

       <div class="jumbotron">
          <h1 class="display-3">SAT Vocabulary</h1>
          <p class="lead">Practice with a vocabulary of nearly 1000 words. Save the words you memorized and see your progress.</p>
    	
		    <div class="row">
		    	<div class="col-sm-8">
		    		
		    		<button id="goBack" class="btn btn-info"> Back </button>
		    		<button id="nextWord" class="btn btn-info"> Next </button>
		    		<br><br>
		    		<div class="display-4" id="word"> </div>
		    		<br><br>
		    	</div>
		    	<div class="col-sm-4">
		    		<button  id="mem" class="btn btn-success float-right" style="background-color: #0ef278; border:#0ef278;" >Memorized</button>
		    	</div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-8">
					<button  id="flip" class="btn btn-info"> Show definition </button>
					<br><br>
					<div class="well well-lg" id="def"> </div>
					<br><br>
	    		</div>
				<div class="col-sm-4 float-right">
			        <div class="progress blue">
				        <span class="progress-left">
				        	<span class="progress-bar"></span>
				        </span>
				        <span class="progress-right">
				       		<span class="progress-bar"></span>
				        	</span>
			        	<div class="progress-value">90%</div>
			        </div>
			    </div>
	    	</div>		    
			</div>
		</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<script> 


var username = "<?php echo $_SESSION['username']; ?>";
var dynamicUrl = "getVocab.php?user=" + username;
console.log(dynamicUrl);
var wordsArray = [];
var memUrl = "updateMem.php?user=" + username;
var hash="";
$(document).ready(function(){
	// console.log(keyword);
	// console.log(definition);
	loadWords(dynamicUrl);

    $("#flip").click(function(){
      flipCard();
    });

    // $("#getDone").click(function(){
    //   console.log("getDone pressed", window.wordsArray.length);
    // });

    $("#nextWord").click(function(){
      console.log("nextword pressed", window.wordsArray.length);
      nextWord();
    });

	$("#mem").click(function(memUrl){
      console.log("memorize pressed", window.wordsArray.length);
      memorizeWord();
    });


}); // end of document ready

function nextWord(){
	console.log("nextWord fn");
	var rand = wordsArray[Math.floor(Math.random() * wordsArray.length)];
	console.log(rand["word"]);
	$("#word").html(rand["word"]);
	$("#def").html(rand["definition"]);
	$("#def").css("display", "none");
	window.hash=rand["hash"];

}


function loadWords(url){
	console.log("loadWords", url);
    $.get(url, function(data, status){  // ajax call to url, returns data produced by getVocab.php
            // alert("Data: " + data + "\nStatus: " + status);
            console.log(url, data.length);
            var lines = data.split('\n');
			for(var i = 0;i < lines.length;i++){
				line = lines[i];
				// console.log(line);
				try {
			    	js = JSON.parse(line);
				}
				catch(err) {
					console.log("error parsing json");
			    	continue;
				}
				// console.log(js[i]);
				// console.log(js['word']);
				window.wordsArray.push(js);
            }
        });
}



function flipCard(){
	$("#def").css("display", "block");
  	}

function memorizeWord(){
	var memUrl = "updateMem.php?user=" + username+"&hash="+window.hash;
	console.log("memorizeWord", memUrl);
    $.get(memUrl, function(data, status){ 

    });

}




</script>

</html>
