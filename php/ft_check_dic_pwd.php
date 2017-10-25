<?php  
function ft_check_dic_pwd($mdp)
{
	$subject = file_get_contents("dictionnaire/francais_fr.txt");
	preg_match ("/$mdp/i", $subject, $match);
	if (!empty($match[0]))
	{
		if (!strcmp($match[0], $mdp)) 
		{
			return (FALSE);
		}
		else
		{
			return (TRUE);
		}
	}
	else
	{
		return (TRUE);
	}
}
?>