<?php
  if(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'pilih_tanggal')){
        header('Location: ../index.php?pages=permohonan&tanggal=' . htmlentities($_POST['selected_date']));
  }elseif(htmlentities(isset($_GET['pages'])) && htmlentities($_GET['pages']) == 'permohonan'){
    $tanggal_mulai = htmlentities($_GET['tanggal']);
    include 'view/calendar/create.php';
  }elseif(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'create')){
    include '../config/koneksi.php';
    dd($_POST);
  }
  else{
    include 'view/calendar/index.php';
  }
?>