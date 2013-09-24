<?php

?>
	<footer>Copyright <?php echo date("Y"); ?></footer>
</body>
</html>
<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>