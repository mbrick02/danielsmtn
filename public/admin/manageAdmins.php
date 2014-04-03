<?php 
	require_once("../../includes/initialize.php");
	if (!$session->isLoggedIn()) {
		redirectTo("loginDM.php");
	}
?>

<?php $allUsers = User::findAll(); ?>
<?php $layoutContext = "admin"?>
<?php $limitType=""; // case $layoutContext >> User::findAll();?>
<?php // case $limitType so that for chefs $limitType="WHERE userTypeID=CHEFTYPE" or $chefType ?>

<?php includeLayoutTemplate('header.php'); ?>
<Main>
	<nav>
		&nbsp;
		<!-- *****if I have a main menu <a href="mainMenu.php">&laquo; Main Menu</a><br/> -->
	</nav>
	<?php echo $session->putMessage(); ?>
	<!-- findAll **--later may want to sort admins first -->
	<table>
	<tr><th>Field</th><th>value</th><th>Action</th></tr>
	<?php 
	$users = User::findAll();
	foreach ($users as $user) {
		echo "<tr><td>User: " . $user->username . "</td>";
		echo "<td> Name: " . $user->fullName() . "</td>";
		echo "<td><a href=\"editDMAdmin.php?id=" . urlencode($user->userID) ."\">Edit</a></0td> </tr>";
	}
	?>

	</table>
	
	<br />
	<a href ="newDMAdmin.php">Add new admin</a>
	<a href ="logoutDM.php">Log Out</a>
</Main>
<?php includeLayoutTemplate('footer.php'); ?>