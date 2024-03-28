<?php
require_once "../database/config.php";
?>
            <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th style="width:5%;">No</th>
                    <th><center>Mahasiswa</center></th>
                    <th><center>Ket</center></th>
                    <th><center>Action</center></th>
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
                          $nim = $data['nim'];
                          $nama = $data['nama'];
                      
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>

                                  </td>

                                  <td>
                                   <h6>
                                   [ <b><?= $nim;?></b> ] <?= $nama; ?> 
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
                                 <td>
                                  <center>
                                    <?php 
                                    if ($ket == 'Y') {?>
                                    <button class="btn btn-danger btn-sm" id="hadir2" onClick="handleClickAlfa('<?=$nim;?>')">
                                    <i class="far fa-window-close"></i>
                                   Alfa 
                                    </button>
                                    <?php
                                    } else {?>
                                    <button class="btn btn-success btn-sm" id="hadir" onClick="handleClick('<?=$nim;?>')">
                                    <i class="far fa-check-square"></i>
                                   Hadir 
                                    </button>
                                    <?php
                                  }

                                    ?>
                                 
                                  </center>
                                  </td>
                              </tr>

                            <?php
                        }
                        }else
                        {
                          echo "<tr><td colspan=\"6\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                          ?>

                  </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
<script type="text/javascript">
function handleClick(nim){
    $(document).ready(function(){
      console.log(nim);
      $('#hadir').load('updatehadir.php?id_klsmk=<?= $id_klsmk;?>&nim='+nim);
    });

    }
</script>
<script type="text/javascript">
  function handleClickAlfa(nim2){
    $(document).ready(function(){
      $('#hadir2').load('updatealfa.php?id_klsmk=<?= $id_klsmk;?>&nim='+nim2);
    });

    }
</script>