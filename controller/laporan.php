<?php

if (htmlentities(isset($_POST['pages'])) && htmlentities($_POST['pages']) == 'simpan_laporan') {
    // include 'config/koneksi.php';
    
    // Example: get the answers for each question
    $pertanyaan_1 = $_POST['pertanyaan_1'];
    $pertanyaan_2 = $_POST['pertanyaan_2'];
    $pertanyaan_3 = $_POST['pertanyaan_3'];
    $pertanyaan_4 = $_POST['pertanyaan_4'];
    $pertanyaan_5 = $_POST['pertanyaan_5'];

    $max_id = $db->query("SELECT MAX(id) FROM rb_laporan");
    $max_id->execute();
    $next_id = $max_id->fetchColumn() + 1;

    $insert_laporan = $db->prepare("INSERT INTO rb_laporan (id, id_booking, pertanyaan_1, pertanyaan_2, pertanyaan_3, pertanyaan_4, pertanyaan_5) VALUES (:id, :id_booking, :pertanyaan_1, :pertanyaan_2, :pertanyaan_3, :pertanyaan_4, :pertanyaan_5)");
    $insert_laporan->bindParam(':id', $next_id);
    $insert_laporan->bindParam(':id_booking', $_POST['id_booking']);
    $insert_laporan->bindParam(':pertanyaan_1', $pertanyaan_1);
    $insert_laporan->bindParam(':pertanyaan_2', $pertanyaan_2);
    $insert_laporan->bindParam(':pertanyaan_3', $pertanyaan_3);
    $insert_laporan->bindParam(':pertanyaan_4', $pertanyaan_4);
    $insert_laporan->bindParam(':pertanyaan_5', $pertanyaan_5);
    $insert_laporan->execute();


    // Directory to save uploaded images
    $uploadDir = 'resources/upload/foto_kegiatan/';

    // Create directory if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pages']) && $_POST['pages'] === 'simpan_laporan') {

        if (isset($_FILES['foto_kegiatan']) && !empty($_FILES['foto_kegiatan']['name'][0])) {

            $files = $_FILES['foto_kegiatan'];
            $uploadedFiles = [];
            $failedFiles = [];

            for ($i = 0; $i < count($files['name']); $i++) {
                $fileName = basename($files['name'][$i]);
                $fileTmp  = $files['tmp_name'][$i];
                $fileSize = $files['size'][$i];
                $fileType = $files['type'][$i];

                // Validate MIME type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!in_array($fileType, $allowedTypes)) {
                    $failedFiles[] = "$fileName (format tidak diperbolehkan)";
                    continue;
                }

                // Validate file extension
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowedExtensions)) {
                    $failedFiles[] = "$fileName (ekstensi tidak diperbolehkan)";
                    continue;
                }

                // Validate file size (max 5MB)
                if ($fileSize > 5 * 1024 * 1024) {
                    $failedFiles[] = "$fileName (terlalu besar)";
                    continue;
                }

                // Generate unique file name
                $newFileName = uniqid() . '_' . $fileName;

                // Move uploaded file
                if (move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
                    $uploadedFiles[] = $newFileName;

                    // Full path to store in DB
                    $fullPath = $uploadDir . $newFileName; // e.g., resources/upload/foto_kegiatan/uniqid_file.jpg

                    $createdAt = date('Y-m-d H:i:s');
                    // Insert into database with full path
                    $insertFoto = $db->prepare("INSERT INTO rb_laporan_foto (id_laporan, path, created_at) VALUES (:id_laporan, :filename,:created_at)");
                    $insertFoto->bindParam(':id_laporan', $next_id);
                    $insertFoto->bindParam(':filename', $fullPath); // store full path
                    $insertFoto->bindParam(':created_at', $createdAt); // store full path
                    $insertFoto->execute();

                } else {
                    $failedFiles[] = "$fileName (gagal diupload)";
                }

            }

            // Set session alert
            if (!empty($uploadedFiles) && empty($failedFiles)) {
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Semua foto berhasil diupload.'
                ];
            } elseif (!empty($uploadedFiles) && !empty($failedFiles)) {
                $_SESSION['alert'] = [
                    'type' => 'warning',
                    'message' => 'Berhasil: ' . implode(', ', $uploadedFiles) . '. Gagal: ' . implode(', ', $failedFiles)
                ];
            } else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Semua file gagal diupload: ' . implode(', ', $failedFiles)
                ];
            }
        } else {
            $_SESSION['alert'] = [
                'type' => 'warning',
                'message' => 'Tidak ada file yang dipilih.'
            ];
        }

        // Redirect using JavaScript to avoid "headers already sent"
        echo '<script>
                alert("' . $_SESSION['alert']['message'] . '");
                window.location.href = "index.php?pages=list_booking";
            </script>';
        exit;
    }
} else {
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
    $data_permohonan['tanggal'] = $data_tanggal;
    
    $q_laporan = $db->prepare("SELECT * FROM rb_laporan WHERE id_booking = :id");
    $q_laporan->bindParam(':id', $id);
    $q_laporan->execute();

    if($q_laporan->rowCount() > 0) {

        $laporan = $q_laporan->fetch(PDO::FETCH_ASSOC);
        $q_foto = $db->prepare("SELECT * FROM rb_laporan_foto WHERE id_laporan = :id_laporan");
        $q_foto->bindParam('id_laporan',$laporan['id']);
        $q_foto->execute();
        $foto_kegiatan = $q_foto->fetchAll(PDO::FETCH_ASSOC);

        $laporan['foto_kegiatan'] = $foto_kegiatan;

        include 'view/laporan/detail.php';
    }else{

        include 'view/laporan/create.php';
    }

}
