<?php
    // $tanggal_mulai = htmlentities($_GET['tanggal']);
    $q_tanggal = $db->prepare("SELECT instansi, tanggal FROM rb_tanggal_booking JOIN rb_booking ON rb_booking.id_booking = rb_tanggal_booking.id_booking");
    $q_tanggal->execute();
    $tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);

    $bookedEvents = [];
    foreach ($tanggal as $value_tanggal) {
    $bookedEvents[] = [
        'title' => $value_tanggal['instansi'], // 🏢 name of instansi
        'start' => $value_tanggal['tanggal'],  // 📅 YYYY-MM-DD
        'color' => 'red'                       // optional: make it red
    ];
    }

    include "view/calendar_booking/index.php";
?>