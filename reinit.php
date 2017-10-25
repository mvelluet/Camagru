<?php
session_start();
include 'php/ft_check_dic_pwd.php';
include 'php/ft_crypt_pwd.php';
include 'sql/ft_connexion.php';

if (!empty($_POST['UTI_PWD']) && !empty($_POST['UTI_PWD_AGAIN']))
{
	$pwd = $_POST['UTI_PWD'];
	$check = ft_check_dic_pwd($pwd);
	$pwd = ft_crypt_pwd($_POST['UTI_PWD']);

	if (!$check) 
	{
		header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/reinitialisation.php?annuler=' . $_SESSION['G_ANN'] . '&NOM=' . $_SESSION['G_NOM'] . '&CLE=' . $_SESSION['G_CLE'] .'&MESSAGE=Vous ne pouvez pas utiliser un mot <br>qui existe dans le dictionnaire');
			exit();
	}
	else if (strlen($_POST['UTI_PWD']) < 7) 
	{
		header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/reinitialisation.php?annuler=' . $_SESSION['G_ANN'] . '&NOM=' . $_SESSION['G_NOM'] . '&CLE=' . $_SESSION['G_CLE'] .'&MESSAGE=le mot de passe est trop court 7 <br>caractères au minimum');
			exit();

	}
	else if (strcmp($_POST['UTI_PWD'], $_POST['UTI_PWD_AGAIN'])) 
	{
		header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/reinitialisation.php?annuler=' . $_SESSION['G_ANN'] . '&NOM=' . $_SESSION['G_NOM'] . '&CLE=' . $_SESSION['G_CLE'] .'&MESSAGE=les mots de passes sont différents');
			exit();

	}
	$UTI_CLE = md5(microtime(TRUE)*154823);

	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("UPDATE UTILISATEUR SET UTI_CLE=?, UTI_PWD=? WHERE UTI_NOM=? AND UTI_CLE=?"); 
	$stmt->execute(array($UTI_CLE, $pwd, $_SESSION['G_NOM'], $_SESSION['G_CLE']));
	$conn = null;
	header('location: index.php');
}
else
{
	header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/reinitialisation.php?annuler=' . $_SESSION['G_ANN'] . '&NOM=' . $_SESSION['G_NOM'] . '&CLE=' . $_SESSION['G_CLE'] .'&MESSAGE=Vous devez renseigner les deux champs');
		exit();
}
header('location: index.php');
?>