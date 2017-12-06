<?php

$user = isset($_GET["user"]) ? $_GET["user"] : "" ;

  
if(strlen($user) < 1  ){
 // echo "user not set"."<br>";
  die(); 
}

$fileName = "users/".$user."/memList.txt";

$inputStr = file_get_contents('SATvocabHashed.txt');


if(file_exists($fileName)){
	$memList = file_get_contents($fileName);
}
else{
	// create memList in user dir
	$newMemFile = fopen($fileName, "w");
	$memList = "";
	fwrite($newMemFile, $memList);
}

$memArray = explode("\n",$memList);


// echo json_encode($memArray)."<br>";


// echo $inputStr;

// convert str into array 
$vocabArray = explode("\n",$inputStr);

// echo json_encode($vocabArray);

$outArray =array();
// activate this only for tests - reduces the number of words
// $n = 0;

// generating a random subset less than +- 20% (r<1) without using 'rand_array' - avoids repetition
foreach ($vocabArray as $key => $value) {
	// echo $key."<br>";
	// echo $value."<br>";
	$row = json_decode($value, true);
	// echo $row["hash"]." ".$row["word"]."<br>";
	$r = rand(0, 10);
	// echo $r."<br>";
	if($r > 1){
		continue;
	}
	// echo $r."<br>";
	if($row != ""){
		array_push($outArray, $row);
	}
	// activate this only for tests - reduces the number of words
	// if($n>1){ break;}
	// $n++;
}

// print_r($outArray);

// checks if a word has been 'memorized'
function wordInMemList($memArray,$hash){
	foreach ($memArray as $key => $value) { 
		if ($value == $hash){
			return true;
		}
	}
	return false;
}


$nonMemWords = array();
// generates array with words that have not been memorized - input for SATmain.php
foreach ($outArray as $key => $value) {
	// echo $key."<br>";

	if(wordInMemList($memArray,$value['hash'])){ continue; }	
	
	// echo json_encode($value)."\n";
	// foreach ($value as $k => $v) {
	// echo $k." : ". $v. "<br>";
	// }
	array_push($nonMemWords, $value);


}

// print_r($nonMemWords);
// echo "size of nonMemWords ".sizeof($nonMemWords)."<br>";


$wordKey= array_rand($nonMemWords, 1); 
// echo  "random key ".$wordKey."<br>";

echo json_encode($nonMemWords[$wordKey])."\n";



?>