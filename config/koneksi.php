<?php
    // Database connection variables
    $db_host = 'localhost';
    $db_name = 'rb';
    $db_user = 'root';
    $db_pass = '';
    // Attempt to connect to database
    try {
        $db = new PDO(
            "mysql:host=$db_host;dbname=$db_name;charset=utf8",
            $db_user,
            $db_pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        exit("❌ Database connection failed: " . $e->getMessage());
    }
    
    if (!function_exists('dd')) {
        /**
         * Dump the given variables and end script execution.
         *
         * @param  mixed  ...$vars
         * @return void
         */
        function dd(...$vars) {
            foreach ($vars as $var) {
                echo '<pre>';
                var_dump($var);
                echo '</pre>';
            }
            die(1);
        }
    }
?>