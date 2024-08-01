<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_code'])) {
    $order_code = $_POST['order_code'];

    // Mengambil tanggal pesanan dari tabel orders
    $sql_order = "SELECT order_date FROM orders WHERE order_code = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("s", $order_code);
    $stmt_order->execute();
    $stmt_order->bind_result($order_date_raw);
    $stmt_order->fetch();
    $stmt_order->close();

    $order_date = '';
    $order_time = '';
    if ($order_date_raw) {
        $order_date = date('d-m-Y', strtotime($order_date_raw));
        $order_time = date('H:i', strtotime($order_date_raw));
    }

    // Mengambil detail pesanan dari tabel order_details
    $sql_details = "SELECT item_name, quantity, price, total FROM order_details WHERE order_code = ?";
    $stmt_details = $conn->prepare($sql_details);
    $stmt_details->bind_param("s", $order_code);
    $stmt_details->execute();
    $stmt_details->bind_result($item_name, $quantity, $price, $total);
    
    $total_harga = 0;
    $results_found = false;

    while ($stmt_details->fetch()) {
        if (!$results_found) {
            $results_found = true;
            echo '<p style="text-align: center; font-size: 20px; margin-bottom: 1%;">Tanggal Pesanan: ' . htmlspecialchars($order_date) . ' Pukul: ' . htmlspecialchars($order_time) . '</p>';
            echo '<table class="table">';
            echo '<thead><tr><th>Nama Menu</th><th class="text-center">Jumlah</th><th class="text-center">Harga</th><th class="text-center">Total</th></tr></thead>';
            echo '<tbody>';
        }

        $total_harga += $total;
        echo '<tr>';
        echo '<td>' . htmlspecialchars($item_name) . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($quantity) . '</td>';
        echo '<td class="text-center">Rp' . number_format($price, 0, ',', '.') . '</td>';
        echo '<td class="text-center">Rp' . number_format($total, 0, ',', '.') . '</td>';
        echo '</tr>';
    }

    if ($results_found) {
        echo '</tbody>';
        echo '</table>';
        echo '<p style="text-align: right; font-size: 22px; margin-top: 1%; margin-bottom: -2%;"><strong>Total Harga: Rp' . number_format($total_harga, 0, ',', '.') . '</strong></p>';
    } else {
        echo 'Tidak ada detail pesanan yang ditemukan.';
    }

    $stmt_details->close();
}
?>