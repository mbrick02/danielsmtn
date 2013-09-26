<?php require_once("./includes/session.php");	?> // 9/25/13 not created yet
<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>
  <!--  *** note this editDish form is for entering data will edit chosen record of dbDish -->
<?php 
	if (isset($_GET["dishID"])) {
		$selectedDishID = htmlentities($_GET["dishID"]);
		$selectedLName = null;
	} elseif (isset($_GET["lName"])) {  // ***??? probably wont use this
		$selectedLName = htmlentities($_GET["lName"]);
		$selectedDishID = null;
	} else {
		$selectedDishID = null;
		$selectedLName = null;
	}
	
	/* 
	 * not sure if I want to show all dishes or not -- see showDishes.php
	 *   if so Ill use function listAllDishes with parameter $selectedDishID
	 * */
?>
<?php 
	if (!$selectedDishID){
		// dish ID was missing or invalid or
		// dish couldn't be found in db
		// *** currenly no code for handling no dishID or only a $selectedName
		redirectTo("showDishes.php"); 
	}
?>
<?php include("../includes/layouts/header.php"); ?>

    <div id="main_section"> // **** these need to be populated  using, findDishByID(dishID) test for null********
        <h2>What dish you will bring to the Usufruct</h2>
        <form action="createDish.php" method="post">
            <p><label for ="fName">fName: </label>
                <input name="fName" type="text" id="fName" 
                placeholder="Enter First Name"/></p>
            <p><label for ="lName">lName: </label>
                <input name="lName" type="text" id="lName" 
                placeholder="Enter Last Name"/></p>
            <p><label for ="email">Email(use the same one where you received your invitation): </label>
                <input name="email" type="email" id="Text2" 
                placeholder="Enter Email address"/></p>
            <p><label for ="dish">Dish: </label>
                <input name="dish" type="text" id="dish" 
                placeholder="Enter the dish you will bring"/></p>
                
            <input type="submit" name="submit" value="Submit Dish">
            
        </form>
<?php include("./includes/layout/footer.php");	?>
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