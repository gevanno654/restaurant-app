<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_code'])) {
    $order_code = $_POST['order_code'];

    $sql = "SELECT order_id FROM orders WHERE order_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $order_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo $row['order_id'];
    } else {
        echo "Order ID not found";
    }

    $stmt->close();
} else {
    echo "Invalid request";
}
?>