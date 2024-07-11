<?php
include('../config/db.php');

$sql = "SELECT * FROM orders WHERE status = 0";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

echo json_encode($orders);
?>