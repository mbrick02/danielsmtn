<?php require_once('./includes/initialize.php'); ?>
<?php 
	require_once(LIB_PATH.DS.'form.php');  // use with form to be combined from addDish
	require_once(LIB_PATH.DS.'dish.php');
	
	$formDish = new Form($fields, $requiredFields);
	if (isset($_POST['submit'])){
		$dish = Dish::make("", $formDish->fName, $formDish->lName, $formDish->dish, $formDish->email);
	}
?>

<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>