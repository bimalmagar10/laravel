<?php 
// date_default_timezone_set('Asia/Kathmandu');



// $now = new DateTime();
// $nextWeek =  new DateTime('today + 1 week');

// echo "Now:".$now->format('Y-m-d')."\n";
// echo "NextWeek".$nextWeek->format('Y-m-d')."\n";

require_once 'pdo.php';


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
	
	$sql = "INSERT INTO User (name,email,password) VALUES (:name,:email,:password)";

	$insert = $pdo->prepare($sql);
	$insert->execute(array(
			':name' => $_POST['name'],
			':email' => $_POST['email'],
			':password' => $_POST['password']
	));
}

if (isset($_POST['delete']) && isset($_POST['user_id'])) {
	 
	$sql = "DELETE FROM User WHERE user_id =:zip ";

	$delete = $pdo->prepare($sql);
	$delete->execute(array(
          ':zip'=>$_POST['user_id']
	));
}

?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>PDO</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>

 	<table border="1">
 		<?php 
           $datas = $pdo->query("SELECT name,email,password,user_id FROM User");

   			while ($row = $datas->fetch(PDO::FETCH_ASSOC)) {
		    echo '<tr><td>';
		    echo $row['name'];
		    echo '</td><td>';
		    echo $row['email'];
		    echo '</td><td>';
		    echo $row['password'];
		    echo '</td><td>';
		    echo '<form method="POST">';
		    echo '<input type="hidden" name="user_id" value="'.$row['user_id'].'">';
		    echo '<input type="submit" name="delete" value="DEL">';
		    echo '</form>';
		    echo '</td></tr>';
		  }

 		 ?>
   </table>

 	<p>ADD A NEW USER</p>
 	<form action="" method="POST">
 		<label for="name">Name:</label>
 		<input type="text" name="name" id="name" placeholder="enter your name"/> <br>
 		<label for="email">Email</label>
 		<input type="text" name="email" id="email"/> <br>
 		<label for="pass">Password</label>
 		<input type="password" name="password" id="pass"/>
 		<input type="submit" value="Submit"/>
 	</form>
 </body>
 </html>