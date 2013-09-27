<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/connection.php"); ?>
<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/validationFunctions.php"); ?>
<?php 
	if (isset($_GET["dishID"])) {
		$selectedDishID = mysqli_real_escape_string($connection, $_GET["dishID"]);
		$selectedLName = null;
	} elseif (isset($_GET["lName"])) {  // ***??? probably wont use this
		$selectedLName = htmlentities($_GET["lName"]);
		$selectedDishID = null;
	} else {
		$selectedDishID = null;
		$selectedLName = null;
	}
	
	/*
	 *  *** note this editDish form is for entering data to edit chosen record of dbDish
	 *    
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
	} else {
		$dishRec = findDishByID($selectedDishID);
	}
?>
<?php 
	if (isset($_POST['submit'])) {
		// Process the form
		
		// Perform Update
		$dishID = $selectedDishID;
		$fName = mysqlPrep($_POST["fName"]);
		$lName = mysqlPrep($_POST["lName"]);
		$email = mysqlPrep($_POST["email"]);
		$dish = mysqlPrep($_POST["dish"]);
		
		$query = "UPDATE dish SET ";
		$query .= "fName = '{$fName}', ";
		$query .= "lName = '{$lName}', ";
		$query .= "email = '{$email}', ";
		$query .= "dish = '{$dish}', ";
		$query .= "WHERE dishID = {$dishID} ";
		$query .= "LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) == 1) {
			// Success
			$_SESSION["message"] = "Dish edited successfully.";
			redirectTo("showDishes.php");
		} else {
			// Failure
			$message = "Dish edit failed.";
		}
		
	} else { 
		// Probably a GET request rather than submit
	} // end: if (isset($_POST['submit']))
?>
<?php include("./includes/layout/header.php"); ?>
    <div id="main_section"> 
        <?php  // $message is just a variable, no need to use SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . $message ."</div>";
			}
        ?>
        <?php $errors = errors(); ?>
        <?php echo formErrors($errors); ?>
        
        <h2>Change dish (<?php echo $dishRec["dish"] ?>) you will bring to the Usufruct</h2>
        <form action="editDish.php?dishID=<?php echo $selectedDishID ?>" method="post">
            <p><label for ="fName">fName: </label>
                <input name="fName" type="text" id="fName" value="<?php echo $dishRec["fName"] ?>" /></p>
            <p><label for ="lName">lName: </label>
                <input name="lName" type="text" id="lName" 
                 value="<?php echo $dishRec["lName"] ?>"/></p>
            <p><label for ="email">Email(use the same one where you received your invitation): </label>
                <input name="email" type="email" id="Text2" 
                 value="<?php echo $dishRec["email"] ?>"/></p>
            <p><label for ="dish">Dish: </label>
                <input name="dish" type="text" id="dish" 
                 value="<?php echo $dishRec["dish"] ?>"/></p>
                
            <input type="submit" name="submit" value="Edit Dish Info"><br>
            <a href="showDishes.php">Cancel</a>
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
	// redirectTo("addDish.php"); //  - user must use 'submit' button
}
?>
<?php // *****WHY DOES THIS PRODUCE 
	//       "Warning: mysqli_close() [function.mysqli-close]: Couldn't fetch mysqli in..."
	 /* if (isset($connection)) {
		mysqli_close($connection); 
	} */
?>