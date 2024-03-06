<?php
  require_once "../database/config.php";
  require "PHPExcel.php";

  ob_start();

  $lk="Data-Dosen".date('Y-m-d');
  $sql = "SELECT * FROM tbl_dosen ORDER BY nid ASC";
//$lkas=mysqli_fetch_array($sql);
  $result = mysqli_query($con,$sql);

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()
              ->setCreator("Data-Dosen"); 
            // ->setTitle("ALLPAPERREPORT");

  $objset = $objPHPExcel->setActiveSheetIndex(0);
  $objget = $objPHPExcel->getActiveSheet(); 

  $objset->setCellValue('A1', 'NID DOSEN');
  $objset->setCellValue('B1', 'KODE DOSEN');  
  $objset->setCellValue('C1', 'NAMA DOSEN');

  $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getBorders()->applyFromArray(
              array(
                  'bottom'     => array(
                      'style' => PHPExcel_Style_Border::BORDER_THICK,
                      'color' => array(
                          'rgb' => '808080'
                      )
                  ),
                   'left'     => array(
                      'style' => PHPExcel_Style_Border::BORDER_THICK,
                      'color' => array(
                          'rgb' => '808080'
                      )
                  ),
                    'right'     => array(
                      'style' => PHPExcel_Style_Border::BORDER_THICK,
                      'color' => array(
                          'rgb' => '808080'
                      )
                  ),
                  'top'     => array(
                      'style' => PHPExcel_Style_Border::BORDER_THICK,
                      'color' => array(
                          'rgb' => '808080'
                      )
                  )
              )
      );
  $objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold( true );
      foreach(array('B','C') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);

}
    $no=1;
    $baris=2;
    while($row=mysqli_fetch_assoc($result)){

         $timestamp = strtotime($row['date']);
         $newDate   = date('d F Y H:i', $timestamp);
         
        $tgl      = $newDate;
        $code     = $row['nid'];
        $nama    = $row['nama'];

    $objset->setCellValue("A".$baris, $no);
    $objset->setCellValue("B".$baris, $code);
    $objset->setCellValue("C".$baris, $nama);
    $baris++;
    $no++;
    }
    //kembalikan sheet aktif ke awal
    $objset = $objPHPExcel->setActiveSheetIndex(0);

    $filename = $lk.".xlsx";
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   
    ob_end_clean();
    //sesuaikan headernya 
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Transfer-Encoding: binary");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //ubah nama file saat diunduh
    header('Content-Disposition: attachment;filename='.$filename);
    //unduh file
    
    $objWriter->save("php://output");
    

    echo "<script>window.location='../superuser-allpaper;</script>";


exit();
?>