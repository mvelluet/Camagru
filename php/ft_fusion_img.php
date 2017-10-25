<?php
function ft_fusion_img($filename, $name_filtre)
{
	$dst_im = imagecreatefrompng("montage/".$filename);
	$src_im = imagecreatefrompng($name_filtre);
	$dst_y = 0;
	$dst_x = 0;
	$src_x = 0;
	$src_y = 0;
	$src_w = 640;
	$src_h = 480;
	$pct = 100;

	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
	        $cut = imagecreatetruecolor($src_w, $src_h); 
	        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);  
	        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
	        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
	}

	imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct);
	imagePng($dst_im,"montage/".$filename); 
}
?>