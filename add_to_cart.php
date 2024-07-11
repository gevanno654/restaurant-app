<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$item = [
    'nama' => $data['nama'],
    'harga' => $data['harga'],
    'jumlah' => $data['jumlah']
];

array_push($_SESSION['cart'], $item);

echo json_encode(['success' => true]);
?>