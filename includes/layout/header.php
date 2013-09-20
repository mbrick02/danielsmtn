<?php
	// for now we will keep the title: Daniel's Mountain
	// but later we may need to capture the page title on the header.php call
	$hdTitle = htmlentities("Daniel's Mountain");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=MacRoman">
	<meta name="author" content="bricklerml" />

  	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
  	
	<script type="text/javascript" src="./includes/modernizr-1.7.js"></script>
	<script type="text/javascript" src="./includes/jquery-1.5.1.js"></script>
	<script type="text/javascript" src="./includes/placholder.js"></script>
	
	<link href="./includes/u2013.css" media="all" rel="stylesheet" type="text/css"> 
	<title>Usufruct Dishes</title>
</head>
<body>
<header>
	<h1 id="pageTitle"><?php echo $hdTitle; ?></h1>
</header>