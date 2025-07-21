<?php
    session_start();
    session_unset();     // Unset all session variables
    session_destroy();   // Destroy the session

    // Optional: redirect to Google logout too
    // header("Location: https://accounts.google.com/Logout");

    // Redirect to login page or home
    header("Location: ../../login.php");
    exit;
