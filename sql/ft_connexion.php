<?php 
function ft_connexion()
{	
	include 'config/database.php';
try {
		$conn = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
		return ($conn);
	}
	catch (PDOException $e) 
	{
		$conn = null;
		session_destroy();
		header('location: index.php');
    	die();
	}
}
?>