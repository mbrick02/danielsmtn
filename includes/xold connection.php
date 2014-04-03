<?php
// ***NOT USED was in old (Non-object) concept instead of config.php and database.php
// put in safe/inaccessible file (especially pw)
// localhost version:
define("DB_SERVER", "localhost");
define("DB_USER", "mbrick02");
define("DB_PASS", "Job4Fau");
define("DB_NAME", "usufructdish");

// danielsmountain.org version:
// define("DB_SERVER", "mysql-usufructdish.danielsmountain.org");

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno()){
	die("DB connect failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>