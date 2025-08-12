<?php
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
    

    include 'view/laporan/detail.php'
?>