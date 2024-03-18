<?php 
require_once '../database/config.php';
require_once '../assets_adminlte/dist/fpdf/fpdf.php';

class PDF extends FPDF
{
// Page header
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
    $this->Line(0,40,250,40);
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
}
$id_klsmk = @$_GET['id_klsmk'];
$sql_kelasmatkul = mysqli_query($con, "SELECT tbl_periode.tahun as tahun,tbl_periode.semester as semester, tbl_periode.id as id_periode, tbl_dosen.nama as nama_dosen,tbl_matkul.nama_ind as nama_mk_ind,tbl_matkul.nama_eng as nama_mk_eng,tbl_klsmatkul.kelas as kelas FROM tbl_periode,tbl_dosen,tbl_matkul,tbl_klsmatkul WHERE tbl_klsmatkul.id='$id_klsmk' AND tbl_klsmatkul.nid = tbl_dosen.nid AND tbl_periode.Id=tbl_klsmatkul.id_periode AND tbl_matkul.kode_matkul=tbl_klsmatkul.kode_matkul") or die (mysqli_error($con));

while ($dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul)){
    $tahun = $dataklsmatkul['tahun'];
    $semester = $dataklsmatkul['semester'];
    $id_periode = $dataklsmatkul['id_periode'];
    $nama_dosen = $dataklsmatkul['nama_dosen'];
    $nama_ind = $dataklsmatkul['nama_mk_ind'];
    $nama_eng = $dataklsmatkul['nama_mk_eng'];
    $kelas = $dataklsmatkul['kelas'];
}


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(80);
// Title
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,8,'Laporan Presensi Mahasiswa',0,1,'C');
$pdf->Cell(80);
$pdf->Cell(30,8,'Periode 2023 - 2024',0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'Tahun Akademik',0,0,'L');
$pdf->Cell(35,6,': '.$tahun.' - '.$semester,0,1,'L');
$pdf->Cell(40,6,'Dosen Pengampu',0,0,'L');
$pdf->Cell(35,6,': '.$nama_dosen,0,1,'L');
$pdf->Cell(40,6,'Mata Kuliah',0,0,'L');
$pdf->Cell(35,6,': '.$nama_ind,0,1,'L');
$pdf->Cell(40,6,'Kelas',0,0,'L');
$pdf->Cell(35,6,': '.$kelas,0,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'No.',1,0,'C');
$pdf->Cell(30,6,'NIM',1,0,'C');
$pdf->Cell(60,6,'Nama Mahasiswa',1,0,'C');
$pdf->Cell(30,6,'Pertemuan',1,0,'C');
$pdf->Cell(25,6,'Hadir',1,0,'C');
$pdf->Cell(30,6,'Presentase',1,1,'C');
$pdf->SetFont('Arial','',12);
$no = 1;
$pertemuan = 16;
$query_peserta = mysqli_query($con, "SELECT tbl_pesertamatkul.id_klsmatkul, tbl_pesertamatkul.nim, tbl_mahasiswa.nama FROM tbl_pesertamatkul,tbl_mahasiswa WHERE tbl_pesertamatkul.nim = tbl_mahasiswa.nim AND tbl_pesertamatkul.id_klsmatkul = '$id_klsmk' ORDER BY nim ASC") or die(mysqli_error($con));
if (mysqli_num_rows($query_peserta) > 0)
{
    while ($data_peserta = mysqli_fetch_array($query_peserta))
    {
        $nim = $data_peserta['nim'];
        $pdf->Cell(10,6,$no++,1,0,'C');
        $pdf->Cell(30,6,$nim,1,0,'C');     
        $pdf->Cell(60,6,$data_peserta['nama'],1,0,'L');
        $pdf->Cell(30,6,$pertemuan,1,0,'C');
        $ket = 'Y';
        $query_hadir = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE nim = $nim AND id_klsmatkul='$id_klsmk' AND kehadiran = '$ket'") or die(mysqli_error($con));
        $kehadiran = mysqli_num_rows($query_hadir);
        $presentase = ($kehadiran/$pertemuan)*100;
        $pdf->Cell(25,6,$kehadiran,1,0,'C');
        $pdf->Cell(30,6,$presentase.'%',1,1,'C');
    }
}
$pdf->Output();
?>
