<?php
    // $tanggal_mulai = htmlentities($_GET['tanggal']);
    
      $q_tanggal = $db->prepare("SELECT tanggal FROM rb_tanggal_booking");
      $q_tanggal->execute();
      $tanggal = $q_tanggal->fetchAll(PDO::FETCH_ASSOC);
      foreach ($tanggal as $key => $value_tanggal) {
        $bookedDates[] = $value_tanggal['tanggal']; // format: YYYY-MM-DD
      }
    include "view/calendar_booking/index.php";
?>