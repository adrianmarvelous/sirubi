<?php
    include '../config/koneksi.php';
    
    if(htmlentities(isset($_GET['action']))){
        if(htmlentities($_GET['action']) == 'update'){
            $id_user = htmlentities($_GET['id_user']);
            $nama = htmlentities($_GET['name']);
            $instansi = htmlentities($_GET['instansi']);
            $telp = htmlentities($_GET['telp']);
            $alamat = htmlentities($_GET['alamat']);

            $update = $db->prepare("UPDATE rb_users SET name = :name, instansi = :instansi, telp = :telp, alamat = :alamat WHERE id_user = :id_user");
            $update->bindParam(':id_user', $id_user);
            $update->bindParam(':name', $nama);
            $update->bindParam(':instansi', $instansi);
            $update->bindParam(':telp', $telp);
            $update->bindParam(':alamat', $alamat);
            $update->execute();
        }
    }
    
    $_SESSION['alert'] = [
        'type' => 'success', // 'success', 'info', 'warning', or 'danger'
        'message' => 'Akun Berhasil Diupdate!'
    ];
    header('Location: ../index.php');

?>