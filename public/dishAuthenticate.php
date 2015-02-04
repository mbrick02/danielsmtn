<?php 
require_once('../includes/initialize.php');

// ** 2/3/15 More accurate to call this dishEmailAuthenticate???

// if ($session->isLoggedIn()) {  // ** this should never happen since came from createDish
// 	redirectTo("manageAdmins.php"); 
// }

// Remember to give your form's submit tag a name="submit" attribute
if (isset($_POST['submit'])) { // Form has been submitted
	$email = trim($_POST['email']);
	// ***this is admin login so we check for username/password ??chef login??
	// Check database to see email exist.
	$foundUsers = User::findRecsByField("email", $email);
	
	if ($foundUsers) {
		// ** 2/3/15 array_shift($foundUser) also should note if count($foundUser) > 1
		// *** do we need to login ???????????????????????????? 
		$session->login($foundUser);
		$session->message("Found User: ". $foundUser->fName . ", ID: " . $session->userID);
		redirectTo("createDish.php");
	} else {
		// username/password combo was not found in db
		$session->message("Could not find email, please use email of your Usufruct invite");
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
        
        
        <form action="dishAuthenticate.php" name="dishLogin" method="post">
         <fieldset>
         <table class="formTable">
         <thead>
         	<tr>
         	  	<th>Label</th><th>Field</th>
         	</tr>
         </thead>        
         <tbody>
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
