<?php
  if(htmlentities(isset($_POST['action'])) &&  htmlentities($_POST['action'] == 'change_role')){
    include '../config/koneksi.php';
    $role_id = htmlentities($_POST['role']);
    $id_user = htmlentities($_POST['id_user']);
    
    $update = $db->prepare("UPDATE rb_users SET role_id = :role_id WHERE id_user = :id_user");
    $update->bindParam(':role_id',$role_id);
    $update->bindParam(':id_user',$id_user);
    $update->execute();
    
          $_SESSION['alert'] = [
              'type' => 'success',
              'message' => 'Berhasil merubah role!'
          ];
        header('Location: ../index.php?pages=users');
  }else{
    $q_users = $db->prepare("SELECT * FROM rb_users JOIN rb_role ON rb_users.role_id = rb_role.id_role");
    $q_users->execute();
    $users = $q_users->fetchAll(PDO::FETCH_ASSOC);

    $q_role =$db->prepare("SELECT * FROM rb_role");
    $q_role->execute();
    $role = $q_role->fetchAll(PDO::FETCH_ASSOC);

    include 'view/users/index.php';
  }
?>