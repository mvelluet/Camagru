<?php
session_start();
if ($_SESSION['LOG'] === TRUE) 
{
	function ft_connexion()
	{	
		include '../config/database.php';
		$conn = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
		return ($conn);
	}
	if (isset($_POST['COM_COM']) && $_POST['commenter'] === "envoyer" && isset($_POST['IMG_ID']))
	{
		if ($_POST['COM_COM'] != "") 
		{
			$date = date("Y/m/d H:m:s");
			$conn = ft_connexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("INSERT INTO `COMMENTAIRE`(`COM_COM`, `COM_DATE`, `IMG_ID`, `UTI_ID`) VALUES (?, ?, ?, ?)");
			$stmt->execute(array($_POST['COM_COM'], $date, $_POST['IMG_ID'], $_SESSION['USER']));
			$conn = null;
		}
	}

	$conn = ft_connexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare(" SELECT * FROM IMAGE WHERE IMG_ID = ?"); 
	$stmt->execute(array($_POST['IMG_ID']));
	$res1 = $stmt->fetch();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare(" SELECT * FROM UTILISATEUR WHERE UTI_ID = ?"); 
	$stmt->execute(array($res1['UTI_ID']));
	$res2 = $stmt->fetch();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare(" SELECT * FROM UTILISATEUR WHERE UTI_ID = ?"); 
	$stmt->execute(array($_SESSION['USER']));
	$res3 = $stmt->fetch();
	$conn = null;

	//
	//		NOTIFICATION
	//
	if ($_SESSION['USER'] != $res2['UTI_ID']) 
	{
		$tab = array($_POST['COM_COM']);
		$to = $res2['UTI_MAIL'];
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		$subject = $res3['UTI_NOM'] . " à commenté votre image !";
		$message = 'Bonjour,<br>
		Votre photo à reçu un nouveau commentaire : <a href="http://localhost:8080/'.$_SESSION["Dossier_source"].'/'. $res1['IMG_URL'] .'">Votre image</a>
		<br>
		<br>
		' . $res3['UTI_NOM'] . ' a dit : ' . $tab[0];


		mail($to , $subject , $message, $headers);
	}

}

header('location: ../galerie.php');
?>
