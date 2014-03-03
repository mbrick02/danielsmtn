<?php
	require_once('./initialize.php');
	// require_once('./database.php');
	// echo "<br /><br />Current Dir: " . getcwd();
	
	echo $db->escapeValue("<br />It's working?<br />");
	
	/*
	//** this won't work as is (wanted to test get_object_vars()): user::testShowUserObjVars();
	
	$sql = "SELECT * FROM users WHERE id = 1";
	$resultSet = $database->query($sql);
	$foundUser = $database->fetchArray($resultSet);
	echo $foundUser['username'];
	
	// Note: if we had Object methods, would have to instantiate: $User = new User();
	$record = $User::findByID(1);
	echo $record['username'];
	
	$userSet = User::findAll();
	while ($user = $database->fetch_array($userSet)) {
		echo "User: " . $user['username'] . "<br />";
		echo " Name: " . $user['firstName'] . " " . $user['lastName'] . "<br /> <br />";
	}
	*/
?>