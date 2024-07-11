<?php
session_start();

$response = array();

if (isset($_GET['index']) && isset($_GET['quantity'])) {
    $index = intval($_GET['index']);
    $quantity = intval($_GET['quantity']);

    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['jumlah'] = $quantity;
        $response['success'] = true;
        $response['message'] = "Jumlah barang berhasil diperbarui.";
    } else {
        $response['success'] = false;
        $response['message'] = "Barang tidak ditemukan dalam keranjang.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Parameter tidak lengkap.";
}

echo json_encode($response);
?>