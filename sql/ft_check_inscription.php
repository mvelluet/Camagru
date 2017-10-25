<?php 
function ft_check_inscription()
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM UTILISATEUR"); 
	$stmt->execute();
	$res = $stmt->fetchAll();
	if (isset($res))
	{
		foreach ($res as $key => $value) 
		{
			if ($value['UTI_NOM'] === strtolower($_POST['UTI_NOM']))
			{
				return (1);
			}
			if ($value['UTI_MAIL'] === strtolower($_POST['UTI_MAIL'])) 
			{
				$dbh = null;
				return (2);
			}	
		}
		$dbh = null;
		return (3);
	}
	$dbh = null;
}
?>