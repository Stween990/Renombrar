<?php
function split_pdf($tmp_name, $filename, $dir = false)
{
    require_once('fpdf.php');
    require_once('fpdi.php');
    $pdf = new FPDI();
    $pagecount = $pdf->setSourceFile($tmp_name);
    
    // Split each page into a new PDF
    $path_tmp = 'C:/xampp/tmp/'.uniqid();
    $name = mkdir($path_tmp);
    $iterator_x = -1;
    for ($i = 1; $i <= $pagecount; $i++) {
        $new_pdf = new FPDI();
        $new_pdf->AddPage();
        $new_pdf->setSourceFile($tmp_name);
        $new_pdf->useTemplate($new_pdf->importPage($i));

        switch ($i) {
              case 1:
               $serial = 4;
              break;
              case 2:
               $serial = 18;
              break;
              case 3:
               $serial = 11;
              break;
              case 4:
               $serial = 5;
              break;
              default:
              $serial = 7;
              $iterator_x++;
            break;
           }
        if ($serial == 7) {
            $new_filename = "0_828002423_".str_replace('.pdf', '', $filename)."_".$serial."_".$iterator_x.".pdf";
        } else {
            $new_filename = "0_828002423_".str_replace('.pdf', '', $filename)."_".$serial."_0.pdf";
        }

        $new_pdf->Output($new_filename, "F");
        rename($_SERVER['DOCUMENT_ROOT'].'/renombrar/'.$new_filename, $path_tmp.'/'.$new_filename);
    }

    return $path_tmp;
}
