<?php
// initialize.php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

$homePCDir = "C:".DS."xampp".DS."htdocs".DS."danielsmtn";
$workMacDir = DS.'Applications'.DS.'XAMPP'.DS.'xamppfiles'.DS.'htdocs'.DS.'danielsmtn';
// note looks to be same as  home: getcwd is $workPC = "C:\xampp\htdocs\danielsmtn\includes"
$curDir = getcwd();

$currentComputer = $curDir;  // initialize to curDir
// $currentComputer = "workMac";
// $currentComputer = "workPC";
// $currentComputer = "homePC";
// had addendum from home PC that is not showing up in Git
// $currentComputer = "homeCentOS";
// $currentComputer = ...android, phone, iPad...


if (strstr($curDir, $homePCDir)) {
	$currentComputer =  "homePC";
} else if (strstr($curDir, $workMacDir)) {
	$currentComputer =  "workMac";;
}

// if cwd contains ApplicationDSXAMPP then currentComputer is workMac else if cwd contains "C:\xampp\htdocs\danielsmtn" then is homePC



switch ($currentComputer) {
case "workMac":
	$siteStr = DS.'Applications'.DS.'XAMPP'.DS.'xamppfiles'.DS.'htdocs'.DS.'danielsmtn'.DS.'danielsmtn';
	break;

case "homePC":
	// C:\xampp\htdocs\danielsmtn\includes
	// $homePCDir = DS."xampp".DS."htdocs".DS."danielsmtn";
	$siteStr =  DS."xampp".DS."htdocs".DS."danielsmtn";
	break;
	
case "workPC":
	// ************NEED to double check this ********************
	// C:\xampp\htdocs\danielsmtn\includes
	// $homePCDir = DS."xampp".DS."htdocs".DS."danielsmtn";
	$siteStr =  DS."xampp".DS."htdocs".DS."danielsmtn";
	break;	 
	
default:
	// assuming home linux box
	$siteStr = DS.'Users'.DS.'site'.DS.'danielsmtn';
	$output = "Not sure which PC this is, so assuming Linx box with web folder: <br />" . $siteStr;
	$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
	echo $output;
}


defined('SITE_ROOT') ? null : define('SITE_ROOT', $siteStr);

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// echo "Test of Current Working Directory: ";
// echo getcwd() . "<br />";
// workMac: /Applications/XAMPP/xamppfiles/htdocs/danielsmtn/danielsmtn/includes
// Test lib path:
// echo "LibPath: " . LIB_PATH;

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic function next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
// ** if >PHP5.3 late static binding for methods & vars: require_once(LIB_PATH.DS.'databaseObject.php');
// ** for page x of y: require_once(LIB_PATH.DS.'pagination.php');

// load database-related classes
// **0115 require_once(LIB_PATH.DS.'datbaseObject.php');
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'form.php');

?>