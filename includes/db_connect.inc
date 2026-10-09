<?php
// Single database connection used by every page (MySQLi procedural)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // Localhost: development settings, show errors
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $host     = 'localhost';
    $user     = 'root';
    $password = '';
    $database = 'bookverse';
} else {
    // Coreteaching / Jacob 5
    $host     = 'talsprddb02.int.its.rmit.edu.au';
    $user     = 's4202989';
    include('/home/sh9/S4202989/.htdb_pass');   // defines $password
    $database = 's4202989';
}

$conn = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($conn, 'utf8mb4');
