<?php  
function ft_check_valid_file()
{	
	switch($_FILES['file']['error']) 
	{
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			return (array(FALSE, 'Votre image est trop lourde, elle doit faire moins de 2Mo'));
			break;
		case UPLOAD_ERR_PARTIAL:
			return (array(FALSE, 'L\'upload de votre image est incomplète'));
			break;
		case UPLOAD_ERR_NO_FILE:
			return (array(FALSE, 'L\'image ne s\'est pas correctement chargé'));
			break;
		default:
			return (array(FALSE, 'erreur'));
			break;
	}

	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false) 
	{

		if (strcmp($check['mime'],"image/jpeg") || strcmp($check['mime'],"image/png") || strcmp($check['mime'],"image/jpg")) 
		{
			return (array(TRUE));
		}
	} 
	else 
	{
		return (array(FALSE, "Le fichier n'est pas une image au format .jpg, .jpeg ou .png"));
		
	}
}
?>