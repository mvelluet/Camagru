<?php  
function ft_fusion_img_upload($filename, $name_filtre)
{
	$type = substr($filename , -3);
	if (!strcmp(strtolower($type), "jpg"))
	{
		try {
		    $dst_im = imagecreatefromjpeg($filename);
		} catch (Exception $e) {
			return ("Le fichier n'est pas valide");
		}
	}
	if (!strcmp(strtolower($type), "jpeg")) 
	{
		try {
		    $dst_im = imagecreatefromjpeg($filename);
		} catch (Exception $e) {
			return ("Le fichier n'est pas valide");
		}
	}
	else if (!strcmp(strtolower($type), "png"))
	{
		try {
		    $dst_im = imagecreatefrompng($filename);
		} catch (Exception $e) {
			return ("Le fichier n'est pas valide");
		}
	}
	$src_im = imagecreatefrompng($name_filtre);
	$dst_y = 0;
	$dst_x = 0;
	$src_x = 0;
	$src_y = 0;
	$src_w = 640;
	$src_h = 480;
	$pct = 100;
	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
	{ 
	        $cut = imagecreatetruecolor($src_w, $src_h); 
	        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);  
	        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
	        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
	}
	imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct);
	$nb = ft_select_max_id();
	if ($nb === NULL) 
		$nb = 1;
	else
		$nb++;
	$name = $nb . '.png';
	imagePng($dst_im,"montage/".$name);
	ft_insert_img("montage/".$name);
}
?>