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
    <title>SAT Vocab </title>
    <link rel="stylesheet" type="text/css" href="SATmain.css">
    <link rel="icon" href="catIcon.png">
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

    <!-- jQuery dialog box -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



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
      
      <li class="nav-item">
        <a class="nav-link" href="SATquiz.php">Test Your Vocab</a>
      </li>




      <li class="nav-item">
        <a class="nav-link" href="https://lene626.com/">Lene's Projects</a>
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
        
        <i class="fa fa-angle-left icons iconR" id="back" title="Previous word" style="font-size:36px; color:#1672ce"></i>
        <i class="fa fa-angle-right icons" id="nextWord"  title="Next word" style="font-size:36px; color:#1672ce"></i>
        <i class="fa fa-file-text-o icons" id="flip"  title= "Show definition" style="font-size:30px; color:#1672ce"></i>
        <i class="fa fa-check-square-o icons"  id="mem" title="Memorized!" style="font-size:36px; color:#1672ce">
        	
        </i>
        
      
    </div>
    <div class="col" id="progress">
      <!-- .progress is a wrapper to indicate the max value of the progress bar -->
      <div class="progress"> 
        <!-- inner .progress-bar indicate the progress so far -->
        <div class="progress-bar" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
      
  </section>

  <section class="quiz">
    <div class="col" > 
   </div>
  </section>

</div>

<div id="dialog-confirm" title="Save to Memorized list?" style="visibility: hidden;">
  
    <!-- <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span> -->
  Save to Memorized word list?
</div>
 
 
 </body>





<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<script> 




var username = "<?php echo $_SESSION['username']; ?>";
var dynamicUrl = "getOneWord.php?user=" + username;
console.log('dynamicURL',dynamicUrl);
var wordsArray = [];
var currentWordIndex = wordsArray.length -1;
var memUrl = "updateMem.php?user=" + username;
var hash="";
// var seenWords = [];
var numMemWordsUrl = "checkProgress.php?user=" +username;
var totalWords = 970;


$(document).ready(function(){

  updateProgress();

  $("#nextWord").click(function(){
    console.log("nextword pressed");
    nextWord();
  });
    
  $("#flip").click(function(){
    flipCard();
  });

	 $("#mem").click(function(memUrl){
    console.log("memorize pressed");
    memorizeWord();
  });

  $("#back").click(function(){
    console.log("back pressed: current i", window.currentWordIndex);
    back();
    });

  $("#progress-bar").click(function(){
    console.log("update Progress bar");
    updateProgress();
    });

}); // end of document ready


function getWord(url){
  console.log("getWord fn", url);
  $.get(url, function(data, status){ 
    console.log("getWord, data.length", url, data.length);
      try {
        var js = JSON.parse(data);
        console.log('js',js);
      }
      catch(err) {
        console.log("error parsing json", data);
      }
    window.wordsArray.push(js);
    var i = window.currentWordIndex;
    $("#word").html(window.wordsArray[i]['word']);
    $("#def").html(window.wordsArray[i]['definition']);
    $("#def").css("visibility", "hidden");
    window.hash=window.wordsArray[i]['hash'];
    // console.log('currentWordIndex', i);
  });
}




function nextWord(){
  window.currentWordIndex ++;
  if(currentWordIndex > window.wordsArray.length - 1){
    getWord(window.dynamicUrl);
  } else {
    var i = window.currentWordIndex;
    $("#word").html(window.wordsArray[i]['word']);
    $("#def").html(window.wordsArray[i]['definition']);
    $("#def").css("visibility", "hidden");
    window.hash=window.wordsArray[i]['hash'];
  }
  console.log('currWordIndex',window.currentWordIndex);
}




function back(){
  var i = window.currentWordIndex;
  // console.log('current i', i);
  if(i > 0){
    i --;
    $("#word").html(window.wordsArray[i]['word']);
    $("#def").html(window.wordsArray[i]['definition']);
    $("#def").css("visibility", "hidden");
    window.hash=window.wordsArray[i]['hash'];
  } else {
    i = 0;
    $("#word").html(window.wordsArray[i]['word']);
    $("#def").html(window.wordsArray[i]['definition']);
    $("#def").css("visibility", "hidden");
    window.hash=window.wordsArray[i]['hash'];
  }
  window.currentWordIndex --;
}




function updateProgress(){
  url = "checkProgress.php?user="+username;
  console.log("update Progress", url);
  $.get(url, function(data, status) {
    // console.log("Progress data", data);
    js =  JSON.parse(data);
     // console.log("prog", js);
    var progressWidth = Math.max(Math.floor(100 * (js["count"]/window.totalWords)), 5);
    var progress = Math.floor(100 * (js["count"]/window.totalWords));
    
    $(".progress-bar").css("width", progressWidth +'%');
    $(".progress-bar").attr("aria-valuenow", progress);
    $(".progress-bar").html(progress +'%'); 
  });
}




function flipCard(){
	$("#def").css("visibility", "visible");
  	}



function memorizeWord(){
  // confirm("Save to Memorized Words list?");
  confirmMem();
  var memUrl = "updateMem.php?user=" +username +"&hash="+window.hash;
  $.get(memUrl, function(data, status) {
    js =  JSON.parse(data);
    alert(js['message']+"  Total words memorized: "+js['count']);
    console.log('memorizeWord js', js);
  });
  
  updateProgress();
  nextWord();
}


function confirmMem() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      visibility: "visible",
      buttons: {
        "function... ": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  }


</script>

</html>
