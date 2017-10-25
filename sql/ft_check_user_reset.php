<?php  
function ft_check_user_reset()
{
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM UTILISATEUR"); 
	$stmt->execute();
	$res = $stmt->fetchAll();

	if (isset($_POST['UTI_NOM'])) 
	{
		$nom = strtolower($_POST['UTI_NOM']);
	}
	else
	{
		$nom = "";
	}
	if (isset($_POST['UTI_MAIL'])) 
	{
		$mail = strtolower($_POST['UTI_MAIL']);
	}
	else
	{
		$mail = "";
	}
	if (!empty($res))
	{
		foreach ($res as $key => $value) 
		{
			if (!strcmp($value['UTI_NOM'],$nom))
			{
				$conn = null;
				return (array(TRUE, "Un e-mail de réinitialisation a été envoyé"));
			}
			if (!strcmp($value['UTI_MAIL'], $mail))
			{	
				$conn = null;
				return (array(TRUE, "Un e-mail de réinitialisation a été envoyé"));
			}
		}
	}
	$conn = null;
	return (array(FALSE, "Aucun utilisateur ne correspond"));
}
?>