<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/functions.php");	?>
<?php require_once("./includes/connection.php"); ?>

<?php include("./includes/layout/header.php");	?>
<div id="main">
<!-- . or .. within header file (e.g. ./includes/u2013.css )??? for localhost I had to use 1 but on server 2 -->
	<nav id="navigation">
		<?php echo navigation(); ?>
	</nav>
	<div id="page">
		<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo formErrors($errors); ?>
		<?php 
			$dishesSet = findAllDishes();
			$selectedDishID = null;
			$selectedLName = null;
		?>
		<!-- ***??? 9/24/13 turn below into function listAllDishes($selectedDishID) -->
		<ul class="dishes">
			<li><h3 class="listTitle">Guest&#40;s&#41; and Dish</h3></li>
		<?php 
			while ($dish = mysqli_fetch_assoc($dishesSet)){	
		?>
			<li<?php if ($dish['dishID'] == $selectedDishID) {
				echo " class=\"selected\"";
			} ?>><name><?php echo $dish["lName"] . ": " ?></name>
				<a href="editDish.php?dishID=<?php echo urlencode($dish['dishID']); ?>">
				     <dish><?php echo $dish["dish"] ?></dish></a>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
<?php mysqli_free_result($dishesSet); ?>
<?php mysqli_close($connection); ?>
<?php include("./includes/layout/footer.php");	?>