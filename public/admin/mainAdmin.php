<?php
// "index.php" in admin, so we have to navigate up 2 parent folders to get to includes
require_once('../../includes/initialize.php');
// require_once(LIB_PATH.DS.'session.php');

if (!$session->isLoggedIn()) { redirectTo("loginDM.php"); }
?>
<html>
	<head>
		<title>Daniels Mountain</title>
		<link href="stylesheets/danmtn.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<header>
		<nav>
			<h1>Daniel&apos;s Mountain </h1>
			<a href="DMImage.html">DM Images</a>
			<a href="usufruct.html">Usufruct</a>
			<a href="AtDanielsMtn.html">At Daniel&rsquo;s Mountain</a>
			<a href="DMtn.html">DMtn</a>
		</nav>
	</header>

		<div id="main">
		<h2>Menu</h2>

		<footer>Copyright<?php echo date("Y", time()); ?>, MBviaSkog</footer>
	</body>
</html>
?>