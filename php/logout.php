<?php
	session_start();
	session_destroy();
	header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/index.php');
	exit();
?>