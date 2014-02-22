<?php
// file should be called through initialize.php allowing LIB_PATH.DS
require_once(LIB_PATH.DS."config.php");

class MySQLDatabase {

	private $connection;
	// *** private $magic_quotes_active;
	// *** private $real_escape_string_exists;

	// Note: __construct is only run once,
	// 	so it is a good place to do checks that may required later by other methods
	function __construct() {
		$this->openConnection();
		// *** we probaly dont need to worry about this since working only with MySQL >5
		// $this->magic_quotes_active = get_magic_quotes_gpc();
		// $this->real_escape_string_exists = function_exists("mysql_real_escape_string");
	}

	public function openConnection() {
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

		// Test if connection succeeded
		if(mysqli_connect_errno()) {
			die("Database connection failed: " .
					mysqli_connect_error() .
					" (" . mysqli_connect_errno() . ")");
		}
	}

	public function closeConnection() {
		if (isset($this->connection)) {
			mysqli_close($this->$connection);
			// unset($this->connection);
		}
	}

}
// note: this allows us options of alternate db classes (e.g. class OracleDatabase)
// ** see "Making Database … Agnostic below

$database = new MySQLDatabase();
// if you want a shortcut/alias reference:
$db =& $database;
//  if we want to close it: $database->closeConnection();
?>