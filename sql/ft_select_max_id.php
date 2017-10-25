<?php
function ft_select_max_id()
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT MAX(IMG_ID) FROM IMAGE"); 
	$stmt->execute();
	$res = $stmt->fetchAll();
	$conn = null;
	return ($res[0][0]);
}
?>