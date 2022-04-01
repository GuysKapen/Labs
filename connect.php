<?php
    $conn = new mysqli('127.0.0.1', 'guysLab', 'guysLab', 'lab');
    if ($conn->connect_error) {
        echo "Connect Failed: " . $conn->error;
    }