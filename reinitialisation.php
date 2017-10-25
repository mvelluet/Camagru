<?php
session_start();
include 'sql/ft_connexion.php';
include 'php/ft_check_dic_pwd.php';

if (isset($_GET['annuler']) && isset($_GET['NOM']) && isset($_GET['CLE']))
{
	if (strcmp($_GET['annuler'], "non"))
	{
		$UTI_CLE = md5(microtime(TRUE)*114223);
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("UPDATE UTILISATEUR SET UTI_CLE=? WHERE UTI_NOM=? AND UTI_CLE=?"); 
		$stmt->execute(array($UTI_CLE, $_GET['NOM'], $_GET['G_CLE']));
		$conn = null;
		header('location: index.php');
	}
	else
	{
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare(" SELECT * FROM `UTILISATEUR` WHERE UTI_NOM=? AND `UTI_CLE` = ? "); 
		$stmt->execute(array($_GET['NOM'], $_GET['CLE']));
		$res = $stmt->fetch();
		$conn = null;
		
		$_SESSION['G_ANN'] = $_GET['annuler'];
		$_SESSION['G_NOM'] = $_GET['NOM'];
		$_SESSION['G_CLE'] = $_GET['CLE'];

		if (isset($res['UTI_CLE']))
		{
				echo '<!DOCTYPE html>
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
							<fieldset>
								<form method="POST" action="reinit.php">
									<h4>Réinitialisation</h4>
									<label for="UTI_PWD">Nouveau mot de passe : </label><br>
									<input type="password" name="UTI_PWD" id="UTI_PWD" value="">
									<br><br>
									<label for="UTI_PWD_AGAIN">Encore une fois : </label><br>
									<input type="password" name="UTI_PWD_AGAIN" id="UTI_PWD_AGAIN" value="">
									<br><br>
									<button>Reset</button>
									<br>
									<br>
									<p style="color: red;">';
										if (isset($_GET["MESSAGE"])) 
										{
											echo $_GET["MESSAGE"];
										}
									echo '</p>
								</form>
							</fieldset>
						</div>
					</div>
				</main>
			</body>
			</html>';
		}
		else
		{
			session_start();
			session_destroy();
			header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/index.php');
			exit();
		}
	}
}
else
{
	session_start();
	session_destroy();
	header('location: http://localhost:8080/'.$_SESSION["Dossier_source"].'/index.php');
	exit();
}
?>