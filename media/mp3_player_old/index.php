<?php
function dirToArray($path, $dir = '')
{
  $path = (!empty($path)) ? rtrim($path, '/') . '/' : $path;
  $dir = (!empty($dir)) ? rtrim($dir, '/') . '/' : $dir;
  $path = $path . $dir;
  $list = array();

  $d = dir($path);
  while (false !== ($entry = $d->read()))
  {
    $file = new SplFileInfo($path . $entry);
    if (substr($file->getFilename(), 0, 1) == '.')
    {
      continue;
    }

    if ($file->isDir())
    {
      if (empty($list[$file->getFilename()]))
      {
        $list[$file->getFilename()] = array();
      }
      $list[$file->getFilename()] = &dirToArray($path, $file->getFilename());
    }
    else
    {
      $list[] = $file->getFilename();
    }
  }

  return $list;
}


function GetBasePath() { 
    return substr($_SERVER['SCRIPT_FILENAME'], 0, strlen($_SERVER['SCRIPT_FILENAME']) - strlen(strrchr($_SERVER['SCRIPT_FILENAME'], "\\"))); 
} 


$dir    = 'mp3';
$result = array();
$n=0;

$out="";
$outf="";
   $cdir = scandir($dir);

   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $value;
            //echo("<a href='nf/".$value."'>".$value."</a><br>");
            if(  substr($value, -3) =="mp3"  )
            { 
$v = rawurlencode($value);
$bb=base64_encode($value);
$n++;


//$outf.= "m.php?file=".$v." ".$bb."\n";
$outf.= "mp3/".$v."\n";

$url="m.php?file=".$v;
        //    $out.=('<li audiourl="'.$url.'" cover="cover2.jpg" artist="Artist 2">'.$value.'</li>');
            
               
          }

         }
      }
   } 



//echo $out;
$myfile = fopen("a.m3u", "w");
fwrite($myfile,$outf);
fclose($myfile);











?>
<!DOCTYPE html>
<html>

    <head>
        <title>nf</title>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <style>
        html, body, #map {
            display:block;
        
 margin:0px;
background-color: #000;
 overflow: hidden;
 
 font-family: Gill Sans,Gill Sans MT,Calibri,sans-serif;  
  font-style: normal;
  font-variant: normal;
  font-weight: 100;
  font-size: 12px;

}
#xy {
  padding:6px;
color: #000;
text-shadow: 0px 0px 2px  #fff;
}

#im {
  width: 100%;
  height: 100%;
  margin:0px;
  text-align: center;
}
.img {
  position: relative;
 display: inline-block;
  @include translateX(-0%);
 
}



.cont {
 width: 100%;
  height: 100%;
  background-color: #515;
}


.fillwidth { 
  width: 90%; 
  height: auto; 
}
.fillheight { 
  height: 100%; 
  width: auto; 
}





/* HTML5 Audio player with playlist styles */
.example {

 
    margin: 20px auto 0;
    width: 640px;
}
.player {
    background: transparent url("winamp.png") no-repeat scroll left top;
    
    height: 232px;
    position: relative;
    width: 600px;
    z-index: 2;
}

.title {
  -webkit-box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
    position: absolute;
    padding:4px 4px 4px 10px;
    left: 212px;
    color: #00ee33;
    font-size: 12px;
    top: 42px;
    width: 308px;
    overflow: hidden;
    height: 54px;
    background-color: #222;
}





.remtime {
    font-size: 48px;
    text-align: right ;
  -webkit-box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
box-shadow: inset 3px 3px 5px 0px rgba(0,0,0,0.75);
    position: absolute;
    padding:4px 14px 4px 10px;
    left: 21px;
    color: #00ee33;

    top: 42px;
    width: 160px;
    overflow: hidden;
    height: 78px;
    background-color: #000;
}

.pl {
    background: transparent url("winampcontrols.png") no-repeat scroll -480px -114px;
 
    cursor: pointer;
    height: 24px;
    left: 480px;
    position: absolute;
    top: 114px;
    width: 48px;
}
.pl:hover {
     background-position: -480px -348px;
 
}
.cover {
    /*background: transparent url("cover1.jpg") no-repeat scroll center top;*/
    border-radius: 5px 5px 5px 5px;
    height: 94px;
    left: 20px;
    position: absolute;
    top: 20px;
    width: 94px;
}
.controls {
    background: #fdf;
    cursor: pointer;
    height: 36px;
    left: 32px;
    position: absolute;
    top: 175px;
    width: 230px;
  
}
.controls .play, .controls .pause, .controls .rew, .controls .fwd , .controls .stop
{
    background: transparent url("winampcontrols.png") no-repeat scroll 0 0;
    float: left;
    height: 100%;
    width: 20%;
}

 
 .shuffle {
  height: 32px;
    left: 330px;
    position: absolute;
    top: 176px;
    width: 90px;
 
   background:  url("winampcontrols.png") no-repeat scroll 0 0;
    background-position: -330px -176px;
}
 .shuffle:hover {
    background-position: -330px -407px;
}

.shuffleled{
  height: 4px;    
  width: 6px;
  position: absolute;
  left: 342px;
  top: 188px;
   background: rgba(0,255,200,0.8);
}

.repeat {
  height: 32px;    
  width: 60px;
  position: absolute;
  left: 420px;
  top: 176px;

  background:  url("winampcontrols.png") no-repeat scroll 0 0;
    background-position: -420px -176px;
}
 .repeat:hover {
    background-position: -420px -407px;
}

.repeatled{
  height: 4px;    
  width: 6px;
  position: absolute;
  left: 12px;
  top: 12px;
   background: rgba(0,255,200,0.8);
}


.controls .rew {
    background-position: -32px -176px;
}
.controls .play {
    background-position: -76px -176px;
}
.controls .pause {
    background-position: -122px -176px;
 
}.controls .stop {
    background-position: -170px -176px;
 
}
.controls .fwd {
    background-position: -214px -176px;
}


.controls .rew:hover {
    background-position: -32px -407px;
}
.controls .play:hover {
    background-position: -76px -407px;
}
.controls .pause:hover {
    background-position: -122px -407px;
}.controls .stop:hover {
    background-position: -170px -407px;
}

.controls .fwd:hover {
    background-position: -214px -407px;
}
.hidden {
    display: none;
}
.controls .visible {
    display: block;
}
.volume {
    height: 14px;
    left: 214px;
    position: absolute;
    top: 116px;
    width: 108px;
}
.tracker {
   /*background: transparent url("spr.png") no-repeat scroll 5px -220px;*/
  
	color: #fff;
    height: 15px;
    left: 32px;
    position: absolute;
    top: 142px;
    width: 442px;
}

.remtime1 {
	color: #0f4;
    height: 60px;
    left: 80px;
    position: absolute;
    top: 40px;
    width: 585px;
    font-size: 48px;
}
.ui-slider-range {
    /*background: transparent url("spr.png") no-repeat scroll 5px -220px;*/
    height: 100%;
    position: absolute;
    opacity:0.4;
    top: 0;
}
.ui-slider-handle {
   background: url("winampcontrols.png") no-repeat scroll -258px -116px rgba(0, 0, 0, 0);
  
    cursor: pointer;
    height: 10px;
    margin-left: 0px;
    position: absolute;
    top: 0px;
    width: 10px;
    z-index: 2;
}


.tracker .ui-slider-handle {
    background: url("winampcontrols.png") no-repeat scroll -269px -143px rgba(0, 0, 0, 0);
    height: 22px;
    width: 54px;
}
.volume .ui-slider-handle {
    background: url("winampcontrols.png") no-repeat scroll -258px -116px rgba(0, 0, 0, 0);
    height: 22px;
    width: 28px;
}
.playlist {
  cursor:pointer;
    color: #0F6;
    width:600px;
    height:420px;

    list-style-type: none;
    margin: 0px 0 0 0px;
  
    padding : 0px;
 

    z-index: 1;
    overflow-y: scroll; overflow-x: hidden;

 

}
 
.playlist::-webkit-scrollbar { 
    display: none; 
}


.song {
  border-bottom-color: rgb(225, 232, 237);
border-bottom-style: solid;
border-bottom-width: 1px;
color: rgb(41, 47, 51);
background-color: rgb(255, 255, 251);
cursor: pointer;
display: block;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: 40px;
line-height: 18px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
min-height: 36px;
padding-bottom: 9px;
padding-left: 12px;
padding-right: 12px;
padding-top: 9px;
position: relative;
text-align: start;
width: 520px;
}

.songname {
 
color: rgb(41, 47, 51);
cursor: auto;
display: inline;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
height: auto;
line-height: 18px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
text-align: start;
width: auto;
-webkit-locale: "en";
color: rgb(41, 47, 51);
cursor: pointer;
display: block;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
font-weight: 200;
height: 36px;
line-height: 18px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
margin-bottom: 0px;
margin-left: 60px;
margin-right: 0px;
margin-top: 0px;
text-align: start;
white-space: pre-wrap;
word-wrap: break-word;
}


.artist {
 
color: rgb(241, 47, 51);
cursor: auto;
display: inline;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;
font-weight: 600;
height: auto;
line-height: 18px;
list-style-image: none;
list-style-position: outside;
list-style-type: none;
text-align: start;
width: auto;
-webkit-locale: "en";
color: rgb(41, 47, 51);
cursor: pointer;
display: block;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 14px;


list-style-image: none;
list-style-position: outside;
list-style-type: none;
margin-bottom: 0px;
margin-left: 60px;
margin-right: 0px;
margin-top: 0px;
text-align: start;
white-space: pre-wrap;
word-wrap: break-word;
}



.playing{

       background-color: #dff;
}




    </style>

    <script src="jquery.js"></script>    <script src="jui.js"></script>
  



<body>




  <div class="example">

        <div class="player">
            <div class="pl"></div>
            <div class="title"></div>
           
            <div class="cover"></div>
            <div class="controls">
            	  <div class="rew"></div>
                <div class="play"></div>
                <div class="pause"></div>
                <div class="stop"></div>
                <div class="fwd"></div>   

            </div>
            <div class="shuffle"></div>
            <div class="shuffleled"> </div>
            <div class="repeat"> <div class="repeatled"> </div></div>
            
            <div class="volume"></div>
            <div class="tracker"></div> 
            <div class="remtime"></div> 

        </div>

        <ol class="playlist hidden">



        </ol>
    </div>

<!-- <div id="scrollbar_container">  
    <div id="scrollbar_track"><div id="scrollbar_handle"></div></div>  
    <div id="scrollbar_content">...</div>  
</div>  
 -->

</body>



<script>


var n=1;
nmax=0;
nprev=0;
nwait=0;
 
disp=0;
var fdall = new Array();
var songseq = new Array();
cc=5;
delay=12;
var started=0;
var song;
var songname="=======";
var prevsong;
var tracker = $('.tracker');
var volume = $('.volume');
var volumecurrent=0.2;
var loaded=0;
var current=0;
var currentid="";
var scrollpos=0;
var repeatmode=1;
var shufflemode=0;
var prevscroll = 0;
$(function(){
 
$('.play').click(function (e) {e.preventDefault();playAudio();});
$('.pause').click(function (e) {e.preventDefault();stopAudio();});
$('.stop').click(function (e) {e.preventDefault();stopAudio();});
$('.fwd').click(function (e) {e.preventDefault();nextPlay();});
$('.rew').click(function (e) {e.preventDefault();clog("rew");rew();});
$('.repeat').click(function (e) {e.preventDefault();changeRepeat();});
$('.shuffle').click(function (e) {e.preventDefault();changeShuffle();});
$(document).keydown(function(e) {
    switch(e.which) {
        case 37: // left
        rew();
        break;

        case 38: // up
        changevol(1) ;
        break;

        case 39: // right
        disp=1;
        nextPlay();
        break;

        case 40: // down
        changevol(-1);
        break;

        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});


    volume.slider({  range: 'min',min: 1, max: 100,step:0.1, value: 20,start: function(event,ui) {},slide: function(event, ui) {volumecurrent = ui.value / 100;},stop: function(event,ui) {},});

    // empty tracker slider
    tracker.slider({ range: 'min',min: 0, max: 100,step:0.05, start: function(event,ui) {},slide: function(event, ui) { song.currentTime = ui.value; },stop: function(event,ui) {}  ,    });

     //    $( document ).bind( "tap", function ( event ){touchX = event.pageX;touchY = event.pageY; if (touchX <160){prevplay()} if (touchX >160){disp=1;nextplay()}});});



$.get('a.m3u',function(data){

  var perLine=data.split('\n');
  clog(""+ perLine.length+ " lines");

  nn=0;
  for(i=0;i<perLine.length;i++)
  {
    nn++;
    var line=perLine[i].split(' ');
    pp=line[0];
    //pn=d64(line[1]);
    fdall.push(""+i+": "+pp);
    title=decodeURI(pp);
    res = decodeURI(pp).split("/");
    if (res.length >1) resarr = res[1].split("-");
    if (resarr.length >1)  
      {  
        dotPosition = resarr[1].indexOf(".mp");
       title = '<div class="artist">'+ resarr[0] +'</div><div class="songname">' + resarr[1].substring(0, dotPosition).trim()+ '</div>';
      // clog(title);
     }

    if (res) res1=res[1];
     $('.playlist').append('<div class="song" id="song' + i + '"  audiourl="'+pp+'"  songname="'+decodeURI(pp)+'"  onclick="playthis(' + i + ');">'+title+'</div>');
   
  }

  loaded++;
});

$(".playlist").scroll(function (event) {
    scrollpos = $(".playlist").scrollTop();
});


 setTimeout(init,50); 



});

function playthis(i){
  clog("i"+ i);
  stopAudio();
    var next=$('#song'+i);
  initAudio(next);
  playAudio();
}


function changevol(n){
  step=song.volume/10+0.01;

 volumecurrent= song.volume+n*step;
 
  clog("" + step +" " + volumecurrent)
if (volumecurrent<0) volumecurrent=0;
if (volumecurrent>1) volumecurrent=1;
 song.volume=volumecurrent ;
 volume.slider('value', song.volume*100);
}


function changeRepeat(i){

repeatmode++;

if (repeatmode>2) repeatmode=0;


}

function changeShuffle(i){

  shufflemode++;
if (shufflemode>2) shufflemode=0;



}


function setdisp(){

if (repeatmode==0)$('.repeatled').css( "background" , 'rgba(0,255,200,0.1)');  
if (repeatmode==1)$('.repeatled').css( "background" , 'rgba(0,255,200,0.8)');  
if (repeatmode==2)$('.repeatled').css( "background" , 'rgba(255,0,0,0.8)');  
if (shufflemode==0)$('.shuffleled').css( "background" , 'rgba(0,255,200,0.0)');  
if (shufflemode==1)$('.shuffleled').css( "background" , 'rgba(0,255,200,0.8)');  
if (shufflemode==2)$('.shuffleled').css( "background" , 'rgba(255,0,0,0.8)'); 

setTimeout(setdisp,200); 

}



 function d64(s) {
  if (!s ) return s;
    var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
    var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    for(i=0;i<64;i++){e[A.charAt(i)]=i;}
    for(x=0;x<L;x++){
        c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
        while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
    }
    return r;
};


function init(){

  if (loaded==1){
  currentid='#song1';
  initAudio($(currentid));

 song.volume=volumecurrent ;
  loaded++;
      $('.pl').click(function (e) {
        e.preventDefault();
        $('.playlist').fadeIn(300);
    });

    // playlist elements - click
    $('.playlist div').click(function () {

    });

   $('.playlist').fadeIn(300);
  }

  for (var i=0; i< fdall.length ;  i++) {
   songseq.push(i);
  };

shuffle();
setdisp()
}



function shuffle()
{
  var nsongs=fdall.length;
  // clog("number"+ nsongs);
  o=songseq;
  // clog(songseq);
   for(var i=0 ; i < o.length; i++)
    {
      j = Math.floor(Math.random() * nsongs) ;
      var step=(i+j)%nsongs;
      var tmp=o[i];
      o[i]=o[step];
      o[step]=tmp;

        loaded=2;
}
  // clog( o);
  
songseq=o;
// clog(o);
}




 
function rew()
{
  stopAudio();
  current--;
  if (current< 1) current= fdall.length-1 ;
  var next=$('#song'+songseq[current]);
  initAudio(next);
  playAudio();
   scrollto(current);
}


function scrollto(seq )
{

var a=songseq[seq];
var container = $('.playlist');
var     scrollTo = $('#song'+a);
var h= $('.playlist').height();
 
var scrollpos = scrollTo.offset().top - container.offset().top + container.scrollTop()-h*0.4;
container.animate({scrollTop: scrollpos}, 200);
 
}


function initAudio(elem) 
{
  var url = elem.attr('audiourl');
  var title = elem.attr('songname');
  var cover = elem.attr('cover');
  var artist = elem.attr('artist');

  if (typeof title != 'undefined' ){
  title = title.replace(/%20/g, " ");
  title = title.replace(/%26/g, "-");
  $('.player .title').text(title);
  $('.player .artist').text(artist);
  }

  song = new Audio('' + url);
   song.volume=volumecurrent ;
  $('.playlist div').removeClass('playing');elem.addClass('playing');
  song.addEventListener('error', function(event) {nextsong(); }, true);
  song.addEventListener('ended',function (){

   if (repeatmode==1) nextsong();
   if (repeatmode==2) {
  song.currentTime = 0;
  song.play();
 }

  });
  song.addEventListener('timeupdate',function (){updatedisplay(); });

}



function updatedisplay() {
   var curtime = song.currentTime
   duration1=1000;
     if (( song.duration != tracker.slider("option", "max")) && (song.duration)>0  )   
     {
             tracker.slider("option", "max", song.duration); 
             clog("setmax"+ tracker.slider("option", "max"))
             duration1=song.duration;

     } 
     tracker.slider('value', curtime);
      song.volume=volumecurrent ;
     volume.slider('value', song.volume*100);
    var rem = 0;
    if(  curtime > 0 )
    {
      rem = song.duration-curtime;
    }   
    var remsec=rem%60;
    var remmin=(rem-remsec)/60;  
    $('.remtime').html('-'+zeroPad(Math.floor(remmin), 2)+':'+zeroPad(Math.floor(remsec), 2)); 
 
}


function playAudio() {
  song.play();

}

function nextPlay() {
nextsong();
// song.currentTime = song.duration-.01;
//  song.play();
}



function nextsong()
{
 stopAudio();
  current++;
  if (current> (fdall.length-1)) current=0;
  clog("curr "+ songseq[current]);
  //var next = $('.playlist li.active').next();
  prevplay=currentid;
  currentid='#song'+songseq[current];
  var next=$(currentid);
    started=0;
  initAudio(next);
  song.play();
    scrollto(current);
 
}









function stopAudio() {song.pause();}


function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}




 
function clog(d){console.log(d);}

function domove(){setTimeout(domove,50); }




</script>


