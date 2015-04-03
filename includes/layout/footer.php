<?php
  // not sure if there needs to be something before the footer tag???
?>
	<footer><br/> <br />Copyright <?php echo date("Y"); ?></footer>
</body>
</html>
<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>