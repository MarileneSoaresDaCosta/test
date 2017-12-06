<!DOCTYPE html>
<html>
<head>
    <title>testing quiz format</title>
    
   
  
   


</head>
<body>

<form>
  <input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other  
</form> 

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

