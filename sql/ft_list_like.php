<?php  
function ft_list_like($IMG_ID, $UTI_ID)
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM `AIME` WHERE IMG_ID=? AND UTI_ID=?"); 
	$stmt->execute(array($IMG_ID, $UTI_ID));
	$res = $stmt->fetchAll();
	if (isset($res))
	{
		$conn = null;
		return ($res);
	}
}
?>