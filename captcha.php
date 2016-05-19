<?php
session_start();
$code=rand(1000,9999);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(45, 22);
$bg = imagecolorallocate($im, 148, 184, 77); //background color green
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>