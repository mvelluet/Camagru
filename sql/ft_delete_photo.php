<?php 
session_start();

include '../config/database.php';
$conn = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("DELETE FROM `IMAGE` WHERE `IMG_URL` = ? AND `UTI_ID` = ?"); 
$stmt->execute(array($_GET["img"], $_SESSION['USER']));
$conn = null;
header('location: ../profil.php');
?>