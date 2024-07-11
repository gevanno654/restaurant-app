<?php
    session_start();
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Keranjang sudah kosong.']);
    }
    ?>