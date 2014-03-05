<?php
	require_once('./initialize.php');
	// require_once('./database.php');
	// echo "<br /><br />Current Dir: " . getcwd();
	
	echo $db->escapeValue("<br />It's working?<br />");
	

	
	$user = User::findByID(1);
	echo "<br />User Last Name: " . $user->lName;
	
	
	// ***probably won't work instantiate private: $user = User::instantiate($record);
	$user->mbusertest();
	/*	
	echo $user->['fname'];
	
	// Note: if we had Object methods, would have to instantiate: $User = new User();
	$record = $User::findByID(1);
	echo $record['username'];
	
	$userSet = User::findAll();
	foreach ($users as $user) {
		echo "User: " . $user->username . "<br />";
		echo " Name: " . $user->fullName() . "<br /> <br />";
	}
	*/
?>