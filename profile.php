<?php

session_start();

require_once "connect.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pass']);



// Session Syntax: $_SESSION['var_name']

// Check if user is already logged in.
if ( is_null($_SESSION['logged_in']) ) {
    // User not logged in.

    // Check for empty credentials
    if ( empty($username) || empty($password) ) {
        // Empty credentials.
        echo "Please enter username & password.<br>";
        include 'login.php';
        exit();
    }

    $password = hash('SHA256', $password);
    $sql = "SELECT *
					FROM users
					WHERE users.username = '$username'
						AND users.password = '$password'";

    $results = mysqli_query($conn, $sql);
    if(!$results){
        exit("SQL Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($results) > 0){
        // Correct credentials.
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
    } else {
        // Invalid credentials.
        echo "Invalid credentials. <br>";
        include 'login.php';
        exit();
    }

}

if($_SESSION['logged_in']){
    header("Location: home.php");
}

?>












