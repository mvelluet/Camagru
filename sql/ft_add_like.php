<?php
session_start();
function ft_connexion()
{	
	include '../config/database.php';
	$conn = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
	return ($conn);
}
if (isset($_GET['IMG_ID']) && isset($_GET['UTI_ID']))
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM AIME WHERE IMG_ID = ? AND UTI_ID = ?"); 
	$stmt->execute(array($_GET['IMG_ID'], $_GET['UTI_ID']));
	$res = $stmt->fetchAll();
	if (empty($res)) 
	{
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("INSERT INTO `AIME`(`AIM_ACTIF`,`IMG_ID`,`UTI_ID`) VALUES (?,?,?);");
		$stmt->execute(array("1", $_GET['IMG_ID'], $_GET['UTI_ID']));
		$conn = null;	
	}
	else if ($res[0]['AIM_ACTIF'] === "1")
	{
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("UPDATE `AIME` SET AIM_ACTIF='0' WHERE IMG_ID = ? AND UTI_ID = ?;");
		$stmt->execute(array($_GET['IMG_ID'], $_GET['UTI_ID']));
		$conn = null;	
	}
	else
	{
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("UPDATE `AIME` SET AIM_ACTIF='1' WHERE IMG_ID = ? AND UTI_ID = ?;");
		$stmt->execute(array($_GET['IMG_ID'], $_GET['UTI_ID']));
		$conn = null;	
	}
}
header('location: ../galerie.php');
?>