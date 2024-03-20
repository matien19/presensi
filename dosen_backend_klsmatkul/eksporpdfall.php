<?php
require_once '../database/config.php';
require_once '../assets_adminlte/dist/fpdf/fpdf.php';

class PDF extends FPDF
{
    function Header()
    {
    // Logo
    $this->Image('../img/logo_upb.png',10,15,40);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,6,'Universitas Peradaban',0,1,'C');
    $this->SetFont('Arial','B',12);
    $this->Cell(80);
    $this->Cell(30,6,'Fakultas Sains dan Teknologi',0,1,'C');
    $this->SetFont('Arial','B',10);
    $this->Cell(80);
    $this->Cell(30,6,'Program Studi Informatika',0,1,'C');
    $this->Cell(80);
    $this->SetFont('Arial','',8);
    $this->Cell(30,4,' Jalan Raya Pagojengan Km. 3 Paguyangan, Brebes 52276. Telp. (0289)432032,',0,1,'C');
    $this->Cell(80);
    $this->SetFont('Arial','',8);
    $this->Cell(30,4,'email: admin@peradaban.ac.id, IG: -, twitter: -,',0,1,'C');
    //line
    $this->SetLineWidth(0.6);
    $this->Line(10,40,200,40);
    // Line break
    $this->Ln(10);
    }
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function title()
    {
        $this->Cell(80);
        $this->SetFont('Arial','B',14);
        $this->Cell(30,8,'Laporan Presensi Mahasiswa',0,1,'C');
        $this->Cell(80);
        $this->Cell(30,8,'Periode 2023 - 2024',0,1,'C');
        $this->Ln(5);
    }

    function detail_kelas($con, $id_klsmk)
    {
        $sql_kelasmatkul = mysqli_query($con, "SELECT tbl_periode.tahun as tahun,tbl_periode.semester as semester, tbl_periode.id as id_periode, tbl_dosen.nama as nama_dosen,tbl_matkul.nama_ind as nama_mk_ind,tbl_matkul.nama_eng as nama_mk_eng,tbl_klsmatkul.kelas as kelas FROM tbl_periode,tbl_dosen,tbl_matkul,tbl_klsmatkul WHERE tbl_klsmatkul.id='$id_klsmk' AND tbl_klsmatkul.nid = tbl_dosen.nid AND tbl_periode.Id=tbl_klsmatkul.id_periode AND tbl_matkul.kode_matkul=tbl_klsmatkul.kode_matkul") or die (mysqli_error($con));

        $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);
        $tahun = $dataklsmatkul['tahun'];
        $semester = $dataklsmatkul['semester'];
        $id_periode = $dataklsmatkul['id_periode'];
        $nama_dosen = $dataklsmatkul['nama_dosen'];
        $nama_ind = $dataklsmatkul['nama_mk_ind'];
        $nama_eng = $dataklsmatkul['nama_mk_eng'];
        $kelas = $dataklsmatkul['kelas'];
    
        $this->SetFont('Arial','B',10);
        $this->Cell(40,6,'Tahun Akademik',0,0,'L');
        $this->Cell(35,6,': '.$tahun.' - '.$semester,0,1,'L');
        $this->Cell(40,6,'Dosen Pengampu',0,0,'L');
        $this->Cell(35,6,': '.$nama_dosen,0,1,'L');
        $this->Cell(40,6,'Mata Kuliah',0,0,'L');
        $this->Cell(35,6,': '.$nama_ind,0,1,'L');
        $this->Cell(40,6,'Kelas',0,0,'L');
        $this->Cell(35,6,': '.$kelas,0,1,'L');
        $this->Ln(5);

        $this->tabel_presensi($con, $id_klsmk);
        $this->Ln(5);
        $this->ttd($nama_dosen);

    }

    function ttd($nama_dosen) 
    {
        $this->Cell(150);
        $this->Cell(30,8,'Tanjung, '.date('d M Y'),0,1,'C');
        $this->Ln(15);
        $this->Cell(150);
        $this->Cell(30,8,$nama_dosen,0,1,'C');
    }

    function tabel_presensi($con, $id_klsmk)
    {
        
        $header = array('No', 'NIM', 'Nama Mahasiswa', 'Pertemuan', 'Kehadiran', 'Presentase');
        // Column widths
        $w = array(10,30,60,30,25, 30);
        // Header
        $this->SetFont('Arial','B',12);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],6,$header[$i],1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',12);
        $query_peserta = mysqli_query($con, "SELECT tbl_pesertamatkul.id_klsmatkul, tbl_pesertamatkul.nim as nim, tbl_mahasiswa.nama as nama FROM tbl_pesertamatkul, tbl_mahasiswa WHERE tbl_pesertamatkul.nim = tbl_mahasiswa.nim AND tbl_pesertamatkul.id_klsmatkul = '$id_klsmk' ORDER BY nim ASC") or die(mysqli_error($con));
        $no = 1;
        $pertemuan = 16;
        $ket = 'Y';

            if (mysqli_num_rows($query_peserta) > 0)
            {
                while ($data_peserta = mysqli_fetch_array($query_peserta))
                {
                    $nim = $data_peserta['nim'];
                    $query_hadir = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE nim = $nim AND id_klsmatkul='$id_klsmk' AND kehadiran = '$ket'") or die(mysqli_error($con));
                    $kehadiran = mysqli_num_rows($query_hadir);
                    $presentase = ($kehadiran/$pertemuan)*100;
                    $this->Cell($w[0],6,$no++,1,0,'C');
                    $this->Cell($w[1],6,$nim,1,0,'C');     
                    $this->Cell($w[2],6,$data_peserta['nama'],1,0,'L');
                    $this->Cell($w[3],6,$pertemuan,1,0,'C');
                    $this->Cell($w[4],6,$kehadiran,1,0,'C');
                    $this->Cell($w[5],6,$presentase.'%',1,1,'C');
                }
            }

        } 

}
$pdf = new PDF();
$pdf->AliasNbPages();

$nid = @$_GET['nid'];
$aktif = 'A';
$query_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$aktif'");
$data_periode_aktif = mysqli_fetch_assoc($query_periode);
$periode_aktif = $data_periode_aktif['Id'];
$query = "SELECT * FROM tbl_klsmatkul WHERE id_periode ='$periode_aktif' AND nid='$nid'";
$sql_klsmatkul = mysqli_query($con, $query) or die (mysqli_error($con));
if (mysqli_num_rows($sql_klsmatkul) > 0)

{
    while ($id_kelas = mysqli_fetch_array($sql_klsmatkul)) {
        $id_klsmk = $id_kelas['Id'];

        // Data loading
        $pdf->AddPage();
        $pdf->title();
        $pdf->detail_kelas($con, $id_klsmk);
    }
}
$pdf->Output();
?>