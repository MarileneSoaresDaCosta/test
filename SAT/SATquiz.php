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
    <link rel="stylesheet" type="text/css" href="SAT.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
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

<style>
/*<?php 
// readfile("SAT.css");
/**/?>*/
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
        <li class="nav-item">
          <a class="nav-link" href="SATmain.php">SAT Home </a>
        </li>
        
        <li class="nav-item active">
          <a class="nav-link" href="SATquiz.php">Test Your Vocab <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://lene626.com/">Lene's Projects</a>
        </li>
       
      </ul>
      <div class="navbar-nav navbar-right" id="welcome">  
      	<?php echo 'Hello '.$_SESSION['alias'].'! ';?>  
      	<div id="signout"><a href="logout.php"> Sign out</a> </div> </div>
        
    </div>
  </nav>

<!-- <header class="header">SAT Vocab Self-Test</header> -->

<div class="container">
  <div class="item" id="header">SAT Vocab Self-Test</div>
  <div class="item" id="question"> 
    <span id="questionNum"></span><span id="prompt">Press next to start</span> 
  </div>

  <div class="item" id="choices" style="visibility: hidden;"> 
    <div class="col">
      <form id="choicesForm">
      <div class='radiosDiv'>
        <div class="radio radio-info radio-inline">
          <input type="radio" name="answer" value="1"  />
          <label  id="a" for="a"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="2" />
          <label id="b" for="b"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="3" />
          <label id="c" for="c"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="4" />
          <label id="d" for="d"></label>
        </div>
      </div>
    </form>
    </div>
  </div>

  <div class="item" id="buttonsQ"> 
      <button type="button" class="button pull-right" id="next" style="visibility: visible;">Next</button>
      <button type="button" class="button pull-right" id="check" style="visibility: hidden;">Check</button>
  </div>

  <div class="item" id="grading"></div>
  
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
var dynamicUrl = "getQuestion.php?user=" + username;
var wordsArray = [];
var question = [];
var countQ = 0;
var quiz= [];
var shuffleChoices = [];





$(document).ready(function(){
  // createQuestion(dynamicUrl);
  // next();
  
  $("#check").click(function(){
    console.log("check pressed");
    check();
  });

  $("#next").click(function(){
   next();
  });


}); // end of document ready

function next(){
  console.log("next pressed");
  createQuestion(window.dynamicUrl);
  $("#grading").css("visibility","hidden");
}

function modifyDef(word, def){
  // var trimmedWord = word.substring(0, word.length - 1);
  // return def.replace(new RegExp(trimmedWord, "i"), "*****");
  return def.replace(new RegExp(word, "i"), "_______________");
}

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;
  // While there remain elements to shuffle...
  while (0 !== currentIndex) {
    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}







function createQuestion(url){
  console.log("createQuestion fn", url);
  $.get(url, function(data, status){ 
    clearPreviousAnswer();
    console.log(url, data.length);
    try {
        var js = JSON.parse(data);
        console.log('js',js);
      }
      catch(err) {
        console.log("error parsing json", data);
      }
    for (var vocab of js){
      window.wordsArray.push(vocab);
    }
    var q = wordsArray.length - 4;
    console.log("q", q);
    console.log('wordsArray',wordsArray[q], wordsArray[q+1],wordsArray[q+2],wordsArray[q+3]);

    // populating the question array
    window.question = [{
                    prompt: wordsArray[q]['word']
                    , 
                    choices: [
                          modifyDef(wordsArray[q]['word'],wordsArray[q]['definition']),
                          modifyDef(wordsArray[q+1]['word'],wordsArray[q+1]['definition']),
                          modifyDef(wordsArray[q+2]['word'],wordsArray[q+2]['definition']),
                          modifyDef(wordsArray[q+3]['word'],wordsArray[q+3]['definition']),
                        ],
                    modcorrectAnswer: modifyDef(wordsArray[q]['word'],wordsArray[q]['definition']),
                    correctAnswer: wordsArray[q]['definition']
                  }];

    var choicesStack = [];
    for (var choice of question[0]['choices']){
      choicesStack.push(choice);
    }

    $("#prompt").html(question[0]['prompt']);
    $("#questionNum").html(window.quiz.length + 1);
    window.shuffleChoices = shuffle(choicesStack);

    $("#a").html(shuffleChoices[0]);
    $("#b").html(shuffleChoices[1]);
    $("#c").html(shuffleChoices[2]);
    $("#d").html(shuffleChoices[3]);
    q = q + 4
    // console.log(window.countQ);
    var obj = {};
    obj[countQ] = question[0];
    window.quiz.push(obj);
    console.log('quiz length', window.quiz.length);
    $("#choices").css("visibility","visible");
    $("#check").css("visibility","visible");
    // $("#next").css("visibility","hidden");
    

  });
  
}

function check(){
  var selected = $('input[name=answer]:checked', '#choicesForm').val();
  console.log("choice selected", selected);
  var correctAnswerVal = "0";

  if(window.shuffleChoices[0] === window.question[0]['modcorrectAnswer']){
    $("#a").html(window.question[0]['correctAnswer']);
    $("#a").css("font-weight","Bold").css("color", "green");
    correctAnswerVal = "1";
  }

  if(window.shuffleChoices[1] === window.question[0]['modcorrectAnswer']){
    $("#b").html(window.question[0]['correctAnswer']);
    $("#b").css("font-weight","Bold").css("color", "green");
    correctAnswerVal = "2";
  }

  if(window.shuffleChoices[2] === window.question[0]['modcorrectAnswer']){
    $("#c").html(window.question[0]['correctAnswer']);
    $("#c").css("font-weight","Bold").css("color", "green");
    correctAnswerVal = "3";
  }
  
  if(window.shuffleChoices[3] === window.question[0]['modcorrectAnswer']){
    $("#d").html(window.question[0]['correctAnswer']);
    $("#d").css("font-weight","Bold").css("color", "green");
    correctAnswerVal = "4";
  }

  $("#check").css("visibility","hidden");
  $("#next").css("visibility","visible");

  var grade = "";
  if (selected === correctAnswerVal){
    grade = "well done!";
  } else {
    grade = "oops";
  }
  
  $("#grading").html(grade);
  $("#grading").css("visibility","visible");
}


function clearPreviousAnswer() {
   $("input").prop("checked", false);
    $("#a").css("font-weight","normal").css("color", "black");
    $("#b").css("font-weight","normal").css("color", "black");
    $("#c").css("font-weight","normal").css("color", "black");
    $("#d").css("font-weight","normal").css("color", "black");
    $("#next").css("visibility","hidden");
}

</script>

</html>
