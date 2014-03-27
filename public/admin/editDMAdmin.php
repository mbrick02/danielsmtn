<?php 
require_once('../../includes/initialize.php');

if (!$session->isLoggedIn()) {
	redirectTo("loginDM.php");
}

require_once(LIB_PATH.DS.'form.php');

$fields = array("fName", "lName", "username", "password", "email");
$requiredFields = array("fName", "lName", "username", "password", "email");
$fieldsWMaxLengths = array("username" => 35, "password" => 45);

$user = User::findByID($_GET['id']); // *** also need to verify userTypeID = AdminType (?2)
if (!$user) {
	// no admin user found with that ID
	redirectTo("manageAdmins.php");
}
// *** 3/26/14 continue her putting $user vals in form values

// Remember to give your form's submit tag a name="submit" attribute
if (isset($_POST['submit'])) { // Form has been submitted
	$formNewDMAdmin = new Form($fields, $requiredFields, $fieldsWMaxLengths);
	if (!$formNewDMAdmin->validatePrecences()) {
		$session->setMessage($formNewDMAdmin->message);
	}	
	
	$formNewDMAdmin->setObjectVals($user); // *** still need to write this
	
	// $resultObj = $user->updateUserByID(?); if ($resultObj) { $session->setmessage("updated...
	
	

} else { // Form has not been submitted
	$username = "";
	$password = "";
}
?>



<?php includeLayoutTemplate('header.php'); ?>
  <div id="main">
    <!-- **SEE header.php** <head>
      <h1>E Page</h1>
    </head> -->
    <div id="main_section">
        <?php 
			echo $session->putMessage();
        ?>
        <h2>Edit Admin <?php echo $user->fullname() ?></h2>
        <!-- ***Need to add userTypeID = ?2 (admin) -->
        <table class="formTable">
		<form action="editDMAdmin.php?id=<?php echo urldecode($user->id); ?>" name="adminLogin" method="post">
            <tr>
              	<td><label for ="fName">First Name: </label></td>
              	<td><input name="fName" type="text" id="fName" 
                value = <?php echo htmlentities($user->fname); ?>/></td>
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
              	<td class="submitButton" colspan="2"><input type="submit" name="submit" value="Update User"></td>
            </tr> 
		</form>
		</table>
            
        
<?php includeLayoutTemplate('footer.php');	?>