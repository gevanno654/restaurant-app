<?php
    session_start();
    if (isset($_GET['index'])) {
        $index = $_GET['index'];
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            echo "Item berhasil dihapus.";
        } else {
            echo "Item tidak ditemukan.";
        }
    } else {
        echo "Indeks item tidak valid.";
    }
    ?>