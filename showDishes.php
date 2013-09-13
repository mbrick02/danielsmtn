<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php");	?>
<?php 
	$query = "SELECT * ";
	$query .= "FROM dish ";
	// echo $query;
	$result = mysqli_query($connection, $query);
?>
<?php include("./includes/layout/header.php");	?>
<div id="main">
	<navigation id="navigation">
		&nbsp;
	</navigation>
	<content id="page">
		<ul class="dishes">
		<?php 
			while ($dish = mysqli_fetch_assoc($result)){
				
		
		?>
			<li>
				<name><?php echo $dish["lName"] ?></name><dish><?php echo ": " . $dish["dish"] ?></dish>
			</li>
		<?php } ?>
		</ul>
	</content>
</div>
<?php mysqli_free_result($result); ?>
<?php mysqli_close($connection); ?>
<?php include("./includes/layout/footer.php");	?>