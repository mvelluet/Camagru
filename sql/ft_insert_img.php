<?php  
function ft_insert_img($pathname)
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("INSERT INTO `IMAGE`(`IMG_URL`,`IMG_DATE`,`UTI_ID`) VALUES ('" . $pathname . "','" . date('Y/m/d')."','" . $_SESSION['USER'] . "');"); 
	$stmt->execute();
	$conn = null;
}
?>