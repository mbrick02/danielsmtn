<?php
// initialize.php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

$currentComputer = "workMac";
// $currentComputer = "workPC";
// $currentComputer = "homePC";
// had addendum from hope PC that is not showing up in Git
// $currentComputer = "homeCentOS";
// $currentComputer = ...android, phone, iPad...


switch ($currentComputer) {
case "workMac":
	$siteStr = DS.'Applications'.DS.'XAMPP'.DS.'xamppfiles'.DS.'htdocs'.DS.'danielsmtn'.DS.'danielsmtn';
	break;
	
default:
	// linux
	$siteStr = DS.'Users'.DS.'site'.DS.'danielsmtn';
}

defined('SITE_ROOT') ? null : define('SITE_ROOT', $siteStr);

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// echo "Test of Current Working Directory: ";
// echo getcwd() . "<br />";
// workMac: /Applications/XAMPP/xamppfiles/htdocs/danielsmtn/danielsmtn/includes
// Test lib path:
echo "LibPath: " . LIB_PATH;
/*
// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic function next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'databaseObject.php');
require_once(LIB_PATH.DS.'pagination.php');

// load database-related classes
require_once(LIB_PATH.DS.'user.php');
*/
?>