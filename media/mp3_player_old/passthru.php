<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
 
set_time_limit(0);
$dirPath = "./mp3";
// $songCode = $_REQUEST['c'];
$songCode = 'Bear-Dark';

$filePath = $dirPath . "/" . $songCode . ".mp3";
 
  header('Content-type: audio/mpeg');
    header('Content-length: ' . filesize($track));
    header('Content-Disposition: attachment; filename="'.$songCode.'.mp3"');
    header('X-Pad: avoid browser bug');
    header('Cache-Control: no-cache');
    header("Content-Transfer-Encoding: binary"); 
    header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
    print file_get_contents($track);
  

?>