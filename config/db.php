<?php
    $servername = "gevannoyoh.com";
    $username = "gevannoy_admin";
    $password = "Gevanno060504";
    $dbname = "gevannoy_restoran";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>