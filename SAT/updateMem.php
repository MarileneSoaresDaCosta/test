<?php

$user = isset($_GET["user"]) ? $_GET["user"] : "" ;
$hash = isset($_GET["hash"]) ? $_GET["hash"] : "";

  
if(strlen($user) < 1  ){
 // echo "user not set"."<br>";
  die(); 
}

$fileName = "users/".$user."/memList.txt";	
// echo $hash;
// previous version, without checking for repeated words:
// if(file_exists($fileName)){
// 	if(strlen($hash) > 3) $updateFile = file_put_contents($fileName, $hash."\n", FILE_APPEND);
// 	}
$message = "";

if(file_exists($fileName) && strlen($hash) > 3 ){
	// test if hash is already in file
	$memList = file_get_contents($fileName);
	$memArray = explode("\n",$memList);
	
	if(!wordInMemList($memArray,$hash)){
		$updateFile = file_put_contents($fileName, $hash."\n", FILE_APPEND);
	} else {
		// echo 'word in list <br>';
		$message = "This word is already in your list";
	}
}


$count = 0;
// $fp = fopen( $fileName, 'r');
// echo $fileName."<br>";

 

$handle = fopen($fileName, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if(strlen($line)> 2) $count++;
        // process the line read.
    }

    fclose($handle);
} else {
    // error opening the file.
} 

//echo "count".$count."<br>";


$arr = array("count" => $count,  "message"=> $message);

echo json_encode($arr);

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