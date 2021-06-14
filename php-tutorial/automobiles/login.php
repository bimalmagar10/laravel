<?php 

if (isset($_POST['cancel'])) {
   	  header("Location:index.php");
   	  return;
   }
   $salt = 'XyZzy12*_';
   $stored_salt = '1a52e17fa899cf40fb04cfc42e6352f1'; 

   $failure= false;
   if(isset($_POST['who']) && isset($_POST['pass'])) {
   	  if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
   	  	$failure = "Email and Password are required";
   	  } elseif (! (filter_var($_POST['who'],FILTER_VALIDATE_EMAIL))) {
   	  	     	$failure = 'Email must have at_sign (@)';
   	  	       } else {
   	  	          $check = hash('md5',$salt.$_POST['pass']);

		           if ($check == $stored_salt) {
		  	       header("Location:autos.php?name=".urlencode($_POST['who']));
		  	       error_log("Login success ".$_POST['who']);
		      } else {
		  	       $failure = 'Incorrect password';
		  	       error_log("Login fail ".$_POST['who']." $check");
		  }
   	  }
   	  
   }


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Bimal Thapa Magar</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	  <h1>Please Log In</h1>
 	  <?php 
		   if ($failure !== false) {
		   	echo '<p style="color:red">'.htmlentities($failure).'</p>';
		   }
       		
		?>
 	  <form action="" method="POST">
 	  	    <label for="nam">User Name</label>
			<input type="text" name="who" id="nam"> <br>
			<label for="id_1723">Password</label>
			<input type="password" name="pass" id="id_1723"> <br>
			<input type="submit" value="Log In">
			<input type="submit" name="cancel" value="Cancel">
 	  </form>
 </body>
 </html>