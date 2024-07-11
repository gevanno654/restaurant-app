<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_code'])) {
    $order_code = $_POST['order_code'];

    // Mengambil tanggal pesanan dari tabel orders
    $sql_order = "SELECT order_date FROM orders WHERE order_code = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("s", $order_code);
    $stmt_order->execute();
    $result_order = $stmt_order->get_result();
    $stmt_order->close();

    $order_date = '';
    $order_time = '';
    if ($result_order->num_rows > 0) {
        $row_order = $result_order->fetch_assoc();
        $order_date = date('d-m-Y', strtotime($row_order['order_date']));
        $order_time = date('H:i', strtotime($row_order['order_date']));
    }

    // Mengambil detail pesanan dari tabel order_details
    $sql_details = "SELECT * FROM order_details WHERE order_code = (SELECT order_code FROM orders WHERE order_code = ?)";
    $stmt_details = $conn->prepare($sql_details);
    $stmt_details->bind_param("s", $order_code);
    $stmt_details->execute();
    $result_details = $stmt_details->get_result();
    $stmt_details->close();

    $total_harga = 0;
    if ($result_details->num_rows > 0) {
        echo '<p style="text-align: center; font-size: 20px; margin-bottom: 1%;">Tanggal Pesanan: ' . htmlspecialchars($order_date) . ' Pukul: ' . htmlspecialchars($order_time) . '</p>';
        echo '<table class="table">';
        echo '<thead><tr><th>Nama Menu</th><th class="text-center">Jumlah</th><th class="text-center">Harga</th><th class="text-center">Total</th></tr></thead>';
        echo '<tbody>';
        while ($row_details = $result_details->fetch_assoc()) {
            $total_harga += $row_details['total'];
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row_details['item_name']) . '</td>';
            echo '<td class="text-center">' . htmlspecialchars($row_details['quantity']) . '</td>';
            echo '<td class="text-center">Rp' . number_format($row_details['price'], 0, ',', '.') . '</td>';
            echo '<td class="text-center">Rp' . number_format($row_details['total'], 0, ',', '.') . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<p style="text-align: right; font-size: 22px; margin-top: 1%; margin-bottom: -2%;"><strong>Total Harga: Rp' . number_format($total_harga, 0, ',', '.') . '</strong></p>';
    } else {
        echo 'Tidak ada detail pesanan yang ditemukan.';
    }
}
?>