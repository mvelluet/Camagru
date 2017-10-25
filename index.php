<?php
session_start();

// ini_set('display_errors','on');
// error_reporting(E_ALL);
// date_default_timezone_set('Europe/Paris');

$repo = "";
$d = getcwd();
$repo = substr($d, 31);
$_SESSION['Dossier_source'] = $repo;
// "http://localhost:8080/". $_SESSION['Dossier_source'] ."/index.php";

include 'sql/ft_connexion.php';
include 'sql/ft_check_user_exist.php';
include 'php/ft_crypt_pwd.php';

if (isset($_POST['UTI_NOM']) && isset($_POST['UTI_PWD'])) 
{
	$_SESSION['LOG'] = 0;
	$tab = ft_check_user_exist();
	$_SESSION['LOG'] = $tab[0];
	$erreur = $tab[1];
	if ($_SESSION['LOG'] === TRUE)
	{
		header('location: profil.php');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta charset="utf-8">
	<title>Camagru | Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body class="a_body">
	<main class="a_main">
		<h1 class="a_h1"><a style="color: white; text-decoration: none;" href="index.php">Camagru</a></h1>
		<div class="a_inscription_connexion">
			<div class="a_connexion">
				<fieldset >
					<form method="POST" action="index.php">
						<h4>Connexion</h4>
						<label for="UTI_NOM">Login : </label><br>
						<input type="text" name="UTI_NOM" id="UTI_NOM"><br>
						<br>
						<label for="UTI_PWD">Mot de passe : </label><br>
						<input type="password" name="UTI_PWD" id="UTI_PWD"><br>
						<a href="reset.php" style="font-size: 10px">Mot de passe oublié</a>
						<br>
						<br>

						<button>Connexion</button>
						<br>
						<br>
						<a href="inscription.php">Pas inscrit ?</a>
						<p style="color: red;">
						<?php 
							if (!empty($erreur))
							{
								echo $erreur;
							}
							if (!empty($_GET['info'])) 
							{
								echo $_GET['info'];
							}
						?>
						</p>
						<a href="galerie.php" style="">Voir la Galerie</a>
					</form>
				</fieldset>
			</div>
		</div>
	</main>
</body>
</html>
