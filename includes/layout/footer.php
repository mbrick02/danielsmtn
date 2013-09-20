<?php

?>
	<footer>Copyright 20<?php date("Y"); ?></footer>
</body>
</html>
<?php 
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>