<?php
ini_set('display_errors', 1);
$conn = mysqli_connect('localhost', 'root', 'v1a9', 'allpet2');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

?>