<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/validationFunctions.php"); ?>
<?php if (isset($_POST['submit'])) {	// Process the formÉ.
	$fName = mysqlPrep($_POST["fName"]);
	$lName = mysqlPrep($_POST["lName"]);
	$dish = mysqlPrep($_POST["dish"]);
	$email = mysqlPrep($_POST["email"]); //Édetermine if email in list 
	     // -- may or may not enter dish if email not in list??? may warn???
	
	// validations
	$requiredFields = array("lName", "email");
	validatePresences($requiredFields);
	
	$fieldsWithMaxLengths = array("fName" => 20);
	validateMaxLengths($fieldsWithMaxLengths);
	
	if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirectTo("showDishes.php");
	}
	
	$query = "INSERT INTO tbChefs (";
	$query .= "fName, lName, email";
	$query .= ") VALUES(";
	$query .= " '{$fName}', '{$lName}',  '{$email}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	if ($result) {	// Success - show added dish
		$_SESSION["message"] = "Added Chef.";
		redirectTo("showDishes.php");
	} else {	// Failure
		$_SESSION["message"] = "User noat added.";
		redirectTo("addChef.php"); //  - redo
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