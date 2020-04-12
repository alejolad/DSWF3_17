<?php
session_start();
$counter_name = "visitas.txt";
 
// Comprobar si existe un archivo de texto. Si no crea un e inicializar a cero.
if (!file_exists($counter_name)) {
$f = fopen($counter_name, "w");
fwrite($f,"0");
fclose($f);
}
 
// Leer el valor actual de nuestro archivo de contador
$f = fopen($counter_name,"r");
$counterVal = fread($f, filesize($counter_name));
fclose($f);
 
// Se ha contado visitante en esta sesión?
// Si no es así, aumentar el valor del contador en uno
if(!isset($_SESSION['hasVisited'])){
$_SESSION['hasVisited']="yes";
$counterVal++;
$f = fopen($counter_name, "w");
fwrite($f, $counterVal);
fclose($f);
}
 
$counterVal = str_pad($counterVal, 5, "0", STR_PAD_LEFT);
$chars = preg_split('//', $counterVal);
 
$im = imagecreatefrompng("canvas.png");
$src1 = imagecreatefrompng("$chars[1].png");
$src2 = imagecreatefrompng("$chars[2].png");
$src3 = imagecreatefrompng("$chars[3].png");
$src4 = imagecreatefrompng("$chars[4].png");
$src5 = imagecreatefrompng("$chars[5].png");
 
imagecopymerge($im, $src1, 0, 0, 0, 0, 56, 75, 100);
imagecopymerge($im, $src2, 60, 0, 0, 0, 56, 75, 100);
imagecopymerge($im, $src3, 120, 0, 0, 0, 56, 75, 100);
imagecopymerge($im, $src4, 180, 0, 0, 0, 56, 75, 100);
imagecopymerge($im, $src5, 240, 0, 0, 0, 56, 75, 100);
 
// Salida y libre de la memoria
header('Content-Type: images/png');
echo imagepng($im);
imagedestroy($im);
?>