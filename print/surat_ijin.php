<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if (ob_get_length()) { ob_end_clean(); }
ob_start();

require_once('../assets/tcpdf/tcpdf.php');

$data = [
    'tanggal_surat' => date('d F Y'),
    'pemohon' => '[Nama Pemohon]',
    'nomor_surat_peminjam' => '[Nomor Surat Peminjam]',
    'tanggal_surat_peminjam' => '[Tanggal Surat Peminjam]',
    'perihal_peminjam' => '[Perihal Surat Peminjam]',
    'hari_tanggal' => '[Hari/Tanggal Peminjaman]',
    'waktu' => '[Waktu Peminjaman]',
    'acara' => '[Acara/Kegiatan]',
];

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
$logoPath = '../assets/logo/Logo Kota Surabaya.png';
$headerTextHtml = <<<EOD
<style>
    .header-text {
        font-size: 14pt;
        font-weight: bold;
        text-align: center;
    }
    .header-sub {
        font-size: 10pt;
        text-align: center;
    }
</style>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="70" rowspan="6" style="text-align: center;">
EOD;

// Append the logo image if it exists
if (file_exists($logoPath)) {
    $headerTextHtml .= '<img src="' . $logoPath . '" width="50">';
} else {
    $headerTextHtml .= '[Logo Not Found]';
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

// Render
$pdf->writeHTML($headerTextHtml, true, false, true, false, '');



// Main Body
$bodyHtml = <<<EOD
<style>
    .small { font-size:10pt; }
    .body { text-align: justify; line-height:1.3; }
    .label { width: 120px; display: inline-block; vertical-align: top; }
</style>

<div class="small">
    Surabaya, {$data['tanggal_surat']}<br><br>
    <strong>Nomor :</strong> 000.1.4 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /436.8.6/2025<br>
    <strong>Sifat :</strong> Biasa<br>
    <strong>Lampiran :</strong> -<br>
    <strong>Hal :</strong> Surat Jawaban<br><br>
    Yth. {$data['pemohon']}<br>
    di -<br>
    Surabaya
</div>

<br>

<div class="body">
    Menindaklanjuti surat Saudara Nomor: {$data['nomor_surat_peminjam']} tanggal: {$data['tanggal_surat_peminjam']} Hal: {$data['perihal_peminjam']}, pada:<br><br>

    <span class="label"><strong>Hari/Tanggal:</strong></span> {$data['hari_tanggal']}<br>
    <span class="label"><strong>Waktu:</strong></span> {$data['waktu']}<br>
    <span class="label"><strong>Acara:</strong></span> {$data['acara']}<br>
    <span class="label"><strong>Tempat:</strong></span> Rumah Bhinneka Kota Surabaya<br>
    <span class="label"><strong>Alamat:</strong></span> Jl. Nginden Baru 6/28 Surabaya<br><br>

    Dengan ini disampaikan bahwa permohonan Saudara dapat disetujui dan agar memperhatikan 
    12 (dua belas) poin ketentuan yang berlaku serta menjaga kebersihan, keamanan, dan ketertiban 
    selama kegiatan berlangsung.<br><br>

    Demikian atas perhatiannya disampaikan terima kasih.
</div>

<br><br>
<div class="small">
    mailto:bakesbangpol@surabaya.go.id
</div>
EOD;

$pdf->writeHTML($bodyHtml, true, false, true, false, '');

if (ob_get_length()) {
    ob_end_clean();
}
$pdf->Output('surat_jawaban_peminjaman.pdf', 'I');
