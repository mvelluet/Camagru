<?php
session_start();
include 'sql/ft_connexion.php';
include 'sql/ft_check_user_reset.php';
include 'sql/ft_send_mail_reset.php';

if (empty($_POST['UTI_NOM']) && empty($_POST['UTI_MAIL'])) 
{
	if (isset($_POST['UTI_NOM']) && isset($_POST['UTI_MAIL'])) 
	{
		$info = "Renseignez au moins un champ s'il vous plait";
	}
}
else if (isset($_POST['UTI_NOM']))
{
	$tabr = ft_check_user_reset();
	$info = $tabr[1];
	if ($tabr[0]) 
	{
		ft_send_mail_reset();
	}
}
else if (filter_var($_POST['UTI_MAIL'], FILTER_VALIDATE_EMAIL)) 
{
	if (isset($_POST['UTI_MAIL'])) 
	{
		$tabr = ft_check_user_reset();
		$info = $tabr[1];
		if ($tabr[0]) 
		{
			ft_send_mail_reset();
		}
	}
}
else
{
	if (isset($_POST['UTI_MAIL']))
	{
		$info = "Cette adresse email n'est pas valide.";
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
					<form method="POST" action="reset.php">
						<h4>Reset</h4>
						<label for="UTI_NOM">Login : </label><br>
						<input type="text" name="UTI_NOM" id="UTI_NOM" value="">
						<br><br>
						<label for="UTI_MAIL">E-Mail : </label><br>
						<input type="email" name="UTI_MAIL" id="UTI_MAIL" value="">
						<br><br>
						<button>Reset</button>
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
				</fieldset>
			</div>
		</div>
	</main>
</body>
</html>