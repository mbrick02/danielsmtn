<?php 
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");

if ($session->isLoggedIn()) {
	redirectTo("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute
if (isset($_POST['submit'])) { // Form has been submitted
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	// Check database to see if username/password exist.
	$foundUser = xxxx;
	
	if ($foundUser) {
		$session->login($foundUser);
		redirectTo("index.php");
	} else {
		// username/password combo was not found in db
		$session->setMessage("Username/password combination incorrect");
	}
} else { // Form has not been submitted
	$username = "";
	$password = "";
}
?>



<?php include("../../includes/layout/header.php"); ?>
  <div id="main">
    <head>
      <h1>Login Page</h1>
    </head>
    <div id="main_section">
        <?php 
			echo $session->putMessage();
        ?>
        <h2>Let us know who is bringing their dish</h2>
        <form action="regUser.php" method="post">
            <!-- <p><label for ="fName">First Name: </label>
                <input name="fName" type="text" id="fName" 
                placeholder="Enter first Name"/></p>  -->
            <!-- <p><label for ="lName">lName: </label>
                <input name="lName" type="text" id="lName" 
                placeholder="Enter Last Name"/></p> -->
            <p><label for ="username">username: </label>
                <input name="username" type="text" id="username" 
                placeholder="Leave Blank if you dont have a username"/></p>
            <p><label for ="email">Email(use the same one where you received your invitation): </label>
                <input name="email" type="email" id="Text2" 
                placeholder="Enter Email address"/></p>
                
            <input type="submit" name="submit" value="Enter User">
            
        </form>
<?php include("../includes/layout/footer.php");	?>