<?php 
session_start();
include 'sql/ft_connexion.php';

if (isset($_GET['NOM']) && isset($_GET['CLE']))
{
	$UTI_NOM = $_GET['NOM'];
	$UTI_CLE = $_GET['CLE'];

	$conn = ft_connexion();
	$stmt = $conn->prepare("SELECT UTI_CLE, UTI_NOM, UTI_ACTIF FROM UTILISATEUR WHERE UTI_NOM=?");
	$stmt->execute(array($UTI_NOM));
	$res = $stmt->fetch();

	if(isset($res))
	{
		if($res['UTI_ACTIF'] === '1')
		{
			header('location: index.php?info=Votre compte est déjà activé !');
		}
		else
		{
			if($UTI_CLE === $res['UTI_CLE'])
			{
				$stmt = $conn->prepare("UPDATE UTILISATEUR SET UTI_ACTIF='1' WHERE UTI_NOM=?");
				$stmt->execute(array($UTI_NOM));
				$conn = null;
				header('location: index.php?info="Votre compte a bien été activé !"');
			}
			else
			{
				header('location: index.php?info="Erreur ! Votre compte ne peut être activé..."');
			}
		}
	}
}
?>