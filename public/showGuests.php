<?php require_once("../includes/initialize.php"); ?>
<?php require_once(LIB_PATH.DS.'form.php'); ?>
<?php require_once(LIB_PATH.DS.'usufructGuests.php'); ?> 
<?php 
	// processs this form (started 1/8/15) 
	// ???????based on comments, but I'm not basing dishes on a photo *******
	// ***probably don't need next if******
/* 	if(empty($_GET['id'])){
		$session->message("No id for ?set of dishes?????");
		// **1/15 not sure this is a good idea (diff. than Skoglund's login project): redirectTo('index.php');
	} */
  
?>
<?php includeLayoutTemplate('header.php'); ?>
<div id="main">
	<content><!-- div id="page"> -->
		<?php echo $session->message(); ?>
		<?php $errors = $session->errors(); ?>
		<?php // echo $guestForm->formErrors($errors); ?>
		<?php 
			$guestSet = UsufructGuests::findAll(); 
		?>
		
		<ul class="dishes">
			<li><h3 class="listTitle">Guest&#40;s&#41; eMail</h3></li>
		<?php 
			foreach ($guestSet as $guest){	
		?>
			<?php 
			?>
			<li>
			<?php echo $guest->email; ?>
			</li>
		<?php } ?>
		</ul>
	</content>
<?php mysqli_free_result($guestSet); ?>
<?php includeLayoutTemplate('footer.php'); ?>