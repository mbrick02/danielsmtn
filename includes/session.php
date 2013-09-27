<?php 
	session_start();

	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">" . htmlentities($_SESSION["message"]) ."</div>";
			
			// Clear Message
			$_SESSION["message"] = null;
			return $output;
		}
	}
	
	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// Clear errors after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
?>