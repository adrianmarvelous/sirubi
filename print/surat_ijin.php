<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if (ob_get_length()) { ob_end_clean(); }
ob_start();

require_once('../assets/tcpdf/tcpdf.php');
require_once('../config/koneksi.php');

$id = htmlentities($_GET['id']);
$q_data_pemohon = $db->prepare("SELECT * FROM rb_booking WHERE id_booking = :id");
$q_data_pemohon->bindParam(':id', $id);
$q_data_pemohon->execute();
$data_pemohon = $q_data_pemohon->fetch(PDO::FETCH_ASSOC);

$q_balasan = $db->prepare("SELECT * FROM rb_surat_balasan WHERE id_booking = :id ORDER BY created_at DESC LIMIT 1");
$q_balasan->bindParam(':id', $id);
$q_balasan->execute();
$data_balasan = $q_balasan->fetch(PDO::FETCH_ASSOC);

$q_tanggal = $db->prepare("SELECT *  FROM rb_tanggal_booking WHERE id_booking = :id");
$q_tanggal->bindParam(':id',$id);
$q_tanggal->execute();
$tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);

$data = [
    'tanggal_surat' => date('d F Y', strtotime($data_balasan['tanggal_surat_balasan'])),
    'nomor_surat_balasan' => $data_balasan['nomor_surat_balasan'],
    'pemohon' => $data_pemohon['instansi'],
    'nomor_surat_peminjam' => $data_pemohon['nomor_surat_permohonan'],
    'tanggal_surat_peminjam' => date('d F Y', strtotime($data_pemohon['tanggal_surat_permohonan'])),
    'perihal_peminjam' => '[Perihal Surat Peminjam]',
    'hari_tanggal' => '[Hari/Tanggal Peminjaman]',
    'waktu' => '[Waktu Peminjaman]',
    'acara' => $data_pemohon['nama_kegiatan'],
    'tanggal' => $tanggal
];
$tanggal_list = '';
foreach ($tanggal as $row) {
    $tgl = date('d F Y', strtotime($row['tanggal'])) 
        . ' pukul ' . date('H:i', strtotime($row['pukul_mulai'])) 
        . ' WIB s.d. ' . date('H:i', strtotime($row['pukul_selesai'])) . ' WIB';
    $tanggal_list .= "$tgl<br>";
}
$data['tanggal'] = $tanggal_list;


// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('BKPSDM Kota Surabaya');
$pdf->SetAuthor('Bakesbangpol Surabaya');
$pdf->SetTitle('Surat Jawaban Peminjaman Rumah Bhinneka');
$pdf->SetSubject('Surat Jawaban');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('times', '', 12);
$pdf->AddPage();

// Encode the logo image as base64
$logoPath = '../assets/logo/Logo Kota Surabaya.png';
$imageSrc = '';
if (file_exists($logoPath)) {
    $imageData = base64_encode(file_get_contents($logoPath));
    $imageSrc = 'data:image/png;base64,' . $imageData;
} else {
    $imageSrc = ''; // fallback
}

// Header HTML with image inside table
$headerTextHtml = <<<EOD
<style>
    .header-text {
        font-size: 14pt;
        font-weight: bold;
        text-align: center;
        width:70%;
    }
    .header-sub {
        font-size: 10pt;
        text-align: center;
    }
</style>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="30%" rowspan="6" style="text-align: center;">
EOD;

// insert image or fallback text
if ($imageSrc !== '') {
    $headerTextHtml .= "<img src=\"$imageSrc\" width=\"100\">";
} else {
    $headerTextHtml .= "[Logo Not Found]";
}

$headerTextHtml .= <<<EOD
        </td>
        <td class="header-text">PEMERINTAH KOTA SURABAYA</td>
    </tr>
    <tr>
        <td class="header-text">BADAN KESATUAN BANGSA DAN POLITIK</td>
    </tr>
    <tr>
        <td class="header-sub">Jalan Jaksa Agung Suprapto No. 2 Surabaya 60272</td>
    </tr>
    <tr>
        <td class="header-sub">Telepon (031) 5454367 Faksimile (031) 5343000</td>
    </tr>
    <tr>
        <td class="header-sub">Laman surabaya.go.id, Pos-el: bakesbangpol@surabaya.go.id</td>
    </tr>
</table>
<hr>
<br>
EOD;

$pdf->writeHTML($headerTextHtml, true, false, true, false, '');

// Main body
$bodyHtml = <<<EOD
<style>
    .body { text-align: justify; line-height:1.3; }
    .label { width: 120px; display: inline-block; vertical-align: top; }
</style>
<div style="text-align: right">Surabaya, {$data['tanggal_surat']}<br><br></div>
<div class="small">
    
    <strong>Nomor :</strong> {$data['nomor_surat_balasan']}<br>
    <strong>Sifat :</strong> Biasa<br>
    <strong>Lampiran :</strong> -<br>
    <strong>Hal :</strong> Surat Jawaban<br><br>
    Yth. {$data['pemohon']}<br>
    di -<br>
    Surabaya
</div>

<br>

<table cellpadding="2" cellspacing="0" width="100%" style="line-height:1.4;">
    <tr>
        <td colspan="2" style="text-align: justify;">
            Menindaklanjuti surat Saudara Nomor: {$data['nomor_surat_peminjam']} tanggal: {$data['tanggal_surat_peminjam']} Hal: {$data['perihal_peminjam']}, pada:
        </td>
    </tr>
    <tr>
        <td width="20%"><strong>Hari/Tanggal</strong></td>
        <td width="5%">:</td>
        <td>{$data['tanggal']}</td>
    </tr>
    <tr>
        <td><strong>Acara</strong></td>
        <td width="5%">:</td>
        <td>{$data['acara']}</td>
    </tr>
    <tr>
        <td><strong>Tempat</strong></td>
        <td width="5%">:</td>
        <td>Rumah Bhinneka Kota Surabaya</td>
    </tr>
    <tr>
        <td><strong>Alamat</strong></td>
        <td width="5%">:</td>
        <td>Jl. Nginden Baru 6/28 Surabaya</td>
    </tr>
</table>
<div style="text-align: justify;">
    <p>
    Dengan ini disampaikan bahwa permohonan Saudara dapat disetujui dan agar memperhatikan 
    12 (dua belas) poin ketentuan yang berlaku serta menjaga kebersihan, keamanan, dan ketertiban 
    selama kegiatan berlangsung.
    </p>
    <p>
        Demikian surat ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
</div>
<table style='width:100%'>
    <tr>
        <td style='width:50%'></td>
        <td style='width:50%;text-align:center'>
            <div style='text-aling:center'>Kepala</div>
        </td>
    </tr>
</table>
EOD;

$pdf->writeHTML($bodyHtml, true, false, true, false, '');

// Output the PDF
if (ob_get_length()) {
    ob_end_clean();
}
$pdf->Output('surat_jawaban_peminjaman.pdf', 'I');
