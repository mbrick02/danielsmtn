<?php require_once("../includes/initialize.php"); ?>
<?php 
	// processs this form (started 1/8/15) 
	// ???????based on comments, but I'm not basing dishes on a photo *******
	// ***probably don't need next if******
	if(empty($_GET['id'])){
		$session->message("No id for ?set of dishes?????");
		// **1/15 not sure this is a good idea (diff. than Skoglund's login project): redirectTo('index.php');
	}
	
	// here phot.php (with comment) had $phot = Photograph::findByID($_GET['id']);
	
	// **1/09/15  When we have a form, we can implement code below:
//	if(isset($_POST['submit'])){
		
//	} else {
		
//	}
  
?>
<?php includeLayoutTemplate('header.php'); ?>
<div id="main">
<!-- . or .. within header file (e.g. ./includes/u2013.css )??? for localhost I had to use 1 but on server 2 -->
	<nav id="navigation" class="leftside">
		<?php echo navigation(); ?>
	</nav>
	<content><!-- div id="page"> -->
		<?php echo $session->message(); ?>
		<?php $errors = $session->errors(); ?>
		<?php $dishForm = new Form ?>
		<?php // echo $dishForm->formErrors($errors); ?>
		<?php 
			$dishesSet = findAllDishes(); // *** 1/8/15 change to dish->findAll();
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
				$sessionDishID = isset($_SESSION["currentDishID"]) ? $_SESSION["currentDishID"]: -1;  
				// if currentDishID is set use it otherwise set to non-existant number
				// Note: $_SESSION["currentDishID"]) ?: -1; // (ternary shortcut) gives a warning if no server request (empty form opened)
				// **1/12/15 functions below in functions.php MOVE TO dish.php if needed
				if (!isset($layoutContext)){
					$layoutContext = "thisChef";
				}
				$specLayoutContext = ($dish['id'] == $sessionDishID) ? "thisChef" : $layoutContext;
				$anchorPre = dishAnchorPreTag($specLayoutContext, $dish['id']);
				$anchorPost = ($anchorPre == "") ? "" : "</a>";
			?>
			<li<?php 
				if ($dish['id'] == $selectedDishID) {
				 	echo " class=\"selected\" ";
				} 
			?>><name><?php echo $dish["lName"] . ": " ?></name>
			 	<?php echo $anchorPre ?>
				<dish><?php echo $dish["dish"] ?></dish>
				<?php echo $anchorPost ?>
			</li>
		<?php } ?>
		</ul>
	</content>
<?php mysqli_free_result($dishesSet); ?>
<?php includeLayoutTemplate('footer.php'); ?>