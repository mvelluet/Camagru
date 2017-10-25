<?php 
function ft_send_mail_reset()
{	
	$UTI_NOM = strtolower($_POST['UTI_NOM']);
	$UTI_MAIL = strtolower($_POST['UTI_MAIL']);
	$UTI_CLE = md5(microtime(TRUE)*154223);
	
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare(" SELECT UTI_NOM, UTI_MAIL FROM `UTILISATEUR` WHERE `UTI_NOM` = ? OR `UTI_MAIL`= ?"); 
	$stmt->execute(array($UTI_NOM, $UTI_MAIL));
	$res = $stmt->fetch();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("UPDATE UTILISATEUR SET UTI_CLE=? WHERE UTI_NOM=?"); 
	$stmt->execute(array($UTI_CLE, $res['UTI_NOM']));
	$conn = null;
	$to = $res['UTI_MAIL'];
	$subject = "Réinitialisation du mot de passe Camagru";
	
	$message = "Bonjour,

	Cliquez sur le lien pour réinitialiser votre mot de passe :

	http://localhost:8080/".$_SESSION["Dossier_source"]."/reinitialisation.php?annuler=non&NOM=".urlencode($res['UTI_NOM'])."&CLE=".urlencode($UTI_CLE)."

	Ce n'est pas vous qui avez demandé cette réinitialisation ?

	Cliquez sur ce lien :

	http://localhost:8080/".$_SESSION["Dossier_source"]."/reinitialisation.php?annuler=oui&NOM=".urlencode($res['UTI_NOM'])."&CLE=".urlencode($UTI_CLE);

	mail($to , $subject , $message);
}
?>