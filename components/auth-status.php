<?php
// starting the session
session_start();

// checked for previous session 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $auth_status = false;
} else {
    $auth_status = true;
    // define('DB_EMAIL', $_SESSION['email']);

}


?>