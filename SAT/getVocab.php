<?php
$user = "";
$debug = isset($_GET["debug"])? 1 : 0 ;

if (isset($_GET["user"])){
	$user = $_GET["user"];
}

echo $user."<br>";

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

if($debug>0) {
	echo $fileName."<br>";
	echo json_encode($memArray)."<br>";
}

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
	if($r > 1){
		continue;
	}
	if($row != ""){
		array_push($outArray, $row);
	}
	// activate this only for tests - reduces the number of words
	// if($n>20){ break;}
	// $n++;
}

foreach ($outArray as $key => $value) {
	// echo $key."<br>";

	if(wordInMemList($memArray,$value['hash'])){ continue; }
	if($debug == 0)	echo json_encode($value)."\n";
	foreach ($value as $k => $v) {
	if($debug == 1)	 echo $k." : ". $v. "<br>";
	
	}
}
// checks if a word has been 'memorized'
function wordInMemList($memArray,$hash){
	foreach ($memArray as $key => $value) { 
		if ($value == $hash){
			return true;
		}
	}
	return false;
}

?>