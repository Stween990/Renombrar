<!DOCTYPE html>
<html lang="en">

<head>
    <title>Renombrar PDFs</title>
</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
        Seleccione el archivo: <input type="file" name="files[]" id="files" multiple directory="" webkitdirectory=""
            moxdirectory="" /><br /><br />
        <input type="Submit" value="Cargar" name="upload" />
    </form>
</body>

</html>

<?php
require_once 'leerpdf/zdividir.php';
require_once 'zip.php';

  if (isset($_POST['upload'])) {
      $array_folders = array();
      $it = 0;
      foreach ($_FILES['files']['name'] as $i => $name) {
          if (strlen($_FILES['files']['name'][$i]) > 1 && $_FILES['files']['type'][$i] == 'application/pdf') {
              $array_folders[$it] = split_pdf($_FILES['files']['tmp_name'][$i], $_FILES['files']['name'][$i]);
          }
          $it++;
      }
      $zip = createZip($array_folders);
      echo $zip;
      echo '<a href="descargar.php?val='.$zip.'">Descargar</a>';
  }
  ?>