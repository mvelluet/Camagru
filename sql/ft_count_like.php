<?php  
function ft_count_like($IMG_ID)
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT SUM(AIM_ACTIF) as 'COUNT_LIKE' FROM `AIME` WHERE IMG_ID=?"); 
	$stmt->execute(array($IMG_ID));
	$res = $stmt->fetchAll();
	if (isset($res))
	{
		$conn = null;
		return ($res);
	}
}
?>