<?php
function ft_show_img_user()
{
	include "ft_check_have_user.php";

	if (ft_check_have_user()) 
	{
		$conn = ft_connexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM IMAGE WHERE UTI_ID = ? ORDER BY IMG_ID DESC"); 
		$stmt->execute(array($_SESSION['USER']));
		$res = $stmt->fetchAll();
		$conn = null;
		return ($res);
	}
	else
	{
		$conn = null;
		include "php/logout.php";
	}
}
?>
