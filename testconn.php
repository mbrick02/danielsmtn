<?php
// save below as db_connection.php and put in safe/inaccessible file (especially pw)
define("DB_SERVER", "mysql-usufructdish.danielsmountain.org");
define("DB_USER", "mbrick02");
define("DB_PASS", "Job4Fau");
define("DB_NAME", "usufructdish");
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno()){
	die("DB connect failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
} else {
	echo "DMDB connected";
}

?>