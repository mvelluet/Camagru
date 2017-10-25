<?php
function ft_list_galerie($begin)
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM IMAGE ORDER BY IMG_ID DESC LIMIT 5 OFFSET " . $begin . "");
	$stmt->execute();
	$res = $stmt->fetchAll();
	$conn = null;
	return ($res);
}
?>