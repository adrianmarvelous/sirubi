<?php
  if(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'pilih_tanggal')){
        header('Location: ../index.php?pages=permohonan&tanggal=' . htmlentities($_POST['selected_date']));
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'permohonan'){
    $tanggal_mulai = htmlentities($_GET['tanggal']);
    
      $q_tanggal = $db->prepare("SELECT tanggal FROM rb_tanggal_booking");
      $q_tanggal->execute();
      $tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
      foreach ($tanggal as $key => $value_tanggal) {
        $bookedDates[] = $value_tanggal['tanggal']; // format: YYYY-MM-DD
      }
    include 'view/booking/create.php';
  }elseif(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'create')){
    include '../config/koneksi.php';
    $tanggal_peminjaman = array_map('htmlentities', $_POST['tanggal_peminjaman']);
    $pukul_mulai = array_map('htmlentities', $_POST['pukul_mulai']);
    $pukul_selesai = array_map('htmlentities', $_POST['pukul_selesai']);
    $name = htmlentities($_POST['name']);
    $instansi = htmlentities($_POST['instansi']);
    $telp = htmlentities($_POST['telp']);
    $alamat = htmlentities($_POST['alamat']);
    $nama_kegiatan = htmlentities($_POST['nama_kegiatan']);
    $nomor_surat_permohonan = htmlentities($_POST['nomor_surat_permohonan']);
    $tanggal_surat_permohonan = htmlentities($_POST['tanggal_surat_permohonan']);
    $perihal_surat_permohonan = htmlentities($_POST['perihal_surat_permohonan']);
            // Remove non-digit characters (optional, if you want pure digits only)
            $telp = preg_replace('/\D/', '', $telp);

            // Check if NOT 12 or 13 digits
            if (!preg_match('/^\d{12,13}$/', $telp)) {
                $_SESSION['alert'] = [
                    'type' => 'danger', // 'success', 'info', 'warning', or 'danger'
                    'message' => 'Mohon cek nomer telp kembali!'
                ];
                echo "<script>history.back();</script>";
                exit;
            }

    for ($i=0; $i < count($tanggal_peminjaman) ; $i++) { 
      $q_check_tanggal = $db->prepare("SELECT tanggal FROM rb_tanggal_booking WHERE tanggal = :tanggal");
      $q_check_tanggal->bindParam(':tanggal',$tanggal_peminjaman[$i]);
      $q_check_tanggal->execute();

      if($q_check_tanggal->rowCount() > 0){
          $_SESSION['alert'] = [
              'type' => 'danger',
              'message' => 'Tanggal '. date('d-M-Y',strtotime($tanggal_peminjaman[$i])).' tidak tersedia! Silakan pilih tanggal lain.'
          ];
           echo "<script>
            history.back();
        </script>";
        exit; // Stop eksekusi lebih lanjut
      }
    }
    
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
      $newFileName = $timestamp. '_' . $fileInputName . '_' . '.pdf';
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
        $_SESSION['temp']['tanggal_peminjaman'] = $tanggal_peminjaman;
        $_SESSION['temp']['pukul_mulai'] = $pukul_mulai;
        $_SESSION['temp']['pukul_selesai'] = $pukul_selesai;
        $_SESSION['temp']['surat_permohonan'] = $surat;
        $_SESSION['temp']['proposal'] = $proposal;
        $_SESSION['temp']['name'] = $name;
        $_SESSION['temp']['instansi'] = $instansi;
        $_SESSION['temp']['telp'] = $telp;
        $_SESSION['temp']['alamat'] = $alamat;
        $_SESSION['temp']['nama_kegiatan'] = $nama_kegiatan;
        $_SESSION['temp']['nomor_surat_permohonan'] = $nomor_surat_permohonan;
        $_SESSION['temp']['tanggal_surat_permohonan'] = $tanggal_surat_permohonan;
        $_SESSION['temp']['perihal_surat_permohonan'] = $perihal_surat_permohonan;

        // Redirect to next form step
        header('Location: ../index.php?pages=create_part_2');
        exit;
    } else {
        echo "Upload gagal. Pastikan kedua file adalah PDF.";
    }
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'create_part_2'){

    if(htmlentities(isset($_GET['id_booking']))){
      $id_booking = htmlentities($_GET['id_booking']);
      $q_pemohon = $db->prepare("SELECT * FROM rb_booking WHERE id_booking = :id_booking");
      $q_pemohon->BindParam(':id_booking',$id_booking);
      $q_pemohon->execute();
      $pemohon = $q_pemohon->fetch(PDO::FETCH_ASSOC);
    }

    include 'view/booking/create_2.php';
  }elseif(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'save')){
    include '../config/koneksi.php';
    // dd($_SESSION);
    $tanggal_peminjaman_raw = $_SESSION['temp']['tanggal_peminjaman'];
    $pukul_mulai_raw = $_SESSION['temp']['pukul_mulai'];
    $pukul_selesai_raw = $_SESSION['temp']['pukul_selesai'];

    $tanggal_peminjaman = array_map('htmlentities', $tanggal_peminjaman_raw);
    $pukul_mulai = array_map('htmlentities', $pukul_mulai_raw);
    $pukul_selesai = array_map('htmlentities', $pukul_selesai_raw);

    $name = htmlentities($_SESSION['temp']['name']);
    $instansi = htmlentities($_SESSION['temp']['instansi']);
    $telp = htmlentities($_SESSION['temp']['telp']);
    $alamat = htmlentities($_SESSION['temp']['alamat']);
    $nama_kegiatan = htmlentities($_SESSION['temp']['nama_kegiatan']);
    $nomor_surat_permohonan = htmlentities($_SESSION['temp']['nomor_surat_permohonan']);
    $tanggal_surat_permohonan = htmlentities($_SESSION['temp']['tanggal_surat_permohonan']);
    $perihal_surat_permohonan = htmlentities($_SESSION['temp']['perihal_surat_permohonan']);
    $upload_surat_permohonan = htmlentities($_SESSION['temp']['surat_permohonan']);
    $upload_proposal_rundown = htmlentities($_SESSION['temp']['proposal']);
    $base64Image = $_POST['signature_image'];
    $created_at = date('Y-m-d H:i:s');
    $id_user = htmlentities($_SESSION['id_user']);
    
    // Remove the data URL prefix
    $image_parts = explode(";base64,", $base64Image);
    if (count($image_parts) == 2) {
      $image_base64 = base64_decode($image_parts[1]);
      
      // Create a unique filename
      $fileName = time().' - ' .'signature' . '.png';
      $filePath = '../resources/upload/spesimen/' . $fileName;

      // Ensure the directory exists
      if (!file_exists('../resources/upload/spesimen/')) {
          mkdir('../resources/spesimen/upload/', 0777, true);
      }

      // Save the image
      file_put_contents($filePath, $image_base64);

      // OPTIONAL: Save to DB — adjust table and connection as needed
      // $conn = new mysqli('localhost', 'user', 'pass', 'your_database');
      // $escapedFilePath = $conn->real_escape_string($filePath);
      // $conn->query("INSERT INTO signatures (image_path) VALUES ('$escapedFilePath')");
    }
    
    function moveFileFromTemp($sessionKey, $destinationDir = '../resources/upload/surat/') {
      // Start session if not already started
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }

      // Check if session key exists
      if (empty($_SESSION['temp'][$sessionKey])) {
          return false;
      }

      $originalPath = $_SESSION['temp'][$sessionKey];
      if (!file_exists($originalPath)) {
          return false;
      }

      // Ensure destination directory exists
      $destinationPath = __DIR__ . '/' . trim($destinationDir, '/') . '/';
      if (!file_exists($destinationPath)) {
          mkdir($destinationPath, 0777, true);
      }

      // Move file
      $fileName = basename($originalPath);
      $newPath = $destinationPath . $fileName;

      if (rename($originalPath, $newPath)) {
          $_SESSION['temp'][$sessionKey] = $newPath;
          return true;
      }

      return false;
    }
    moveFileFromTemp('surat_permohonan');
    moveFileFromTemp('proposal');
    $pathSuratPermohonan = $_SESSION['temp']['surat_permohonan']; // full path
    $pathProposal = $_SESSION['temp']['proposal']; // full path
    $projectRoot = realpath(__DIR__ . '/../'); // gives C:/xampp/htdocs/sirubi
    $path_spesimen = 'resources/upload/spesimen/'.$fileName;

    $pathSuratPermohonan = str_replace($projectRoot . DIRECTORY_SEPARATOR, '', $pathSuratPermohonan);
    $pathProposal = str_replace($projectRoot . DIRECTORY_SEPARATOR, '', $pathProposal);

    $q_max_id = $db->prepare("SELECT max(id_booking) as max_id FROM rb_booking");
    $q_max_id->execute();
    $max_id = $q_max_id->fetch(PDO::FETCH_ASSOC);
    $last_id = $max_id['max_id']+1;

    $insert_booking = $db->prepare("INSERT INTO rb_booking (id_booking,id_user,name,instansi,telp,alamat,nama_kegiatan,nomor_surat_permohonan,tanggal_surat_permohonan,perihal_surat_permohonan,upload_surat_permohonan,upload_proposal_rundown,spesimen,created_at) VALUES (:id_booking,:id_user,:name,:instansi,:telp,:alamat,:nama_kegiatan,:nomor_surat_permohonan,:tanggal_surat_permohonan,:perihal_surat_permohonan,:upload_surat_permohonan,:upload_proposal_rundown,:spesimen,:created_at)");
    $insert_booking->bindParam(':id_booking',$last_id);
    $insert_booking->bindParam(':id_user',$id_user);
    $insert_booking->bindParam(':name',$name);
    $insert_booking->bindParam(':instansi',$instansi);
    $insert_booking->bindParam(':telp',$telp);
    $insert_booking->bindParam(':alamat',$alamat);
    $insert_booking->bindParam(':nama_kegiatan',$nama_kegiatan);
    $insert_booking->bindParam(':nomor_surat_permohonan',$nomor_surat_permohonan);
    $insert_booking->bindParam(':tanggal_surat_permohonan',$tanggal_surat_permohonan);
    $insert_booking->bindParam(':perihal_surat_permohonan',$perihal_surat_permohonan);
    $insert_booking->bindParam(':upload_surat_permohonan',$pathSuratPermohonan);
    $insert_booking->bindParam(':upload_proposal_rundown',$pathProposal);
    $insert_booking->bindParam(':spesimen',$path_spesimen);
    $insert_booking->bindParam(':created_at',$created_at);
    $insert_booking->execute();

    for ($i=0; $i < count($tanggal_peminjaman) ; $i++) { 
      $insert_tanggal = $db->prepare("INSERT INTO rb_tanggal_booking (id_booking,tanggal,pukul_mulai,pukul_selesai) VALUES (:id_booking,:tanggal,:pukul_mulai,:pukul_selesai)");
      $insert_tanggal->bindParam(':id_booking',$last_id);
      $insert_tanggal->bindParam(':tanggal',$tanggal_peminjaman[$i]);
      $insert_tanggal->bindParam(':pukul_mulai',$pukul_mulai[$i]);
      $insert_tanggal->bindParam(':pukul_selesai',$pukul_selesai[$i]);
      $insert_tanggal->execute();
    }

    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Permohonan Berhasil Dibuat!'
    ];

    header('Location: ../index.php?pages=pengajuan_selesai&id='.$last_id);

  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'pengajuan_selesai'){
    $id = htmlentities($_GET['id']);

    // Get single booking row
    $q_data_permohonan = $db->prepare("SELECT * FROM rb_booking JOIN rb_posisi_berkas ON rb_booking.id_posisi_berkas = rb_posisi_berkas.id_posisi_berkas WHERE id_booking = :id");
    $q_data_permohonan->bindParam(':id', $id);
    $q_data_permohonan->execute();
    $data_permohonan = $q_data_permohonan->fetch(PDO::FETCH_ASSOC); // fetch only 1 row

    // Get all related tanggal_booking
    $q_tanggal = $db->prepare("SELECT * FROM rb_tanggal_booking WHERE id_booking = :id");
    $q_tanggal->bindParam(':id', $id);
    $q_tanggal->execute();
    $data_tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);

    $q_balasan = $db->prepare("SELECT * FROM rb_surat_balasan WHERE id_booking = :id_booking");
    $q_balasan->bindParam(':id_booking',$id);
    $q_balasan->execute();

    if($q_balasan->rowCount() > 0){
        $balasan = $q_balasan->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Merge tanggal array into main array
    $data_permohonan['tanggal'] = $data_tanggal;
    // dd($data_permohonan);
    include 'view/booking/bukti_pengajuan.php';
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'list_booking'){
    $id_user = htmlentities($_SESSION['id_user']);
    $role_id = htmlentities($_SESSION['role_id']);
    $params = [];

    if ($role_id == 1) {
        $sql = "SELECT * FROM rb_booking 
                JOIN rb_posisi_berkas ON rb_booking.id_posisi_berkas = rb_posisi_berkas.id_posisi_berkas 
                WHERE id_user = :id_user";
        $params[':id_user'] = $id_user;
    } else {
        $sql = "SELECT * FROM rb_booking 
                JOIN rb_posisi_berkas ON rb_booking.id_posisi_berkas = rb_posisi_berkas.id_posisi_berkas";
    }

    $q_permohonan = $db->prepare($sql);

    if ($role_id == 1) {
        $q_permohonan->bindParam(':id_user', $params[':id_user']);
    }

    $q_permohonan->execute();
    $permohonan = $q_permohonan->fetchAll(PDO::FETCH_ASSOC);

    foreach ($permohonan as $key => &$item) {
      // Get all related tanggal_booking
      $q_tanggal = $db->prepare("SELECT * FROM rb_tanggal_booking WHERE id_booking = :id");
      $q_tanggal->bindParam(':id', $item['id_booking']);
      $q_tanggal->execute();
      $data_tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
      

      // Merge tanggal array into main array
      $item['tanggal'] = $data_tanggal;
    }
    // dd($permohonan);
    include 'view/booking/list_booking.php';
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'ditolak'){
    include '../config/koneksi.php';
    $id_booking = htmlentities($_GET['id_booking']);
    $status_balasan = 'ditolak';
    $alasan = htmlentities($_GET['alasan']);
    $created_at = date('Y-m-d H:i:s');

    $create = $db->prepare("INSERT INTO rb_surat_balasan (id_booking,status_balasan,alasan,created_at) VALUES (:id_booking,:status_balasan,:alasan,:created_at)");
    $create->bindParam(':id_booking',$id_booking);
    $create->bindParam(':status_balasan',$status_balasan);
    $create->bindParam(':alasan',$alasan);
    $create->bindParam(':created_at',$created_at);
    $create->execute();

    $update = $db->prepare("UPDATE rb_booking SET id_posisi_berkas = 1 WHERE id_booking = :id_booking");
    $update->bindParam(':id_booking',$id_booking);
    $update->execute();
    
    $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Berhasil ditolak.'
    ];
    
        header('Location: ../index.php?pages=list_booking');

  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'approve'){
    $id_booking = htmlentities($_GET['id_booking']);
    $id_posisi_berkas = htmlentities($_GET['id_posisi_berkas']);
    $posisi_approve = $id_posisi_berkas+1;

    $update = $db->prepare("UPDATE rb_booking SET id_posisi_berkas = :posisi_approve WHERE id_booking = :id_booking");
    $update->bindParam(':posisi_approve',$posisi_approve);
    $update->bindParam(':id_booking',$id_booking);
    $update->execute();

    if(htmlentities(isset($_GET['sub_pages']))){
      $nomor_surat_balasan = htmlentities($_GET['nomor_surat_balasan']);
      $tanggal_surat_balasan = htmlentities($_GET['tanggal_surat_balasan']);
      $id_booking = htmlentities($_GET['id_booking']);
      $status_balasan = 'diterima';
      $created_at = date('Y-m-d H:i:s');

      $create = $db->prepare("INSERT INTO rb_surat_balasan (id_booking,status_balasan,nomor_surat_balasan,tanggal_surat_balasan,created_at) VALUES (:id_booking,:status_balasan,:nomor_surat_balasan,:tanggal_surat_balasan,:created_at)");
      $create->bindParam(':id_booking',$id_booking);
      $create->bindParam(':status_balasan',$status_balasan);
      $create->bindParam(':nomor_surat_balasan',$nomor_surat_balasan);
      $create->bindParam(':tanggal_surat_balasan',$tanggal_surat_balasan);
      $create->bindParam(':created_at',$created_at);
      $create->execute();
    }

    $q_permohonan = $db->prepare("SELECT * FROM rb_booking JOIN rb_posisi_berkas ON rb_booking.id_posisi_berkas = rb_posisi_berkas.id_posisi_berkas");
    $q_permohonan->execute();
    $permohonan = $q_permohonan->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($permohonan as $key => &$value_) {
      // Get all related tanggal_booking
      $q_tanggal = $db->prepare("SELECT * FROM rb_tanggal_booking WHERE id_booking = :id");
      $q_tanggal->bindParam(':id', $value_['id_booking']);
      $q_tanggal->execute();
      $data_tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
      

      // Merge tanggal array into main array
      $value_['tanggal'] = $data_tanggal;
    }
    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Berhasil diapprove.'
    ];
    
    include 'view/booking/list_booking.php';
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'edit_permohonan'){
    $id = htmlentities($_GET['id']);
    $q_data_permohonan = $db->prepare("SELECT * FROM rb_booking WHERE id_booking = :id");
    $q_data_permohonan->bindParam(':id',$id);
    $q_data_permohonan->execute();
    $data_permohonan = $q_data_permohonan->fetch(PDO::FETCH_ASSOC);
    // Get all related tanggal_booking
    $q_tanggal = $db->prepare("SELECT * FROM rb_tanggal_booking WHERE id_booking = :id");
    $q_tanggal->bindParam(':id', $id);
    $q_tanggal->execute();
    $data_tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
    
    include 'view/booking/edit_permohonan.php';
  }elseif(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'save_edit')){
    include '../config/koneksi.php';
    
    $id_booking = htmlentities($_POST['id_booking']);
    $name = htmlentities($_POST['name']);
    $instansi = htmlentities($_POST['instansi']);
    $telp = htmlentities($_POST['telp']);
    $alamat = htmlentities($_POST['alamat']);
    $nama_kegiatan = htmlentities($_POST['nama_kegiatan']);
    $nomor_surat_permohonan = htmlentities($_POST['nomor_surat_permohonan']);
    $tanggal_surat_permohonan = htmlentities($_POST['tanggal_surat_permohonan']);
    $perihal_surat_permohonan = htmlentities($_POST['perihal_surat_permohonan']);
    
    $id_tanggal_booking = array_map('htmlentities', $_POST['id_tanggal_booking']);
    $tanggal_peminjaman = array_map('htmlentities', $_POST['tanggal_peminjaman']);
    $pukul_mulai = array_map('htmlentities', $_POST['pukul_mulai']);
    $pukul_selesai = array_map('htmlentities', $_POST['pukul_selesai']);

    $update_booking = $db->prepare("UPDATE rb_booking SET name=:name,instansi=:instansi,telp=:telp,alamat=:alamat,nama_kegiatan=:nama_kegiatan,nomor_surat_permohonan=:nomor_surat_permohonan,tanggal_surat_permohonan=:tanggal_surat_permohonan,perihal_surat_permohonan=:perihal_surat_permohonan WHERE id_booking=:id");
    $update_booking->bindParam(':id',$id_booking);
    $update_booking->bindParam(':name',$name);
    $update_booking->bindParam(':instansi',$instansi);
    $update_booking->bindParam(':telp',$telp);
    $update_booking->bindParam(':alamat',$alamat);
    $update_booking->bindParam(':nama_kegiatan',$nama_kegiatan);
    $update_booking->bindParam(':nomor_surat_permohonan',$nomor_surat_permohonan);
    $update_booking->bindParam(':tanggal_surat_permohonan',$tanggal_surat_permohonan);
    $update_booking->bindParam(':perihal_surat_permohonan',$perihal_surat_permohonan);
    $update_booking->execute();

    for ($i=0; $i < count($tanggal_peminjaman); $i++) { 
      if(!empty($id_tanggal_booking[$i])){
        $update_tanggal = $db->prepare("UPDATE rb_tanggal_booking SET tanggal=:tanggal,pukul_mulai=:pukul_mulai,pukul_selesai=:pukul_selesai WHERE id_tanggal_booking=:id_tanggal_booking");
        $update_tanggal->bindParam(':tanggal',$tanggal_peminjaman[$i]);
        $update_tanggal->bindParam(':pukul_mulai',$pukul_mulai[$i]);
        $update_tanggal->bindParam(':pukul_selesai',$pukul_selesai[$i]);
        $update_tanggal->bindParam(':id_tanggal_booking',$id_tanggal_booking[$i]);
        $update_tanggal->execute();
      }else{
        $insert_tanggal = $db->prepare("INSERT INTO rb_tanggal_booking (id_booking,tanggal,pukul_mulai,pukul_selesai) VALUES (:id_booking,:tanggal,:pukul_mulai,:pukul_selesai)");
        $insert_tanggal->bindParam('id_booking',$id_booking);
        $insert_tanggal->bindParam('tanggal',$tanggal_peminjaman[$i]);
        $insert_tanggal->bindParam('pukul_mulai',$pukul_mulai[$i]);
        $insert_tanggal->bindParam('pukul_selesai',$pukul_selesai[$i]);
        $insert_tanggal->execute();
      }
    }
    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Berhasil di edit.'
    ];
    
    header('Location: ../index.php?pages=pengajuan_selesai&id='.$id_booking);
  }
  else{
    
      $q_tanggal = $db->prepare("SELECT tanggal FROM rb_tanggal_booking");
      $q_tanggal->execute();
      $tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
      foreach ($tanggal as $key => $value_tanggal) {
        $bookedDates[] = $value_tanggal['tanggal']; // format: YYYY-MM-DD
      }
    include 'view/booking/index.php';
  }
?>