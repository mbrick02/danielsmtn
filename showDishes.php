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
	<nav id="navigation">
	<ul>
		<li><a href="./showDishes.php">Show Dishes</a></li>
		<li><a href="./showDishes.php">Add Dish</a></li>
		<li><a href="./showDishes.php">Edit&#x2F;Delete Dish</a></li> 
	</ul>
	</nav>
	<div id="page">
		<ul class="dishes">
		<?php 
			while ($dish = mysqli_fetch_assoc($result)){	
		?>
			<li>
				<name><?php echo $dish["lName"] . ": " ?></name><dish><?php echo $dish["dish"] ?></dish>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
<?php mysqli_free_result($result); ?>
<?php mysqli_close($connection); ?>
<?php include("./includes/layout/footer.php");	?>