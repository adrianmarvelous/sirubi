<?php
    include '../config/koneksi.php';

    $action = htmlentities($_POST['action']);

    if($action == 'register'){
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        $q_email = $db->prepare("SELECT * FROM rb_users WHERE email = :email");
        $q_email->bindParam(':email', $email);
        $q_email->execute();
        if($q_email->rowCount() > 0){
            $_SESSION['alert'] = [
                'type' => 'danger', // 'success', 'info', 'warning', or 'danger'
                'message' => 'Email Sudah Terdaftar.'
            ];
            header('Location: ../register.php'); // Replace with your actual form page
            exit;
        }else{
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $created_at = date('Y-m-d H:i:s');
            $role = 1; // Default role for new users

            $insert = $db->prepare("INSERT INTO rb_users (name, email, password,role_id, created_at) VALUES (:name, :email, :password,:role_id,:created_at)");
            $insert->bindParam(':name', $name);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':password', $hashedPassword);
            $insert->bindParam(':role_id', $role);
            $insert->bindParam(':created_at', $created_at);
            $insert->execute();

            $_SESSION['alert'] = [
                'type' => 'success', // 'success', 'info', 'warning', or 'danger'
                'message' => 'Akun Berhasil dibuat! Silahkan Login.'
            ];
            header('Location: ../login.php'); // Replace with your actual form page
            exit;
        }
    }elseif($action == 'login'){
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        $q_user = $db->prepare("SELECT * FROM rb_users JOIN rb_role ON rb_users.role_id = rb_role.id_role  WHERE email = :email");
        $q_user->bindParam(':email', $email);
        $q_user->execute();

        if($q_user->rowCount() > 0){
            $user_data = $q_user->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $user_data['password'])){
                
                $_SESSION['id_user'] = $user_data['id_user'];
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['role_id'] = $user_data['id_role'];
                $_SESSION['role'] = $user_data['role'];
                $_SESSION['auth'] = 'auth';
                // $_SESSION['picture'] = $user_data['picture'];

                header('Location: ../index.php'); // Redirect to the main page after login
                exit;
            }else{
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Password salah.'
                ];
                header('Location: ../login.php');
                exit;
            }
        }else{
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Email tidak terdaftar.'
            ];
            header('Location: ../login.php');
            exit;
        }
    }
?>