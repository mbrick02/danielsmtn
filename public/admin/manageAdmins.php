<?php 
	require_once("../../includes/initialize.php");
	if (!$session->isLoggedIn()) { redirectTo("loginDM.php"); }
?>

<?php $allUsers = User::findAll(); ?>
<?php $layoutContext = "admin"?>
<?php includeLayoutTemplate('header.php'); ?>
<Main>
	<nav>
		&nbsp;
	</nav>
	<!-- findAll **--later may want to sort admins first -->
	<table>
	<tr><td>Field</td><td>value</td></tr>
	<?php 
	$userSet = User::findAll();
	foreach ($users as $user) {
		echo "<tr>User: " . $user->username . "</td>";
		echo "<td> Name: " . $user->fullName() . "</td> </tr>";
	}
	?>

	</table>
	
	<!-- ***continue here from "Admin CRUD" Essential Training aroun 4:30 -->
</Main>