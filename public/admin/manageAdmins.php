<?php 
	require_once("../../includes/initialize.php");
	if (!$session->isLoggedIn()) {
		// debug ** echo "<br /> Not logged in. <br />";
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
	</nav>
	<!-- findAll **--later may want to sort admins first -->
	<table>
	<tr><th>Field</th><th>value</th><th>Action</th></tr>
	<?php 
	$users = User::findAll();
	foreach ($users as $user) {
		echo "<tr><td>User: " . $user->username . "</td>";
		echo "<td> Name: " . $user->fullName() . "</td>";
		echo "<td><a href=\"editAdminUser.php?id=" . urlencode($user->userID) ."\">Edit</a></0td> </tr>";
	}
	?>

	</table>
	
	<br />
	<a href ="newDMAdmin.php">Add new admin</a>
</Main>
<?php includeLayoutTemplate('header.php'); ?>