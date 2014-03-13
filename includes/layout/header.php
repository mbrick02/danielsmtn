<?php
	// for now we will keep the title: Daniel's Mountain
	// but later we may need to capture the page title on the header.php call
	$hdTitle = htmlentities("Daniel's Mountain");
?>
<?php 
	if (!isset($layoutContext )) {
		$layoutContext = "public";
	}
	
	switch ($layoutContext) {
		case 'admin':
			$titleSuffix = " - Admin Page";
			break;
			
		case 'chef':
				$titleSuffix = " - Chef Page";
				break;
				
		default:
			$titleSuffix = " (**" . $layoutContext . " context)";
	}
	
	$hdTitle = $hdTitle . htmlentities($titleSuffix);
	
	if (strpos(getcwd(), "admin")){
		$relStyleDir = "../../public/stylesheets/";
	} else {
		$relStyleDir = "../public/stylesheets/";
	}
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=MacRoman">
	<meta name="author" content="bricklerml" />

  	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
  	
	<script type="text/javascript" src="../../public/javascripts/modernizr-1.7.js"></script>
	<!-- ***probably need to update this to google -->
	<script type="text/javascript" src="../../public/javascripts/jquery-1.5.1.js"></script>
	<!-- script type="text/javascript" src="../../public/javascripts/placholder.js"></script -->
	
	<!-- ** if working from admin add ../ **use php getcwd() if has admin do set that way otherwise assume public -->
	<link href="<?php echo $relStyleDir ?>danmtn.css" media="all" rel="stylesheet" type="text/css"> 
	<title>Usufruct Dishes</title>
</head>
<body>
<header>
	<h1 id="pageTitle"><?php echo $hdTitle; ?></h1>
</header>