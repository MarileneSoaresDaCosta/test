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
    <title>SAT Vocab Self-Test </title>
    <link rel="stylesheet" type="text/css" href="SATquiz.css">
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
        <li class="nav-item">
          <a class="nav-link" href="#">SAT Home </a>
        </li>
        
        <li class="nav-item active">
          <a class="nav-link" href="SATquiz.php">Test Your Vocab <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://lene626.com/">Lene's Projects</a>
        </li>
       
      </ul>
      <div class="navbar-nav navbar-right" id="welcome">  
      	<?php echo '<p>Hello '.$_SESSION['alias'].'!</p>';?>  
      	<p id="signout"><a href="logout.php"> Sign out</a> </p> </div>
        
    </div>
  </nav>

<header class="header">SAT Vocab Self-Test</header>

<div class="container">
  <div class="item" id="question"> 
    <span id="questionNum"></span><span id="prompt"></span> 
  </div>

  <div class="item" id="choices"> 
    <div class="col">
      <div class='radiosDiv'>
        <div class="radio radio-info radio-inline">
          <input type="radio" name="a" value="" checked />
          <label  id="a" for="a">right def</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="b" value="" />
          <label id="b" for="b">wrong def</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="c" value="" />
          <label id="c" for="c">wrong def</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="d" value="" />
          <label id="d" for="d">wrong def</label>
        </div>
      </div>
    </div>
    <div class="item" id="buttons"> buttons</div>
    <div class="item" id="progress"> progress</div>
  </div>

  

</div>
</body>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<script> 




var username = "<?php echo $_SESSION['username']; ?>";
var dynamicUrl = "getOneWord.php?user=" + username;
var wordsArray = [];
var questions = {}; // {word: ... , answer: ..., choices: {... ... ...}}
var currentQuestion = 1;

// var memUrl = "updateMem.php?user=" + username;
// var hash="";




$(document).ready(function(){

  createQuestion();


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
    var currentWordIndex = window.wordsArray.length - 1;
    console.log("index ", currentWordIndex);
    
    var i = currentWordIndex;
    console.log("i ", i);
    $("#questionNum").html(i+1);
    $("#prompt").html(window.wordsArray[i]['word']);
    var correctAnswer = modifyDef(window.wordsArray[i]['word'], window.wordsArray[i]['definition'] );
    console.log('correctAnswer', correctAnswer);
     $("#a").html(correctAnswer);
    
     
     for (var n = 1; n < 4; n++){
      console.log(n);
      $.get(url, function(data, status){ 

        try {var js = JSON.parse(data);} 
        catch(err) {console.log("error parsing json multiple choices", data);}
        var multChoice = modifyDef(js['word'], js['definition'] );
        console.log("n ", n, "multChoice", multChoice);
        if(n === 1){$("#b").html(multChoice);}
        if(n === 2){$("#c").html(multChoice);}
        if(n === 3){$("#d").html(multChoice);}
      });

     } 

  });
 
}



function modifyDef(word, def){
  return def.replace(new RegExp(word, "i"), "*****");
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
