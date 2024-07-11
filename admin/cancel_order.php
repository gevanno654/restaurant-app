<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Menghapus pesanan dari database
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke halaman admin index
    header("Location: index.php");
    exit();
} else {
    // Jika tidak ada order_id yang diberikan, redirect ke halaman admin index
    header("Location: index.php");
    exit();
}
?>