<?php
    error_reporting(0);

    function connect($user, $password) {
        $db = new mysqli($_ENV["MYSQL_URL"], $user, $password, 'vogler_logistics', 3306);
        $db->set_charset('utf8');

        if ($db->connect_error) {
            die('Sorry - Something did not work');
        }

        return $db;
    }
?>