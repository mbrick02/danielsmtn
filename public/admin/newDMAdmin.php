<?php 
require_once('../../includes/initialize.php');
require_once(LIB_PATH.DS.'form.php');

$fields = array("fName", "lName", "username", "password", "email");
$requiredFields = array("fName", "lName", "username", "password", "email");

$formNewDMAdmin = new Form($fields, $requiredFields);

if (!$session->isLoggedIn()) {
	redirectTo("loginDM.php");
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
        <h2>Create New Admin</h2>
        <!-- ***Need to add userTypeID = ?2 (admin) -->
        <table class="formTable">
		<form action="newDMAdmin.php" name="adminLogin" method="post">
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
              	<td><label for ="password">password: </label></td>
              	<td><input name="password" type="text" id="password" /></td> <!-- change to type password -->
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