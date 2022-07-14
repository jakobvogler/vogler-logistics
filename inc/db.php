<?php
error_reporting(0);
$db = new mysqli('localhost', 'root', '', 'vogler_logistics');
$db->set_charset('utf8');

if ($db->connect_error) {
    die('Sorry - Etwas funktioniert nicht');
}
?>