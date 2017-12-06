<!DOCTYPE html>
<html>
<head>
    <title>testing quiz format</title>
    <link rel="stylesheet" type="text/css" href="SATquiz.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>


<header class="header">SAT Vocab Self-Test</header>

<div class="container">
  <div class="item" id="question"> 
    <span id="questionNum"></span><span id="prompt"></span> 
  </div>

  <div class="item" id="choices"> 
    <div class="col">
      <div class='radiosDiv'>
        <div class="radio radio-info radio-inline">
          <input type="radio" name="answer" value="" checked />
          <label  id="a" for="a"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="" />
          <label id="b" for="b"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="" />
          <label id="c" for="c"></label>
        </div>
        <div class="radio radio-info radio-inline">
          <input  type="radio" name="answer" value="" />
          <label id="d" for="d"></label>
        </div>
      </div>
    </div>
    <div class="item" id="buttons"> buttons</div>
    <div class="item" id="progress"> progress</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




<script> 
function modifyDef(word, def){
  return def.replace(new RegExp(word, "i"), "*****");
}

var wordsArray = [{
	word: "abase", 
	definition: "(v.) to humiliate, degrade (After being overthrown and abased, the deposed leader offered to bow down to his conqueror.)", 
	hash: "0991ee3bec8e33b806548f36d4091469c1b142f9e0ea26bb5ddaf764b1e2a620"
  }, {
	word: "abate", 
	definition: "(v.) to reduce, lessen (The rain poured down for a while, then abated.)", 
	hash: "97ae0556f16aa1219d37e74e2bd46044d1951d82f06558e3c3345e266db51507"
  }, {
  	word: "abdicate", 
  	definition: "(v.) to give up a position, usually one of leadership (When he realized that the revolutionaries would surely win, the king abdicated his throne.)",
  	hash: "61fa22590e4d96ee7bb36e5115c8c7b30280b00199cbc753a2f0a1e529f1d473"
  },{
  	word: "abduct", 
  	definition: "(v.) to kidnap, take by force (The evildoers abducted the fairy princess from her happy home.)", 
  	hash: "fa4a8930bb2f39ed2c35be66ed9b9141c663c180d0f0404dfac5d0a1d068d1c3"
  }];



// console.log(wordsArray[0]['word']);

var question = [{
    prompt: wordsArray[0]['word']
    , 
    choices: [
	    		modifyDef(wordsArray[0]['word'],wordsArray[0]['definition']),
	    		modifyDef(wordsArray[1]['word'],wordsArray[1]['definition']),
	    		modifyDef(wordsArray[2]['word'],wordsArray[2]['definition']),
	    		modifyDef(wordsArray[3]['word'],wordsArray[3]['definition']),
    		],
    correctAnswer: wordsArray[0]['definition']
  }];

// checking how to refer to elements in the question
console.log('prompt', question[0]['prompt']); // abase
console.log('correctAnswer', question[0]['correctAnswer']); // def of abase
console.log('choice 0', question[0]['choices'][0]); 
console.log('choice 1', question[0]['choices'][1]); 
console.log('choice 2', question[0]['choices'][2]); 
console.log('choice 3', question[0]['choices'][3]); 

// assigning random positions

// creates a stack of choices from which to pop randomly
var choicesStack = [];
for (var choice of question[0]['choices']){
	choicesStack.push(choice);
}
console.log('stack', choicesStack);
$("#prompt").html(question[0]['prompt']);


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

var shuffleChoices = shuffle(choicesStack);


$("#a").html(shuffleChoices[0]);
$("#b").html(shuffleChoices[1]);
$("#c").html(shuffleChoices[2]);
$("#d").html(shuffleChoices[3]);

var quiz = [];
var obj = {};
var count = 1;
obj[count] = question[0];
quiz.push(obj);
// console.log(quiz[0]);
var str = 'test';
count += 1;
var obj = {};
obj[count] = str;
quiz.push(obj);

console.log(quiz[0]);

console.log(quiz[1]);

</script>
</html>


