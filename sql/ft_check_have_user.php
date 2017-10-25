<?php  
function ft_check_have_user()
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM UTILISATEUR"); 
	$stmt->execute();
	$res = $stmt->fetchAll();
	if (isset($res)) 
	{
		$conn = null;
		return (TRUE);
	}
	else
	{
		$conn = null;
		return (FALSE);
	}
}