<?php
session_start();

$site_salt="sitesalt";
$msg = $msgr = $emailin="";

//create or open login database and table users:
$db = new SQLite3('login.db');
$stmt = $db->prepare('create table if not exists users ( username, password, psalt);');
$result = $stmt->execute();

// check if user is logged in and send it to index.php
if(isset($_SESSION['fingerprint'])) {
	header("Location:index.php");
} 

// user entered info in form and post has been set (pressed 'Sign in' button)
if (isset($_POST['login'])) {

	if (isset($_POST['email'])) {
    	$emailin=$_POST['email'];
  	}
	// both email and password are filled
	if (''==$_POST['email'] || ''== $_POST['pass']) {
		$msg= $msg."<h5>Username/Password is empty.</h5>";
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
	    }

	    // user was found at least once - this db keeps older passwords
	    if(0!=$n) {
	    	$salted_hash = hash('sha256',$password.$site_salt.$p_salt);
	    	if($p==$salted_hash) {
		        $_SESSION['username']=$username;
		        //creat session fingerprint using user ip and browser id
		        $fingerprint = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		        $_SESSION['last_active'] = time();
		        $_SESSION['fingerprint'] = $fingerprint;
		        header("Location:index.php");
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
    <br>
    <h1 class="display-4">Log in</h1>
    <br>
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
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $emailin; ?>">
        
        
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
      	<button type="submit" class="btn btn-primary" name="login" value="login">Sign in</button>
      	<br>
      	<small id="emailHelp" class="form-text text-muted"> <a href="register.php">Create account</a> or <a href="resetPass.php">reset password</a></small>
      </div>

    </form>
    </div>


    <!-- Optional JavaScript - jQuery first, then Popper.js, then Bootstrap JS -->
	   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>