<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?> 

<?php 
if (isset($_POST['submit'])) {
	// Process the formÉ.
	$fname = mysqlPrep($_POST["fname"]);
	$lname = mysqlPrep($_POST["lname"]);
	$dish = mysqlPrep($_POST["dish"]);
	$email = mysqlPrep($_POST["email"]);
//Édetermine if email exists -- may or may not enter dish if no email??? may warn???
	
	$query = "INSERT INTO dish (";
	$query .= " fname, lname, dish, email";
	$query .= ") VALUES(";
	$query .= " '{fname}', '{lname}', '{dish}',  '{email}'";
	$query .= ")";

	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		redirect_to("showDishes.php");
		
	} else {
		// Failure
		redirect_to("addDish.php");
	}
} else {
	// This is probably a _GET request	
	redirectTo("addDish.php")
}
?>


<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>