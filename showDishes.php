<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>
<?php 
	$query = "SELECT * ";
	$query .= "FROM dish ";
	// echo $query;
	$result = mysqli_query($connection, $query);
?>
<?php include("./includes/layout/header.php");	?>
<div id="main">
<!-- . or .. within header file (e.g. ./includes/u2013.css )??? for localhost I had to use 1 but on server 2 -->
	<nav id="navigation">
	<ul>
		<li><a href="./index.htm">Home</a></li> <!-- probably need this to go to Usfruct for year -->
		<li><a href="./showDishes.php">Show Dishes</a></li>
		<li><a href="./showDishes.php">Edit&#x2F;Delete Dish</a></li>
		<li><a href="./addDish.php">&#43; Add Dish</a></li> 
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