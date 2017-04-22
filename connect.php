<?php

// 1. Establish MySQL Connection
$host = 'uscitp.com';
$user = 'sophiajl_dvduser';
$pass = 'dvduser';
$db = 'sophiajl_wine_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    exit("MySQL Connection Error: " . mysqli_connect_error());
}