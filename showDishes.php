<?php require_once("./includes/functions.php");	?>
<?php 
	$query = "SELECT * ";
	$query .= "FROM dish ";
	echo $query;
?>
<?php include("./includes/layout/header.php");	?>
<div id="main">
	<navigation id="navigation">
		&nbsp;
	</navigation>
	<content id="page"></content>
</div>
<?php include("./includes/layout/footer.php");	?>