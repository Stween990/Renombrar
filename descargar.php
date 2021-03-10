<?php
@ini_set('error_reporting', E_ALL & ~ E_NOTICE);
@ini_set('zlib.output_compression', 'Off');
  //Encabezados para archivos .zip
header('Content-Type: application/zip');
header('Content-Transfer-Encoding: Binary');
  //El nombre predeterminado que verá el cliente
header('Content-disposition: attachment; filename="' . basename($_GET['val']) . '"');
  //Que no haya límite en la ejecución del script
@set_time_limit(0);

  //Imprime el contenido del archivo
readfile($_GET['val']);
unlink($_GET['val']);
