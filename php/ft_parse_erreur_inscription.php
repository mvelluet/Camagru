<?php  
function ft_parse_erreur_inscription()
{
	$pwd = $_POST['UTI_PWD'];
	if (strlen($_POST['UTI_PWD']) < 7) 
	{
		return ("le mot de passe est trop court 7 <br>caractères au minimum");
	}
	$check = ft_check_dic_pwd($pwd);
	if (!$check) 
	{
		return ("Vous ne pouvez pas utiliser un mot <br>qui existe dans le dictionnaire");
	}
	if (strlen($_POST['UTI_NOM']) < 3) 
	{
		return ("le nom d'utilisateur est trop court");
	}
	$check = ft_check_inscription();
	if ($check === 1) 
	{
		return ("le nom existe deja");
	}
	if ($check === 2) 
	{
		return ("le mail existe deja");
	}
	if ($check === 3) 
	{
		$_SESSION['UTI_NOM'] = "";
		$_SESSION['UTI_MAIL'] = "";
		ft_register_user();
		return ("Un email de confirmation vient d'être envoyé !");
	}
}
?>
