<?php

$user = "";

if (isset($_GET["user"])){
	$user = $_GET["user"];
}


$fileName = "users/".$username."/memList.txt";	

if(file_exists($fileName)){
	$updateFile = file_put_contents($fileName, $hash);
	}



?> 