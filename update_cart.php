<?php
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($_SESSION['cart'][$data['index']])) {
        $_SESSION['cart'][$data['index']]['jumlah'] = $data['jumlah'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
?>