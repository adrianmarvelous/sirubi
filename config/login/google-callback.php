<?php
session_start();
ini_set('display_errors', 1);
error_reporting(~0);

require_once 'config-google.php';
require_once '../koneksi.php';

if (isset($_GET['code'])) {
    // For older versions of google-api-php-client
    $client->authenticate($_GET['code']);
    $token = $client->getAccessToken();
    
    if ($token) {
        $client->setAccessToken($token);

        $oauth = new Google_Service_Oauth2($client);
        $user = $oauth->userinfo->get();

        $_SESSION['auth'] = 'auth';
        $created_at = date('Y-m-d H:i:s');
        $role = 1;

        // Check if user exists
        $stmt = $db->prepare("SELECT * FROM rb_users WHERE email = :email");
        $stmt->bindParam(':email', $user->email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // Insert new user
            $stmt_insert = $db->prepare("INSERT INTO rb_users (name, email, google_id, picture, role, created_at)
                VALUES (:name, :email, :google_id, :picture, :role, :created_at)");
            $stmt_insert->bindParam(':name', $user->name);
            $stmt_insert->bindParam(':email', $user->email);
            $stmt_insert->bindParam(':google_id', $user->id);
            $stmt_insert->bindParam(':picture', $user->picture);
            $stmt_insert->bindParam(':role', $role);
            $stmt_insert->bindParam(':created_at', $created_at);
            $stmt_insert->execute();

            // Set session manually
            $_SESSION['name'] = $user->user_name;
            $_SESSION['email'] = $user->user_email;
            $_SESSION['role'] = $role;
            $_SESSION['picture'] = $user->picture;
        } else {
            // User exists, fetch data
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['name'] = $user_data['name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['role'] = $user_data['role'];
            $_SESSION['picture'] = $user_data['picture'];
        }
        header("Location: https://localhost/rumah-bhinneka/index.php");
        exit;
    } else {
        echo "Google authentication failed.";
    }
} else {
    echo "No code from Google.";
}
