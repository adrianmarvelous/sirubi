<?php
require_once('../assets/tcpdf/tcpdf.php'); 
require_once '../config/koneksi.php';

$id_booking = htmlentities($_GET['id_booking']);

// Get booking data
$q_data_permohonan = $db->prepare("
    SELECT * FROM rb_booking 
    JOIN rb_posisi_berkas ON rb_booking.id_posisi_berkas = rb_posisi_berkas.id_posisi_berkas 
    WHERE id_booking = :id
");
$q_data_permohonan->bindParam(':id', $id_booking);
$q_data_permohonan->execute();
$data = $q_data_permohonan->fetch(PDO::FETCH_ASSOC);

// Get tanggal booking
$q_tanggal = $db->prepare("SELECT * FROM rb_tanggal_booking WHERE id_booking = :id");
$q_tanggal->bindParam(':id', $id_booking);
$q_tanggal->execute();
$data_tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);

$data['tanggal'] = $data_tanggal;

// Create PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(20, 20, 20);
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();

// Generate tanggal rows as HTML
$tanggal_rows = '';
foreach ($data['tanggal'] as $key => $value) {
    $index = $key + 1;
    $tanggal = date('d-m-Y', strtotime($value['tanggal']));
    $tanggal_rows .= "
    <tr>
        <td>Tanggal $index</td>
        <td style='width:50px; white-space:nowrap;'>:</td>
        <td>$tanggal</td>
    </tr>";
}

// Build full HTML content
$html = '
<h1 style="text-align:center;">Bukti Pengajuan Permohonan</h1>

<h3>Data Diri</h3>
<table cellpadding="5" style="width:100%;">
    <tr>
        <td style="width:100px; white-space:nowrap">Nama</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td style="width:200px; white-space:nowrap">' . $data['name'] . '</td>
    </tr>
    <tr>
        <td>Instansi</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td>' . $data['instansi'] . '</td>
    </tr>
    <tr>
        <td>No Telp</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td>' . $data['telp'] . '</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td>' . $data['alamat'] . '</td>
    </tr>
</table>

<h3>Data Permohonan</h3>
<table cellpadding="5" style="width:100%;">
    <tr>
        <td style="width:100px; white-space:nowrap">Nama Kegiatan</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td style="width:200px; white-space:nowrap">' . $data['nama_kegiatan'] . '</td>
    </tr>
    <tr>
        <td>Instansi</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td>' . $data['instansi'] . '</td>
    </tr>
    ' . $tanggal_rows . '
</table>

<h3>Data Pendukung</h3>
<table cellpadding="5" style="width:100%;">
    <tr>
        <td style="width:100px; white-space:nowrap">Nomor Surat Permohonan</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td style="width:200px; white-space:nowrap">' . $data['nomor_surat_permohonan'] . '</td>
    </tr>
    <tr>
        <td style="width:100px; white-space:nowrap">Tanggal Surat Permohonan</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td style="width:200px; white-space:nowrap">' . date('d-M-Y', strtotime($data['tanggal_surat_permohonan'])) . '</td>
    </tr>
    <tr>
        <td style="width:100px; white-space:nowrap">Perihal Surat Permohonan</td>
        <td style="width:50px; white-space:nowrap">:</td>
        <td style="width:200px; white-space:nowrap">' . $data['perihal_surat_permohonan'] . '</td>
    </tr>
</table>
';

// Output to PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('bukti_pengajuan_permohonan.pdf', 'I');
