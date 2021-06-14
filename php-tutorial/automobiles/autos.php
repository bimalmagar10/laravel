<?php 
if (! isset($_GET['name']) || strlen($_GET['name']) < 1) {
	die("Name parameter missing");
}
if (isset($_POST['logout'])) {
	header("Location:index.php");
}

require_once 'pdo.php';

$failure = false;
$msg= false;
if (isset($_POST['make']) && isset($_POST['year']) && $_POST['mileage']) {
	

	   if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {

		    $failure = "Mileage and Year should be numeric";

	   } elseif(strlen($_POST['make']) < 1){
	   	
	   	  $failure = "Make is required";

	   } else {
		  $sql = "INSERT INTO autos (make,year,mileage) VALUES (:mk,:yr,:mi)";

			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
		     ':mk' => $_POST['make'],
		     ':yr' => $_POST['year'],
		     ':mi' => $_POST['mileage'],

		));
			$failure = false;
			$msg = "Record Inserted";
	}
}




?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bimal Thapa Magar Autos Database</title>
	<link rel="stylesheet" href="">
</head>
<body>
	   
	<h1>Tracking Autos for <?= isset($_REQUEST['name']) ? htmlentities($_REQUEST['name']) : ''; ?></h1>
	<?php 
	if($failure !== false) {
	   echo '<p style="color:red">'.htmlentities($failure).'</p>';

	} elseif($failure === false){
		echo '<p style="color:green">'.htmlentities($msg).'</p>';
	}
	?>
	<form action="" method="POST">
		<label for="make">Make:</label>
		<input type="text" name="make" id="make" size="60"><br>
		<label for="year">Year:</label>
		<input type="text" name="year" id="year"><br>
		<label for="mileage">Mileage:</label>
		<input type="text" name="mileage" id="mileage" /><br>
		<input type="submit" value="Add">
		<input type="submit" name="logout" value="Logout">

	</form>

	<?php 

	$datas = $pdo->query("SELECT make,year,mileage FROM autos");
   while ($row = $datas->fetch(PDO::FETCH_ASSOC)) {
       echo '<ul><li>';
       echo $row['year'];
       echo "&nbsp;";
       echo $row['make'];
       echo '/';
       echo $row['mileage'];
       echo '</li></ul>';
   }
   
	 ?>
</body>
</html>