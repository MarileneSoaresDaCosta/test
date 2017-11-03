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

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

   

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:800' rel='stylesheet' type='text/css'>
  	<link href='https://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
  	<link href='https://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
    
    <!-- icon awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

<style> 

.navbar-nav{
	width: 100%;
}

.container {
  display: flex;
  flex-flow: row;
  height: 100%;
  width: 100%;
  /*background-color: #c7ccd6;*/
  margin: 0 -1em;
  padding: 0 1em;  
}


.main {
  /*background-color: #c7ccd6;*/
  display: flex;
  flex-direction: column;
  flex: 1;
  max-height: 600px;
  padding: 1em 1em; 
  
}

.col {
  /*margin: auto;*/
}
body{
  font-family: Raleway, sans-serif;
  font-size: 1em;
  font-weight: 400;
}


#word {
  background-color: #f0f9e5;
  max-height: 50px;
  font-family: Raleway, sans-serif;
  font-size: 1.5em;
  font-weight: 400;
  }

#def {
  background-color: #f0f9e5;
  font-family: Raleway,sans-serif;
  font-size: 1em;
  font-weight: 400;
  max-height: 250px;
  width: 100%;
  margin-top: 1em;
  }

#buttons {
  font-family: Raleway,sans-serif;
  font-size: 0.75em;
  font-weight: 400;
  max-height: 50px;
  width: 100%;
  display: inline-flex;
  justify-content: space-around;
  margin-top: 0.5em;

  }

#progress {
  font-family: Raleway,sans-serif;
  font-size: 1em;
  font-weight: 400;
  max-height: 40px;
  width: 100%;
  margin-top: 0.5em;
  }

.quiz {
  flex:2;
  /*background-color: #c7ccd6;*/
  height: 340px;
  max-width: 40%;
  padding: 0 1em; 
  margin-top: 1em;
}

#wordToDef {
  font-family: Raleway,sans-serif;
  font-size: 1em;
  font-weight: 400;
  /*background: yellow;*/
  height: 100px;
  display: flex;
  justify-content: center;
}

#defToWord{
  font-family: Raleway,sans-serif;
  font-size: 1em;
  font-weight: 400;
  /*background: yellow;*/
  height: 100px;
  display: flex;
  justify-content: center;
}

header {
  font-family: Raleway, sans-serif;
  font-size: 2em ;
  font-weight: 800;
  margin: 20px;
  }

h3 {
  font-family: Raleway, sans-serif;
  font-size: 1em ;
  font-weight: 800;
  margin: 10px 0px 0px 20px;
}

h6 {
  font-family: Raleway, sans-serif;
  font-size: 0.7em ;
  font-weight: 400;
  margin: 10px 0px 0px 20px;
}

#icons{
  display: flex;
  justify-content: center;
  }

#icons:hover{
  opacity: 0.5;
}


#iconR{
  display: flex;
  justify-content: center;
  }

#iconR:hover{
	opacity: 0.5;
}

#iconR:hover ~ #iconRtext {
  visibility: visible;
}

#iconRtext {
	visibility: hidden;
}

#welcome{
	margin-top: 20px;
	/*margin-right:200px;*/
}

#signout {
	padding-left: 20px;
}


@media screen and (max-width:768px) {
  .container {
   -webkit-flex-flow: column wrap;
    flex-flow: column wrap;
  }
.main{
	height: 400px;
}
  .quiz {
    margin: 0 2em;
    padding: 0 1em;
    max-width: 100%;
    max-height: 100px;
  }

  #wordToDef {
    height: 30px;
    font-size: 0.75em;
    font-weight: 400;
  }

  #defToWord{
    height: 30px;
    font-size: 0.75em;
    font-weight: 400;
  }

  #icons{
    display: inline-block;
    padding:0px 10px;
    }

  #iconR{
    padding:0px 10px 0px 10px;
    }

}
</style>
</head>

  <body>
  <!-- navigation bar navbar-expand-lg-->

  <nav class="navbar  navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="catIcon.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">SAT Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Self-test
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Word to Definition</a>
          <a class="dropdown-item" href="#">Definition to Word</a>
          <!-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Lene's Projects</a>
      </li>
     
    </ul>
    <div class="navbar-nav navbar-right" id="welcome">  
    	<!-- <i class="fa fa-user" id="icons" style="font-size:24px; color:#1672ce" ></i>  -->
    	<?php echo '<p>Hello '.$_SESSION['alias'].'!</p>';?>  
    	<p id="signout"><a href="logout.php"> Sign out</a> </p> </div>
      
    
  </div>
</nav>


<header class="header">SAT Vocab</header>

<div class="container">

  <section class="main">
    <div class="col" id="word">word</div>
    <div class="col" id="def">def</div>
    <div class="col" id="buttons">
      
        <i class="fa fa-angle-left" id="icons" style="font-size:36px; color:#1672ce"></i>
        <i class="fa fa-angle-right" id="icons" style="font-size:36px; color:#1672ce"></i>
        <i class="fa fa-check-square-o" aria-hidden="true" id="iconR" style="font-size:36px; color:#1672ce">
        	<div id="iconRtext"> memorize</div>
        </i>
        
      
    </div>
    <div class="col" id="progress">
      <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">70%</div>
    </div>
  </section>
  <section class="quiz">
    <div class="col" id="wordToDef">Match word to definition</div>
    <div class="col" id="defToWord">Match definition to word</div>
  </section>

</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<!-- jQuery script -->
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
