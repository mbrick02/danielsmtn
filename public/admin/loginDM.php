<?php 
require_once('../../includes/initialize.php');

if ($session->isLoggedIn()) {
	redirectTo("manageAdmins.php");  // test debug ... should be mainAdmin.php
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
		$session->message("Found User: ". $foundUser->fName . ", ID: " . $session->userID);
		redirectTo("manageAdmins.php");
	} else {
		// username/password combo was not found in db
		$session->message("Username/password combination incorrect");
	}
} else { // Form has not been submitted
	$username = "";
	$password = "";
}
?>



<?php includeLayoutTemplate('header.php'); ?>

  <div id="main">
    <article>
    <header>
      <h1>Login Page</h1>
    </header>
    <div>
        <?php 
        	echo $session->message();
        ?>
        <!-- h2>Let us know who is bringing their dish</h2>  -->
        
        
        <form action="loginDM.php" name="adminLogin" method="post">
         <fieldset>
         <table class="formTable">
         <thead>
         	<tr>
         	  	<th>Label</th><th>Field</th>
         	</tr>
         </thead>        
         <tbody>

 <!--         <tr>
              	<td><label for ="fName">First Name: </label></td>
              	<td><input name="fName" type="text" id="fName" 
                placeholder="Enter first Name"/></td>
              </tr>  -->
 <!--         <tr>
              	<td><label for ="lName">lName: </label></td>
              	<td><input name="lName" type="text" id="lName" 
                placeholder="Enter Last Name"/></td>
              </tr>  -->
              <tr>
              	<td><label for ="username">username: </label></td>
              	<td><input name="username" type="text" id="username" 
                placeholder="Leave Blank if unsure"/></td>
              </tr>
              <tr>
              	<td><label for ="password">password: </label></td>
              	<td><input name="password" type="password" id="password" 
                placeholder="Leave Blank if unsure"/></td>
              </tr>
              <tr>
              	<td><label for ="email">Email (the one your invitation was sent to): </label></td>
              	<td><input name="email" type="email" id="Text2" 
                placeholder="Enter Email address"/></td>
              </tr>
              <tr>
              	<td class="submitButton" colspan="2"><input type="submit" name="submit" value="Enter User"></td>
              </tr> 
          </tbody> 
		  </table>
		  </fieldset>
		</form>
	</div>
	</article>
	</div>
<?php includeLayoutTemplate('footer.php');	?>
