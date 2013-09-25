<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>
<?php if (isset($_POST['submit'])) {	// Process the formÉ.
	$fName = mysqlPrep($_POST["fName"]);
	$lName = mysqlPrep($_POST["lName"]);
	$dish = mysqlPrep($_POST["dish"]);
	$email = mysqlPrep($_POST["email"]); //Édetermine if email exists 
	     // -- may or may not enter dish if no email??? may warn???
	$query = "INSERT INTO dish (";
	$query .= " fName, lName, dish, email";
	$query .= ") VALUES(";
	$query .= " '{$fName}', '{$lName}', '{$dish}',  '{$email}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	if ($result) {	// Success - show added dish
		redirectTo("showDishes.php");
	} else {	// Failure
		redirectTo("addDish.php"); //  - redo
	}
} else {	// This is probably a _GET request	
	redirectTo("addDish.php"); //  - user must use 'submit' button
}
?>
<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>