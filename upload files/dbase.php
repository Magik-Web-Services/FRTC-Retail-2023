<?php 

// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "frtc-retail"; 

// Create database connection 
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection 

// if ($conn) {
//     echo '<script>alert("Connection Success!")</script>';
// } else {
    // echo '<script>alert("Connection Failed!")</script>';
// }

?>