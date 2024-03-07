<?php
  require_once "../database/config.php";
  require "PHPExcel.php";

  ob_start();

  $lk="Data-Matkul".date('Y-m-d');
  $sql = "SELECT * FROM tbl_matkul ORDER BY id ASC";
//$lkas=mysqli_fetch_array($sql);
  $result = mysqli_query($con,$sql);

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()
              ->setCreator("Data-Matkul"); 
            // ->setTitle("ALLPAPERREPORT");

  $objset = $objPHPExcel->setActiveSheetIndex(0);
  $objget = $objPHPExcel->getActiveSheet(); 

  $objset->setCellValue('A1', 'NO');
  $objset->setCellValue('B1', 'KODE MATKUL');  
  $objset->setCellValue('C1', 'NAMA INDONESIA');
  $objset->setCellValue('D1', 'NAMA INGGRIS');
  $objset->setCellValue('E1', 'SKS');

  $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getBorders()->applyFromArray(
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
  $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold( true );
      foreach(array('B','C','D') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);

}
    $no=1;
    $baris=2;
    while($row=mysqli_fetch_assoc($result)){

         $timestamp = strtotime($row['date']);
         $newDate   = date('d F Y H:i', $timestamp);
         
        $tgl      = $newDate;
        $code     = $row['kode_matkul'];
        $nama_in    = $row['nama_ind'];
        $nama_en    = $row['nama_eng'];
        $sks    = $row['sks'];

    $objset->setCellValue("A".$baris, $no);
    $objset->setCellValue("B".$baris, $code);
    $objset->setCellValue("C".$baris, $nama_in);
    $objset->setCellValue("D".$baris, $nama_en);
    $objset->setCellValue("E".$baris, $sks);
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