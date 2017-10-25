<?php 
function ft_send_mail($UTI_NOM, $UTI_MAIL, $UTI_CLE)
{	
	$to = $UTI_MAIL;
	$subject = "Mail de confirmation Camagru";
	
	$message = "Bonjour pour confirmer la création de votre compte clicker sur le lien ci-dessous

	http://localhost:8080/" . $_SESSION["Dossier_source"] . "/confirmation.php?NOM=".urlencode($UTI_NOM)."&CLE=".urlencode($UTI_CLE);

	mail($to , $subject , $message);
}
?>