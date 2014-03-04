<?php
	require_once('./initialize.php');
	// require_once('./database.php');
	// echo "<br /><br />Current Dir: " . getcwd();
	
	echo $db->escapeValue("<br />It's working?<br />");
	

	
	$user = User::findByID(1);
	echo "User First Name: " . $user->fName;
	
	
	// ***probably won't work instantiate private: $user = User::instantiate($record);
	// $user->mbusertest();
	/*	
	echo $user->['fname'];
	
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