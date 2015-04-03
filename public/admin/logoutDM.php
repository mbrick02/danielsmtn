<?php
require_once('../../includes/initialize.php');

$session->logout();
redirectTo("loginDM.php");
?>