<?php
require_once "../database/config.php";
?>
            <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th style="width:5%;">No</th>
                    <th><center>Mahasiswa</center></th>
                    <th><center>Ket</center></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                      $id_klsmk = @$_GET['id_klsmk'];
                      $hari_ini = date('Y-m-d');
                      $no = 1;
                      $query_peserta = mysqli_query($con, "SELECT tbl_presensi.id_klsmatkul, tbl_presensi.nim,  tbl_presensi.kehadiran, tbl_mahasiswa.nama FROM tbl_presensi,tbl_mahasiswa WHERE tbl_presensi.nim = tbl_mahasiswa.nim AND tbl_presensi.id_klsmatkul = '$id_klsmk' AND tbl_presensi.tanggal = '$hari_ini' ORDER BY nim ASC") or die(mysqli_error($con));
                      if (mysqli_num_rows($query_peserta) > 0)
                      {
                        while($data = mysqli_fetch_array($query_peserta))
                        {
                      
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>

                                  </td>

                                  <td>
                                   <h6>
                                   [ <b><?= $data['nim'];?></b> ] <?= $data['nama'];?> 
                                   </h6>  
                                  </td>

                                  <td>
                                  <center>
                                    <?php
                                    $ket = $data['kehadiran'];
                                    if ($ket == 'N'){
                                      echo '
                                      <h6>
                                   <img src="../img/ket/not.png" alt="tidak absen" width="20px">
                                   </h6>

                                      ';
                                    
                                    } else {
                                       echo '
                                      <h6>
                                   <img src="../img/ket/ya.png" alt="tidak absen" width="20px">
                                   </h6>';
                                    }
                                    ?>
                                   
                                  </center>

                                 </td>
                              </tr>

                            <?php
                        }
                        }else
                        {
                          echo "<tr><td colspan=\"5\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                          ?>

                  </tbody>
                    <tfoot>

                    </tfoot>
                  </table>