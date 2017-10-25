<?php  
function ft_create_img($data, $filename_upload)
{
	include 'sql/ft_select_max_id.php';
	include 'sql/ft_insert_img.php';

	$filtre = $_POST['name_filtre'];
	if (strlen($filename_upload) > 7)
	{
		$info = ft_fusion_img_upload($filename_upload, $filtre);
		return ($info);
	}
	else if (isset($data) && !empty($data)) 
	{
		if (strcmp($_SESSION['data'], $data))
		{	
			$_SESSION['data'] = $data;
			if ($data != "") 
			{
				$nb = ft_select_max_id();
				if ($nb === NULL) 
					$nb = 1;
				else
					$nb++;

				$parts = explode(',', $data);
				$data = $parts[1];
				$data = base64_decode($data);
				$name = $nb . '.png';
				$path = "montage/";
				$pathname = $path . $name;
				file_put_contents($pathname , $data);
				ft_fusion_img($name, $filtre);		
				if (file_exists($pathname)) 
				{
					ft_insert_img($pathname);
					$data = "";
					$_POST['capture'] = "";
					// TODO
					// echo "image save";
				}
			}
		}
	}
}
?>