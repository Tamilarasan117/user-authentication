<?php
    $hostname = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "auth_database";

    # database connection
    $conn = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);

    # check connection
    if(!$conn) {
        die("Somthing went wrong?");
    }
?>