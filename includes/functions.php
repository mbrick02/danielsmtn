<?php
function redirectTo($newLocation) {
	header("Location: " . $newLocation);
	exit;
}

function mysqlPrep($string) {
	global $connection;
	
	$escapedString = mysqli_real_escape_string($connection, $string);
	return $escapedString;
}

function confirmQuery($resultSet) {
	if (!$resultSet) {
		die("Database query failed.");
	}
}

function findAllDishes() {
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM dish ";
	// echo $query;
	$dishesSet = mysqli_query($connection, $query);
	confirmQuery($dishesSet);
	
	return $dishesSet;
}

function findDishByID($dishID){
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM dish ";
	$query .= "WHERE dishID = " . $dishID;

	// ???LIMIT 1 ????
	
	$dishesSet = mysqli_query($connection, $query);
	confirmQuery($dishesSet);
	
	return $dishesSet;	
}

function navigation(){
	$output = "<ul>";
	$output .= "<li><a href=\"./index.htm\">Home</a></li>";
	$output .= "<!-- probably need this to go to Usfruct for year -->";
	$output .= "<li><a href=\"./showDishes.php\">Show Dishes</a></li>";
	$output .= "<li><a href=\"./showDishes.php\">Edit&#x2F;Delete Dish</a></li>";
	$output .= "<li><a href=\"./addDish.php\">&#43; Add Dish</a></li>";
	$output .= "</ul>";
	
	return $output;
}

?>