<?php
    // 1. Create a database connection
    $connection = mysql_connect("localhost","root", "Job4Fau");
    if (!$connection) {
    	die("Database connection failed" . mysql_error());
    }
    
    // 2. Select a database to use
    $db_select = mysql_select_db("widget_corp",$connection);
    if (!$db_select) {
    	die("Database selection failed" . mysql_error());
    }
?>
<html lang="en">
<head>
	<title>Basic</title>
</head>
<body>
	<p>Basic</p>
	<?php 
	// 3. Perform database query
	$result = mysql_query("SELECT * FROM subjects", $connection);
	if (!$result) {
		die("Database query failed" . mysql_error());
	}
	
	echo "stone";
	
	// 4. Use returned data
	while ($row = mysql_fetch_array($result)) {
		echo "stone" . $row[1];
	}
	?>
</body>
</html>
<?php 
	// 5. Close connection
	mysql_close($connection);
?>