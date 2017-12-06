<?php
// login page for SAT practice

session_start();

$site_salt="sitesalt";
$msg = $msgr = $emailin="";

//create or open login database and table users:
$db = new SQLite3('loginSAT.db');
$stmt = $db->prepare('create table if not exists users ( username, password, alias, psalt);');
$result = $stmt->execute();

// check if user is logged in and send it to SATmain.php
if(isset($_SESSION['fingerprint'])) {
	header("Location:SATmain.php");
} 

// user entered info in form and post has been set (pressed 'Sign in' button)
if (isset($_POST['login'])) {

	if (isset($_POST['email'])) {
    	$emailin=$_POST['email'];
  	}
	// both email and password are filled
	if (''==$_POST['email'] || ''== $_POST['pass']) {
		$msg= $msg."<h5>Please complete all fields.</h5>";
	} 
	else 
	{
		$password=$_POST['pass'];

		// check user and password in database
		$stmt = $db->prepare('SELECT * FROM users WHERE username=:id');
		$stmt->bindValue(':id', $_POST['email'], SQLITE3_TEXT);
		$result = $stmt->execute();

		$n=0;
	    while($r=$result->fetchArray()) {
		    $n++;
		    $p=$r['password'];
		    $p_salt=$r['psalt'];
		    $username=$r['username'];
        $alias=$r['alias'];
	    }

	    // user was found at least once - this db keeps older passwords
	    if(0!=$n) {
	    	$salted_hash = hash('sha256',$password.$site_salt.$p_salt);
	    	if($p==$salted_hash) {
		        $_SESSION['username']=$username;
            $_SESSION['alias']=$alias;
		        //creat session fingerprint using user ip and browser id
		        $fingerprint = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		        $_SESSION['last_active'] = time();
		        $_SESSION['fingerprint'] = $fingerprint;
		        header("Location:SATmain.php");
	        } else {
	       		$msg= $msg."<h5>Username/Password is Incorrect.</h5>";
	        }
	    }
      else {$msg= $msg."<h5>Username not found</h5>";}
	}		
}

else{
	// $msg= $msg. "<p> login post not set";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="SAT.css">
  <link href='https://fonts.googleapis.com/css?family=Raleway:800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

     <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">

      <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
    
    <!-- icon awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

    <!-- jQuery dialog box -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>

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
      <li class="nav-item active">
        <a class="nav-link" href="SATmain.php">SAT Home <span class="sr-only">(current)</span></a> </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="SATquiz.php">Test Your Vocab</a> </li>
      <li class="nav-item">
        <a class="nav-link" href="https://lene626.com/">Lene's Projects</a></li>  
    </ul>
      <!-- <div class="navbar-nav navbar-right" id="welcome">   -->
      <!-- <i class="fa fa-user" id="icons" style="font-size:24px; color:#1672ce" ></i>  -->
  </div>
</nav>

  <header>SAT Vocabulary</header>

<div class="container"> 

      <div class="item">
        <p>Practice with a vocabulary of nearly 1000 words. </p>
        <p>Sign in to get started!</p>
      </div>
</div>
<div class="container">
    <?php 
     // echo "<p> post:";
     // echo "<p> ".json_encode($_POST); 
     // echo "<p> get:";
     // echo "<p> ".json_encode($_GET);s

     echo "<p> " .$msg ."<p>";
      ?>
    
	  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="login-form" autocomplete="off">
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $emailin; ?>">
      </div>
      <div class="form-group">
        <label for="key" class="sr-only">Password</label>
        <input type="password" name="pass" class="form-control" id="pass1" placeholder="Password">
      </div>

      <!-- Need to add here a function that saves email and password -->
      <!--
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input">Remember me (not working)</label>
	  -->
      <div class="form-group">
      	<button type="submit" class="btn btn-primary" name="login" value="login" style="background-color: #0e83a0">Sign in</button>
      	<br>
        <br>
      	<small id="emailHelp" class="form-text text-muted"> <a href="register.php">Create a new account</a> or <a href="resetPass.php">reset password</a></small>
      </div>

    </form>
</div>



    <!-- Optional JavaScript - jQuery first, then Popper.js, then Bootstrap JS -->
	   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>