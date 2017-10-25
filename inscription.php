<?php 
session_start();
include 'sql/ft_check_inscription.php';
include 'sql/ft_register_user.php';
include 'sql/ft_connexion.php';
include 'php/ft_crypt_pwd.php';
include 'php/ft_send_mail.php';
include 'php/ft_check_dic_pwd.php';
include 'php/ft_parse_erreur_inscription.php';

if (isset($_POST['UTI_MAIL']))
{
	if (filter_var($_POST['UTI_MAIL'], FILTER_VALIDATE_EMAIL)) 
	{
		if (isset($_POST['UTI_NOM']) && isset($_POST['UTI_PWD']) && isset($_POST['UTI_MAIL'])) 
		{
			$_SESSION['UTI_NOM'] = $_POST['UTI_NOM'];
			$_SESSION['UTI_MAIL'] = $_POST['UTI_MAIL'];
			$info = ft_parse_erreur_inscription();
		}
	}
	else
	{
		if (isset($_POST['UTI_MAIL']))
		{
			$info = "Cette adresse email n'est pas considérée comme valide.";
		}
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
					<form method="POST" action="inscription.php">
						<h4>Inscription</h4>
						<label for="UTI_NOM">Login : </label><br>
						<?php  
						echo '<input type="text" name="UTI_NOM" id="UTI_NOM" value="'; if (isset($_SESSION['UTI_NOM'])){echo $_SESSION['UTI_NOM'];}
						echo '"><br><br>';
						echo '<label for="UTI_PWD">Mot de passe : </label><br>';
						echo '<input type="password" name="UTI_PWD" id="UTI_PWD"><br><br>';
						echo '<label for="UTI_MAIL">E-Mail : </label><br>';
						echo '<input type="email" name="UTI_MAIL" id="UTI_MAIL" value="'; if (isset($_SESSION['UTI_MAIL'])){echo $_SESSION['UTI_MAIL'];} 
						echo '"><br><br>';
						?>
						<button>Valider</button>
						<br>
						<br>
						<p style="color: red;">
							<?php  
							if (!empty($info)) 
							{
								echo $info;
							}
							?>
						</p>
					</form>
					<a href="index.php">Se connecter ?</a>
				</fieldset>
			</div>
		</div>
	</main>
</body>
</html>