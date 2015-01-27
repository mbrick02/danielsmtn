<?php require_once('./includes/initialize.php'); ?>
<?php 
	require_once(LIB_PATH.DS.'form.php');  // use with form to be combined from addDish
	require_once(LIB_PATH.DS.'dish.php');
	
	$fields = array("fName", "lName", "dish", "email");
	$requiredFields = array("fName", "lName", "dish", "email");
	$fieldsWithMaxLengths = array('fName' => 17, 'lName' => 17, 'dish' => 25, 'email' => 30)
	
	
	$formDish = new Form($fields, $requiredFields);
	
	// ** 1/26/15 Note in form.php: setObjVars(): $dbObject->$field = $_POST["{$field}"];
	
	if (isset($_POST['submit'])){
		$dish = Dish::make($formDish->fName, $formDish->lName, $formDish->dish, $formDish->email);
	}
?>

<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>