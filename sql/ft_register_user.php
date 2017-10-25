<?php 
function ft_register_user()
{
	$UTI_NOM = strtolower($_POST['UTI_NOM']);
	$UTI_PWD = ft_crypt_pwd($_POST['UTI_PWD']);
	$UTI_MAIL = strtolower($_POST['UTI_MAIL']);
	$UTI_CLE = md5(microtime(TRUE)*154723);;
	$UTI_ACTIF = 0;
	
	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("
		INSERT INTO `UTILISATEUR`
		(
		`UTI_NOM`,
		`UTI_PWD`,
		`UTI_MAIL`,
		`UTI_CLE`,
		`UTI_ACTIF`
		 ) 

		VALUES (?, ?, ?, ?, ?);"); 
	$stmt->execute(array($UTI_NOM, $UTI_PWD, $UTI_MAIL, $UTI_CLE, $UTI_ACTIF));
	$conn = null;
	ft_send_mail($UTI_NOM, $UTI_MAIL, $UTI_CLE);
}
?>