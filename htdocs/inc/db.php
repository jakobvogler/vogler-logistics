<?php
    error_reporting(0);

    function connect($user, $password) {
        $db = mysqli_init();
        $db->ssl_set(NULL, NULL, "/etc/ssl/certs/ca-certificates.crt", NULL, NULL);
        $db->real_connect(getenv("MYSQL_URL"), $user, $password, getenv("DB_NAME"));

        if ($db->connect_error) {
            die('Sorry - Something did not work');
        }

        return $db;
    }
?>