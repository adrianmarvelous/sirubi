<?php
  if(htmlentities($_POST['action'] == 'pilih_tanggal')){
    include '../view/calendar/create.php';
  }else{
    include 'view/calendar/index.php';
  }
?>