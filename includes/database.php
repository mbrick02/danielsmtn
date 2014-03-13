<?php
require_once("initialize.php");
require_once(LIB_PATH.DS."config.php");

class MySQLDatabase {

	private $connection;
	private $lastQuery;
	// *** private $magic_quotes_active;
	// *** private $real_escape_string_exists;

	// Note: __construct is only run once,
	// 	so it is a good place to do checks that may required later by other methods
	function __construct() {
		$this->openConnection();
		$this->lastQuery = "";  // I added this well after 'PHP Beyond Basics' ?*?* default value?***
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
			mysqli_close($this->connection);
			// unset($this->connection);
		}
	}
	
	public function query($query){
		$this->lastQuery = $query;
		$result = mysqli_query($this->connection, $query);
		// collected in $result resource; note reverse order from mysql()
		$this->confirmQuery($result);
		return $result;
	}
	
	private function confirmQuery($result) {
		if (!$result) {
			$output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
			// only use for development: $output .= "Last SQL query: " . $this->lastQuery;
			die($output);
		}
	}
	
	// *** instead of public function mysqlPrep($string) {... (not db agnostic)
	public function escapeValue($string) {
		// *** PHP < v5 (next 2 lines probably not necessary (look 'em up if needed)
		// if ($this->real_escape_string_exists).
		// if (!$this->magic_quotes_active).
	
		$escaped_string = mysqli_real_escape_string($this->connection, $string);
		return $escaped_string;
	}
	
	public function numb_rows($result_set) {
		return mysqli_numb_rows($result_set);
	}
	
	public function insertID() {
		// get the last id inserted over the current db connection
		return mysqli_insert_id($this->connection);
	}
	
	public function affectedRows() {
		return mysqli_affected_rows($this->connection);
	}
	
	// idea is to make function names so that they will be the same
	//  for database objects of different types of databases
	// (probably?) this will lead to an overall database object that each type of database
	//          has extended object for; such as MySQLDatabase extended from Database
	public function fetchArray($result) {
		return mysqli_fetch_assoc($result);
	}
}
// note: this allows us options of alternate db classes (e.g. class OracleDatabase)
// ** see "Making Database … Agnostic below

$database = new MySQLDatabase();
// if you want a shortcut/alias reference:
$db =& $database;
//  if we want to close it: $database->closeConnection();

?>