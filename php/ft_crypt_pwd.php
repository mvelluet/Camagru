<?php  
function ft_crypt_pwd($pwd)
{
	$passwd = hash("sha512", $pwd);
	return ($passwd);
}
?>