<?php

$msg = $msgr = $emailin="";
$site_salt="sitesalt";
$db = new SQLite3('login.db');
$stmt = $db->prepare('create table if not exists users ( username, password, psalt);');
$result = $stmt->execute();


if(isset($_POST['register']))
{
   $valid=1;
   if(!isset($_POST['email']) || !isset($_POST['pass']))
   {
     $msgr="Please enter valid email and password.";
     $valid=0;
   }
   if (1==$valid){
	   if(''==$_POST['email'] || ''==$_POST['pass'])
	   {
	     $msgr="Please enter valid email and password.";
	    $valid=0;
	   }
   }

 

    if(1==$valid)
    {
	   $stmt = $db->prepare("SELECT *  FROM users WHERE username=:uname");
	   $stmt->bindValue(':uname', $_POST['email'], SQLITE3_TEXT);
	   $result = $stmt->execute();
 
      if($result->fetchArray() ){
        $msgr="Email exists, Please enter another valid email.";
        $valid=0;
      }
    }

    if(1==$valid){
        $email = $_POST['email'];
	    $p_salt = rand_string(20); /* http://subinsb.com/php-generate-random-string */
	    $salted_hash = hash('sha256', $_POST['pass'].$site_salt.$p_salt);
		$smt = $db->prepare("insert into users ( username, password, psalt) values 
		  (:email, :pass, :psalt)");
		$smt->bindValue(':email', $email , SQLITE3_TEXT);
		$smt->bindValue(':pass', $salted_hash, SQLITE3_TEXT);
		$smt->bindValue(':psalt', $p_salt, SQLITE3_TEXT);
		$smt->execute();
	    $msgr="Successfully Registered.";
      header("Location:login21.php");
	 }
}

function rand_string($length) {
  $str="";
  $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $size = strlen($chars);
  for($i = 0;$i < $length;$i++) {
   $str .= $chars[rand(0,$size-1)];
  }
  return $str; /* http://subinsb.com/php-generate-random-string */
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
	    <h1 class="display-4">Register</h1>
	    <br>
	    <?php 
	      // echo "<p> ".json_encode($_POST); 
     		// echo "<p> ".json_encode($_GET);
	      ?>
	    
	    <form  id="register-form" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	      <div class="form-group">
	        <label for="email" class="sr-only">Email</label>
	        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" >      
	      </div>

	      <div class="form-group">
	        <label for="key" class="sr-only">Password</label>
	        <input type="password" name="pass" class="form-control" id="pass2" placeholder="Create your password">
	      </div>

	      <div class="form-group" >
			<input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block  btn-primary" value="Register">
			<input type="hidden" name="register" value="register">
		  </div>
      	</form>
      	<?php echo $msgr; ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>