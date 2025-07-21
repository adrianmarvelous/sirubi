<?php
    include '../config/koneksi.php';

    $action = htmlentities($_POST['action']);

    if($action == 'register'){
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $password_repeat = htmlentities($_POST['password_repeat']);

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
        }elseif($password != $password_repeat){
            $_SESSION['alert'] = [
                'type' => 'danger', // 'success', 'info', 'warning', or 'danger'
                'message' => 'Password tidak sama.'
            ];
            header('Location: ../register.php'); // Replace with your actual form page
            exit;

        }else{
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $created_at = date('Y-m-d H:i:s');
            $role = 1; // Default role for new users

            $insert = $db->prepare("INSERT INTO rb_users (name, email, password,role, created_at) VALUES (:name, :email, :password,:role,:created_at)");
            $insert->bindParam(':name', $name);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':password', $hashedPassword);
            $insert->bindParam(':role', $role);
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

        $q_user = $db->prepare("SELECT * FROM rb_users WHERE email = :email");
        $q_user->bindParam(':email', $email);
        $q_user->execute();

        if($q_user->rowCount() > 0){
            $user = $q_user->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $user['password'])){
                $_SESSION['auth'] = 'auth';
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                // $_SESSION['picture'] = $user['picture'];

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