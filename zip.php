<?php
function createZip($path_tmp)
{
    $zip_file = 'C:\xampp\tmp\file'.uniqid().'.zip';

    // Initialize archive object
    $zip = new ZipArchive();
    if ($zip->open($zip_file, ZipArchive::CREATE)!==true) {
        echo 'No puede abrir';
    }
    foreach ($path_tmp as $folder_temp) {
        foreach (scandir($folder_temp) as $opt) {
            if (!is_dir($folder_temp.'/'.$opt) && file_exists($folder_temp.'/'.$opt)) {
                $zip->addFile($folder_temp.'/'.$opt, $opt);
            }
        }
    }
    $zip->close();

    if (file_exists($zip_file)) {
        foreach ($path_tmp as $folder_to_delete) {
            foreach (scandir($folder_to_delete) as $files_to_delete) {
                if (!is_dir($folder_to_delete.'/'.$files_to_delete) && file_exists($folder_to_delete.'/'.$files_to_delete)) {
                    echo $files_to_delete.'<br>';
                    unlink($folder_to_delete.'/'.$files_to_delete);
                }
                rmdir($folder_to_delete);
            }
        }
        return $zip_file;
    } else {
        echo 'no';
    }
}
