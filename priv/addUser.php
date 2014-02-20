<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/validationFunctions.php"); ?>
<?php if (isset($_POST['submit'])) {	// Process the formÉ.
	$fName = mysqlPrep($_POST["fName"]);
	$lName = mysqlPrep($_POST["lName"]);
	// *** Need to determine userTypeID probably default to Chef
	$userTypeId = 2; // assume chef (= 2) XX mysqlPrep($_POST["userTypeID"]);
	
	// *** working here 11/22/13 but need to get logic of this settled first *******
	$email = mysqlPrep($_POST["email"]); //Éget email from ?loginDM.php page  
	
	if (checkUEmail($email)){ // if email in list
		// **** redirect to editDish with Dish/user ID
	} else {
		//  create new dish IF not too ?many new Dishes...
	}
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
	
	$query = "INSERT INTO tbUsers (";
	$query .= "fName, lName, userTypeID, email";
	$query .= ") VALUES(";
	$query .= " '{$fName}', '{$lName}', {$userTypeId}, '{$email}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	if ($result) {	// Success - show added dish
		$_SESSION["message"] = "Added Chef.";
		redirectTo("showDishes.php");
	} else {	// Failure
		$_SESSION["message"] = "User not added.";
		redirectTo("addUser.php"); //  - redo
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