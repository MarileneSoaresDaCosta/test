<?php
 
error_reporting(E_ALL); ini_set('display_errors', 1);

$user = isset($_GET["user"]) ? $_GET["user"] : "" ;
 
if(strlen($user) < 1  ){
 // echo "user not set"."<br>";
  die(); 
}

$fileName = "users/".$user."/memList.txt";	
 
$count = 0;
$fp = fopen( $fileName, 'r');
 

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


$arr = array("count" => $count, "filename"=>$fileName);
echo json_encode($arr);
//Get number of lines - alternative way
//$totalLines = intval(exec("wc -l '$fileName'"));
//echo "comm line".$totalLines;





?>