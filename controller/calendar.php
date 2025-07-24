<?php
  if(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'pilih_tanggal')){
        header('Location: ../index.php?pages=permohonan&tanggal=' . htmlentities($_POST['selected_date']));
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'permohonan'){
    $tanggal_mulai = htmlentities($_GET['tanggal']);
    include 'view/calendar/create.php';
  }elseif(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'create')){
    include '../config/koneksi.php';
    $name = htmlentities($_POST['name']);
    $instansi = htmlentities($_POST['instansi']);
    $telp = htmlentities($_POST['telp']);
    $alamat = htmlentities($_POST['alamat']);
    
    function saveUploadedPDF($fileInputName) {
      if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
          return null;
      }

      $file = $_FILES[$fileInputName];
      $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

      if (strtolower($ext) !== 'pdf') {
          return null;
      }

      // Ensure temp folder exists
      $tempDir = __DIR__ . '/temp_uploads';
      if (!is_dir($tempDir)) {
          mkdir($tempDir, 0777, true);
      }

      $timestamp = time();
      $newFileName = $fileInputName . '_' . $timestamp . '.pdf';
      $destination = $tempDir . '/' . $newFileName;

      if (move_uploaded_file($file['tmp_name'], $destination)) {
          return $destination;
      }

      return null;
    }

    // Clear previous temp uploads
    unset($_SESSION['temp_uploads']);
    $_SESSION['temp_uploads'] = [];

    $surat = saveUploadedPDF('surat_permohonan');
    $proposal = saveUploadedPDF('proposal');

    if ($surat && $proposal) {
        $_SESSION['temp']['surat_permohonan'] = $surat;
        $_SESSION['temp']['proposal'] = $proposal;
        $_SESSION['temp']['name'] = $name;
        $_SESSION['temp']['instansi'] = $instansi;
        $_SESSION['temp']['telp'] = $telp;
        $_SESSION['temp']['alamat'] = $alamat;

        // Redirect to next form step
        header('Location: ../index.php?pages=create_part_2');
        exit;
    } else {
        echo "Upload gagal. Pastikan kedua file adalah PDF.";
    }
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'create_part_2'){
    include 'view/calendar/create_2.php';
  }
  else{
    include 'view/calendar/index.php';
  }
?>