<?php require_once("../includes/initialize.php"); ?>
<?php require_once(LIB_PATH.DS.'form.php'); ?> 
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
	<content><!-- div id="page"> -->
		<?php echo $session->message(); ?>
		<?php $errors = $session->errors(); ?>
		<?php // echo $guestForm->formErrors($errors); ?>
		<?php 
			$guestSet = UsufructGuest::findAll(); 
		?>
		<!-- ***??? 9/24/13 turn below into function listAllDishes($selectedDishID) -->
		<ul class="dishes">
			<li><h3 class="listTitle">Guest&#40;s&#41; eMail</h3></li>
		<?php 
			while ($guest = mysqli_fetch_assoc($dishesSet)){	
		?>
			<?php 
			?>
			<li>
			<?php echo $guest["email"]; ?>
			</li>
		<?php } ?>
		</ul>
	</content>
<?php mysqli_free_result($guestSet); ?>
<?php includeLayoutTemplate('footer.php'); ?>