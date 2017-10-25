<?php 
function ft_check_user_exist()
{
	ini_set('display_errors','on');
	error_reporting(E_ALL);
	date_default_timezone_set('Europe/Paris');

	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM UTILISATEUR"); 
	$stmt->execute();
	$res = $stmt->fetchAll();

	$nom = strtolower($_POST['UTI_NOM']);
	$pass = ft_crypt_pwd($_POST['UTI_PWD']);
	if (!empty($res))
	{
		foreach ($res as $key => $value) 
		{
			if (!strcmp($value['UTI_NOM'],$nom))
			{
				if (!strcmp($value['UTI_PWD'], $pass))
				{
					if ($value['UTI_ACTIF'] === "1") 
					{
						$_SESSION['USER'] = $value['UTI_ID'];
						$conn = null;
						return (array(TRUE, "Connexion valide !"));
					}
					$conn = null;
					return (array(FALSE, "Vous devez valider votre e-mail"));
				}
				$conn = null;
				return (array(FALSE, "Mot de passe ou Utilisateur inconnu"));
			}
		}
		$conn = null;
		return (array(FALSE, "Mot de passe ou Utilisateur inconnu"));
	}
	$conn = null;
	return (array(FALSE, "Aucun utilisateur enregistré"));
}
?>