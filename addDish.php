<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?> 
  <!--  *** note this addDish form is for entering data but createDish puts it in the dbDish -->
  <div id="main">
    <header>
      <h1>addDish</h1>
    </header>
    <nav>
      <!-- php echo navigation($currentDMtnSect, $currentPage) **replace below** -->
      <p><a href="/">Home</a></p>
      
    </nav>

    <div id="main_section">
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
                <input name="dish" type="url" id="dish" 
                placeholder="Enter the dish you will bring"/></p>
                
            <input type="submit" name="submit" value="Submit Dish">
            
        </form>
<?php include("./includes/layout/footer.php");	?>