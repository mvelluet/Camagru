<?php
session_start();
include 'sql/ft_connexion.php';
include 'sql/ft_list_galerie.php';
include 'sql/ft_list_comment.php';
include 'sql/ft_list_like.php';
include 'sql/ft_count_like.php';

$conn = ft_connexion();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT COUNT(*) FROM IMAGE");
$stmt->execute();
$total = $stmt->fetchAll();
$conn = null;

$nb_img = $total[0][0];
$max_img_par_page = 5;

if ($nb_img > $max_img_par_page) 
{
	$nb_de_page = ceil($nb_img / $max_img_par_page);
}
else
{
	if ($nb_img != 0) 
	{
		$nb_de_page = 1;
	}
}

if ($_GET['page'] > $nb_de_page || $_GET['page'] < 0) 
{
	header('location: galerie.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta charset="utf-8">
	<title>Camagru | galerie</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body class="p_body">
	<header class="p_header">
		<h1 class="p_h1"><a href="profil.php">CAMAGRU</a></h1>
		<h3 class="p_h_profils p_deco"><a href="php/logout.php">Deconnexion</a></h3>
		<h3 class="p_h_profils"><a href="galerie.php">Galerie | </a></h3>
		<h3 class="p_h_profils p_profil"><a href="profil.php">Profil | </a></h3>
	</header>
	<br>
	<main class="g_main">
		<?php
		if (isset($nb_de_page) > 0) 
		{
			if (isset($_GET['page'])) 
			{
				if ($_GET['page'] <= $nb_de_page) 
				{
					$begin = ($max_img_par_page * ($_GET['page'] - 1) + 1);
					$end = $max_img_par_page * $_GET['page'];
					if ($_GET['page'] === "1") 
					{
						$begin = 0;
						$res = ft_list_galerie($begin);
						echo '<a href="galerie.php?page=' . ($_GET['page'] + 1) . '">Suivante</a>';
					}
					else
					{
						$res = ft_list_galerie($begin);
						echo '<a href="galerie.php?page=' . ($_GET['page'] - 1) . '">Précédente</a>';
						if ($_GET['page'] != $nb_de_page) 
						{
							echo '<a href="galerie.php?page=' . ($_GET['page'] + 1) . '"> - Suivante</a>';
						}
					}
				}
			}
			else
			{
				$begin = 0;
				$res = ft_list_galerie($begin);
				echo '<a href="galerie.php?page=' . ($_GET['page'] + 2) . '">Suivante</a>';
			}

			foreach ($res as $key => $value) 
			{
				$count = ft_count_like($value['IMG_ID']);
				echo'	<div>
				<img class="g_img" src="' . $value['IMG_URL'] . '">
				<br>';
				if ($_SESSION['LOG'] === TRUE) 
				{

					echo '<a href="sql/ft_add_like.php?IMG_ID=' . $value['IMG_ID'] . '&UTI_ID=' . $_SESSION['USER'] . '">';
					$row1 = ft_list_like($value['IMG_ID'], $_SESSION['USER']);
					echo '<img style="background-image: url(\'img/coeur_' . $row1[0]['AIM_ACTIF'] . '.svg\');" class="g_img_coeur"></a><p class="g_like">' . $count[0]['COUNT_LIKE'] . '</p>
					<div class="g_content_commentaire">
						<form method="POST" action="sql/ft_add_comment.php">
							<p class="g_commentaire">Votre commentaire : </p>
							<textarea class="g_input_com" type="textarea" name="COM_COM"></textarea>
							<input hidden="true" type="text" name="IMG_ID" value="'. $value['IMG_ID'] .'">
							<br>
							<input class="g_btn_commenter" type="submit" name="commenter" value="envoyer">
						</form>';
						$row = ft_list_comment($value['IMG_ID']);
						foreach ($row as $cle => $valeur) 
						{
							echo '<p class="g_com_uti"> ' . $valeur['COM_DATE'] . ' - ' . $valeur['UTI_NOM'] . ' : ' . $valeur['COM_COM'] . '</p>';
						}
						echo '
					</div>';
				}
				echo '</div>';
			}
			if (isset($_GET['page'])) 
			{
				if ($_GET['page'] <= $nb_de_page) 
				{
					$begin = ($max_img_par_page * ($_GET['page'] - 1) + 1);
					$end = $max_img_par_page * $_GET['page'];
					if ($_GET['page'] === "1") 
					{
						$begin = 0;
						echo '<a href="galerie.php?page=' . ($_GET['page'] + 1) . '">Suivante</a>';
					}
					else
					{
						echo '<a href="galerie.php?page=' . ($_GET['page'] - 1) . '">Précédente</a>';
						if ($_GET['page'] != $nb_de_page) 
						{
							echo '<a href="galerie.php?page=' . ($_GET['page'] + 1) . '"> - Suivante</a>';
						}
					}
				}
			}
			else
			{
				$begin = 0;
				echo '<a href="galerie.php?page=' . ($_GET['page'] + 2) . '">Suivante</a>';
			}
		}
		?>
	</main>
	<footer class="p_header p_footer">
		<p style="float: right; margin-right: 10px;"><i>© mvelluet 2017</i></p>
	</footer>
</body>
</html>