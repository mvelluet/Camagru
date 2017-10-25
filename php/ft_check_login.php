<?php
function ft_check_login()
{
	if ($_SESSION['LOG'] !== TRUE) 
	{
		header('location: php/logout.php');
	}
}
?>