<?php require_once('../includes/initialize.php'); ?>
<?php require_once("../includes/validationFunctions.php"); // *** move(d) to form.php ?>
<?php 
	require_once(LIB_PATH.DS.'form.php');  // use with form to be combined from addDish
	require_once(LIB_PATH.DS.'dish.php');
	
	$fields = array("fName", "lName", "dish", "email");
	$requiredFields = array("fName", "lName", "dish", "email");
	$fieldsWithMaxLengths = array("fName" => 17, "lName" => 17, "dish" => 25, "email" => 30);
	
	
	$formDish = new Form($fields, $requiredFields, $fieldsWithMaxLengths);
	
	// ** 1/26/15 Note in form.php: setObjVars(): $dbObject->$field = $_POST["{$field}"];
	
	if (isset($_POST['submit'])){
		$dish = Dish::make($formDish->fName, $formDish->lName, $formDish->dish, $formDish->email);
	}
?>
<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>
<?php if (!$session->isLoggedIn()){
		$session->message("You must log in before you may add a dish");
		redirectTo("./dishAuthenticate.php");
	  }
?>
  <!--  *** note this addDish form is for entering data but createDish puts it in the dbDish -->
  <?php include("./includes/layout/header.php"); ?>
  <div id="main">
    <nav>
      <!-- php echo navigation($currentDMtnSect, $currentPage) **replace below** -->
      <p><a href="/">Home</a></p>

    </nav>

    <div id="main_section">
        <?php
			echo message();
        ?>
        <h2>What dish you will bring to the Usufruct</h2>
        <form action="createDish.php" method="post">
            <p><label for ="fName">fName: </label>
                <input name="fName" type="text" id="fName"
                placeholder="Enter First Name"/></p>
            <p><label for ="lName">lName: </label>
                <input name="lName" type="text" id="lName"
                placeholder="Enter Last Name"/></p>
            <p><label for ="email">Email(use the invitation email): </label>
                <input name="email" type="email" id="Text2"
                placeholder="Enter Email address"/></p>
            <p><label for ="dish">Dish: </label>
                <input name="dish" type="text" id="dish"
                placeholder="Enter the dish you will bring"/></p>

            <input type="submit" name="submit" value="Submit Dish">

        </form>
     </div>
    </div>
<?php include("./includes/layout/footer.php");	?>