<?php
// Include the TCPDF library
require_once('../assets/tcpdf/tcpdf.php'); // Adjust path as needed

// Create a new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document info
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Simple PDF');
$pdf->SetSubject('TCPDF Example');
$pdf->SetKeywords('TCPDF, PDF, example');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(20, 20, 20);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Content to write
$html = <<<EOD
<h1>Hello, TCPDF!</h1>
<p>This is a simple PDF generated with <strong>TCPDF</strong>.</p>
EOD;

// Write content
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF (force download)
$pdf->Output('simple_example.pdf', 'I'); // 'I' for inline view in browser, use 'D' to force download
?>
