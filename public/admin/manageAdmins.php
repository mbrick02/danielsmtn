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
	<!-- ***continue here from "Admin CRUD" Essential Training aroun 4:05 -->
</Main>