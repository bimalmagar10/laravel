<?php 
    require_once 'pdo.php';

    if (isset($_POST['email']) && isset($_POST['password'])) {
    

    	$sql = "SELECT name FROM User WHERE email = :em AND password = :pw";


    	$login= $pdo->prepare($sql);
        $login->execute(array(
              ':em' => $_POST['email'],
              ':pw' => $_POST['password'],
        ));
        $row = $login->fetch(PDO::FETCH_ASSOC);


    	if($row === FALSE){
    		echo 'Login Credentials Incorrect';
    	} else {
    		echo 'Login Success';
    	}


    }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Login Portal</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	  <h1>Please Login</h1>
 	  <form action="" method="POST">
 	  	<label for="email">Email</label>
 	  	<input type="text" name="email" id="email"> <br>
 	  	<label for="pass">Password</label>
 	  	<input type="password" name="password" id="pass"/><br>
 	  	<input type="submit" value="Login">
 	  </form>
 </body>
 </html>