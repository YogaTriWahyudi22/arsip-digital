<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "arsip_digital";

    // Koneksi ke MySQL menggunakan PDO
    try {
        $conn = new PDO("mysql:host={$host}; dbname={$db}",$user,$pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
?>