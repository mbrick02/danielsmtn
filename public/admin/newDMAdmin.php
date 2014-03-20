<?php 
require_once('../../includes/initialize.php');

if ($session->isLoggedIn()) {
	redirectTo("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute
if (isset($_POST['submit'])) { // Form has been submitted
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	// ***this is admin login so we check for username/password ??chef login??
	// Check database to see if username/password exist.
	$foundUser = User::authenticate($username, $password);
	
	if ($foundUser) {
		$session->login($foundUser);
		redirectTo("mainAdmin.php");
	} else {
		// username/password combo was not found in db
		$session->setMessage("Username/password combination incorrect");
	}
} else { // Form has not been submitted
	$username = "";
	$password = "";
}
?>



<?php includeLayoutTemplate('header.php'); ?>
  <div id="main">
    <!-- **SEE header.php** <head>
      <h1>Login Page</h1>
    </head> -->
    <div id="main_section">
        <?php 
			echo $session->putMessage();
        ?>
        <h2>Let us know who is bringing their dish</h2>
        <!-- ***Need to add userTypeID = ?2 (admin) -->
        <table class="formTable">
		<form action="regUser.php" name="adminLogin" method="post">
            <tr>
              	<td><label for ="fName">First Name: </label></td>
              	<td><input name="fName" type="text" id="fName" 
                placeholder="Enter first Name"/></td>
            </tr>
            <tr>
              	<td><label for ="lName">lName: </label></td>
              	<td><input name="lName" type="text" id="lName" 
                placeholder="Enter Last Name"/></td>
            </tr>
            <tr>
              	<td><label for ="username">username: </label></td>
              	<td><input name="username" type="text" id="username" 
                placeholder="Leave Blank if you dont have a username"/></td>
            </tr>
            <tr>
              	<td><label for ="email">Email(preferably the one your invitation was sent to): </label></td>
              	<td><input name="email" type="email" id="Text2" 
                placeholder="Enter Email address"/></td>
            </tr>
            <tr>
              	<td class="submitButton" colspan="2"><input type="submit" name="submit" value="Enter User"></td>
            </tr> 
		</form>
		</table>
            
        
<?php includeLayoutTemplate('footer.php');	?>