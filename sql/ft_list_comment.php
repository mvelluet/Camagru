<?php  
function ft_list_comment($IMG_ID)
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * 
FROM `COMMENTAIRE` c 
INNER JOIN IMAGE i ON i.IMG_ID = c.IMG_ID
INNER JOIN UTILISATEUR u ON u.UTI_ID = c.UTI_ID
WHERE i.IMG_ID = ?");
	$stmt->execute(array($IMG_ID));
	$res = $stmt->fetchAll();
	$conn = null;
	return ($res);
}
?>