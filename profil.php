<?php
session_start();
include "sql/ft_connexion.php";
include 'php/ft_check_login.php';
include 'php/ft_create_img.php';
include 'sql/ft_show_img_user.php';
include 'php/ft_fusion_img.php';
include 'php/ft_fusion_img_upload.php';
include 'php/ft_check_valid_file.php';

ft_check_login();
$_SESSION['data'] = "";
if (isset($_POST['sauvegarder']))
{
	if ($_POST['sauvegarder'] === "sauvegarder" && isset($_POST['name_filtre']))
	{
		$path = "montage";
		if (!file_exists($path))
			mkdir($path);
		$tab[1] = ft_create_img($_POST['capture'], $_POST['photo_upload']);
	}
	$_POST['capture'] = "";
}

$_SESSION['file_upload'] = "";

if(isset($_POST["submit"]))
{
	$tab = ft_check_valid_file();
	if ($tab[0] === TRUE) 
	{
		$path = "upload";
		if (!file_exists($path))
			mkdir($path);
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		$_SESSION['file_upload'] = $_FILES['file']['name'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta charset="utf-8">

	<meta xmlns="http://www.w3.org/1999/xhtml" name="description" content="Projet Camagru" />
	<meta content="webcam, getUserMedia, video, stream" name="keywords">
	<meta content="Display Webcam Stream" name="title">

	<title>Camagru | profil</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<style type="text/css">
		.p_photo_upload 
		{
			float: left;
			z-index: 0;
			position: absolute;
			margin-top: 100px;
			width: 100%;
		}
		@media screen and (max-width: 740px) 
		{
			.p_photo_upload 
			{
				float: left;
				z-index: 0;
				position: absolute;
				margin-top: 10px;
				width: 100%;
			}
		}
	</style>
</head>
<body class="p_body">
	<header class="p_header">
		<h1 class="p_h1"><a href="profil.php">CAMAGRU</a></h1>
		<h3 class="p_h_profils p_deco"><a href="php/logout.php">Deconnexion</a></h3>
		<h3 class="p_h_profils"><a href="galerie.php">Galerie | </a></h3>
		<h3 class="p_h_profils p_profil"><a href="profil.php">Profil | </a></h3>
	</header>

	<!-- video  -->

	<div class="p_div_main_nav">
		<main class="p_main">
			<div id="container">
				<div class="p_filtre">
					<form class="p_form_montage">
						<label>Filtre - </label>
						<label for="chat">Chat :</label>
						<input type="radio" id="chat" name="filtre" value="chat" onclick="ft_filtre(this);">
						<label for="chien">Chien :</label>
						<input type="radio" id="chien" name="filtre" value="chien" onclick="ft_filtre(this);">
						<label for="fleur">Fleur :</label>
						<input type="radio" id="fleur" name="filtre" value="fleur" onclick="ft_filtre(this);">
					</form>
					<form class="p_form_upload" action="profil.php" method="post" enctype="multipart/form-data">
						<input style="max-width: 159px;" type="file" name="file" id="file">
						<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						<input type="submit" value="envoyer" name="submit">
						(max 2Mo)
					</form>
				</div>
				<div>
					<?php  
					if (isset($_SESSION['file_upload']))
					{
						if (!empty($_SESSION['file_upload'])) 
						{

							echo '<img class="p_photo_upload" src="upload/' . $_SESSION['file_upload'] . '">';

						}
					}
					?>
					<video autoplay="true" id="video_webcam"></video>
					<canvas hidden="true" class="p_canvas p_canvas_replace_video" id="canvas" height="480" width="640px"></canvas>
					<img id="montage_cam" class="p_montage">
					<form method="POST" action="" class="p_btn_save">
						<input hidden="true" type="text" name="name_filtre" id="name_filtre">
						<input hidden="true" name="capture" id="capture_photo">
						<?php  
						echo '<input type="hidden" name="photo_upload" value="upload/' . $_SESSION['file_upload'] . '">';

						?>
						<input disabled type="submit" name="sauvegarder" id="sauvegarder" value="sauvegarder" onclick="get_video();">
					</form>
					<?php  

					if (!empty($_SESSION['file_upload']))
					{
						echo '<button disabled class="p_btn" id="prendre_photo">Prendre photo</button>';
					}
					else
					{
						echo '<button disabled class="p_btn" id="prendre_photo" onclick="photo();">Prendre photo</button>';
					}
					?>
					<button disabled class="p_btn" id="annuler" onclick="get_video();">Annuler</button>
					<br>
					<?php
					if (isset($tab[1])) 
					{
						echo '<p style="color: red;">' . $tab[1] . '</p>';
					}
					?>

				</div>
			</div>
		</main>
		<nav class="p_nav">
			<div class="p_content_img" >
				<?php
				$res = ft_show_img_user();
				if (isset($res)) 
				{
					foreach ($res as $key => $value) 
					{
						echo '
						<a href="sql/ft_delete_photo.php?img='.$value['IMG_URL'].'">
						<img style="background-color:red;" class="p_img" src="' . $value['IMG_URL'] . '">
						</a>
						';
					}
				}
			?>
		</div>
	</nav>
	<br>
	<br>
	<br>

</div>
<footer class="p_header p_footer">
	<p style="float: right;"><i>© mvelluet 2017</i></p>
</footer>
<script type="text/javascript" src="js/app.js">ft_getvideo();</script>
<script>ft_getvideo();</script>
</body>
</html>