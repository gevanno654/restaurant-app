<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_code'])) {
    $order_code = $_POST['order_code'];

    // Mengambil order_id dari tabel orders
    $sql_order = "SELECT order_id FROM orders WHERE order_code = ?";
    $stmt_order = $conn->prepare($sql_order);
    if ($stmt_order) {
        $stmt_order->bind_param("s", $order_code);
        $stmt_order->execute();
        $stmt_order->bind_result($order_id);
        $stmt_order->fetch();
        $stmt_order->close();

        if ($order_id) {
            echo json_encode(['order_id' => $order_id]);
        } else {
            echo json_encode(['error' => 'Order ID tidak ditemukan.']);
        }
    } else {
        echo json_encode(['error' => 'Terjadi kesalahan saat memproses permintaan.']);
    }
} else {
    echo json_encode(['error' => 'Kode pesanan tidak valid.']);
}
?>
