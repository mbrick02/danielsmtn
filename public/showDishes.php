<?php require_once("../includes/initialize.php"); ?>

<?php includeLayoutTemplate('header.php'); ?>
<div id="main">
<!-- . or .. within header file (e.g. ./includes/u2013.css )??? for localhost I had to use 1 but on server 2 -->
	<nav id="navigation" class="leftside">
		<?php echo navigation(); ?>
	</nav>
	<content><!-- div id="page"> -->
		<?php echo $session->putMessage(); ?>
		<?php $errors = $session->errors();//** instantiate a form  ?>
		<?php echo formErrors($errors); // **4/14 convert to thisForm->formErrors($errors) ?>
		<?php 
			$dishesSet = findAllDishes();
			$selectedDishID = null;  // ***10/24 not sure if this is usable now
			$selectedLName = null;  // ***10/24 not sure if this is usable now
		?>
		<!-- ***??? 9/24/13 turn below into function listAllDishes($selectedDishID) -->
		<ul class="dishes">
			<li><h3 class="listTitle">Guest&#40;s&#41; and Dish</h3></li>
		<?php 
			while ($dish = mysqli_fetch_assoc($dishesSet)){	
		?>
			<!--  *******WAS testing here 10/23/13 4PM...  ***4/14 turn this into a form ** -->
			<?php 
				$sessionDishID = $_SESSION["currentDishID"] ?: -1;  // if currentDishID is set use it otherwise set to non-existant number
				$specLayoutContext = ($dish['dishID'] == $sessionDishID) ? "thisChef" : $layoutContext;
				$anchorPre = dishAnchorPreTag($specLayoutContext, $dish['dishID']);
				$anchorPost = ($anchorPre == "") ? "" : "</a>";
			?>
			<li<?php if ($dish['dishID'] == $selectedDishID) {
				echo " class=\"selected\"";
			} ?>><name><?php echo $dish["lName"] . ": " ?></name>
			 	<?php echo $anchorPre ?>
				<dish><?php echo $dish["dish"] ?></dish>
				<?php echo $anchorPost ?>
			</li>
		<?php } ?>
		</ul>
	<!-- /div> -->
	</content>
<?php mysqli_free_result($dishesSet); ?>
<?php includeLayoutTemplate('footer.php'); ?>