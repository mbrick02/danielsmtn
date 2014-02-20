<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php");	?>
<?php require_once("../includes/connection.php"); ?>
<?php include("../includes/layout/header.php"); ?>
  <div id="main">
    <head>
      <h1>Login Page</h1>
    </head>
    <div id="main_section">
        <?php 
			echo message();
        ?>
        <h2>Let us know who is bringing their dish</h2>
        <form action="regUser.php" method="post">
            <p><label for ="lName">lName: </label>
                <input name="lName" type="text" id="lName" 
                placeholder="Enter Last Name"/></p>
            <p><label for ="email">Email(use the same one where you received your invitation): </label>
                <input name="email" type="email" id="Text2" 
                placeholder="Enter Email address"/></p>
                
            <input type="submit" name="submit" value="Enter User">
            
        </form>
<?php include("../includes/layout/footer.php");	?>