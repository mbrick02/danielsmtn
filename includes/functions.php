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
?>