<?php
session_start();
include('layout/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    $order_type = $_POST['order_type']; // Ambil tipe pesanan dari form
    $order_code = generateOrderCode($order_type); // Generate kode pesanan berdasarkan tipe

    saveOrderToDatabase($order_code);

    header("Location: thank_you.php?order_code=" . urlencode($order_code));
    exit();
}

function generateOrderCode($order_type) {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $order_code = $order_type == 'dine_in' ? 'D' : 'T'; // Awalan kode berdasarkan tipe pesanan

    for ($i = 0; $i < 2; $i++) {
        $order_code .= $letters[rand(0, strlen($letters) - 1)];
    }

    for ($i = 0; $i < 4; $i++) {
        $order_code .= $numbers[rand(0, strlen($numbers) - 1)];
    }

    return $order_code;
}

function saveOrderToDatabase($order_code) {
    global $conn;
    $status = 0;

    $sql = "INSERT INTO orders (order_code, status) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $order_code, $status);
    $stmt->execute();
    $stmt->close();

    $total_harga_keseluruhan = 0;

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $item) {
            $item_name = $item['nama'];
            $quantity = $item['jumlah'];
            $price = intval(preg_replace("/[^0-9]/", "", $item['harga']));
            $total_harga_item = $price * $quantity;

            $total_harga_keseluruhan += $total_harga_item;

            $sql_detail = "INSERT INTO order_details (order_code, item_name, quantity, price, total) VALUES (?, ?, ?, ?, ?)";
            $stmt_detail = $conn->prepare($sql_detail);
            $stmt_detail->bind_param("ssidd", $order_code, $item_name, $quantity, $price, $total_harga_item);
            $stmt_detail->execute();
            $stmt_detail->close();
        }
    }
}
?>

<div class="checkout-container">
    <h1 class="checkout-title">Checkout</h1>
    <h3 style="margin-top: 50px; margin-bottom: 5px; margin-left: 10px;">Menu yang Anda pesan: </h3>
    <?php
    $total = 0;
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $item) {
            $harga = intval(preg_replace("/[^0-9]/", "", $item['harga']));
            $jumlah = (int)$item['jumlah'];
            $subtotal = $harga * $jumlah;
            $total += $subtotal;

            echo "<div class='checkout-item'>";
            echo "<h3 style='margin-left: 20px; font-weight: 700; font-size: 24px;'>" . htmlspecialchars($item['nama']) . "</h3>";
            echo "<div style='margin-top: 10px; margin-bottom: 10px;'>Rp " . number_format($harga, 0, ',', '.') . " x " . $jumlah . " = Rp " . number_format($subtotal, 0, ',', '.') . "</div>";
            echo "</div>";
        }

        echo "<div class='ppn'>*Total Harga sudah termasuk PPN.</div>";
        echo "<div class='checkout-total'>Total: Rp " . number_format($total, 0, ',', '.') . "</div>";
    } else {
        echo "<p>Keranjang kosong.</p>";
    }
    ?>
</div>

<!-- Modal Dine In -->
<div class="modal fade" id="dineInModal" tabindex="-1" role="dialog" aria-labelledby="dineInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-dinein-header">
                <h5 class="modal-dinein-title" id="dineInModalLabel">Dine In</h5>
            </div>
            <div class="modal-body">
                <form id="dineInForm" method="post" action="">
                    <input type="hidden" name="confirm_order" value="1">
                    <input type="hidden" name="order_type" value="dine_in">
                    <div class="form-group">
                        <label for="dine_in_name">Nama:</label>
                        <input type="text" class="form-control" id="dine_in_name" name="dine_in_name">
                    </div>
                    <div class="form-group">
                        <label for="dine_in_table">Nomor Tempat Duduk:</label>
                        <input type="text" class="form-control" id="dine_in_table" name="dine_in_table">
                    </div>
                    <div class="modal-dinein-footer">
                        <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
                        <button type="button" class="btn btn-secondary" style="margin-left: 2%;" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Take Away -->
<div class="modal fade" id="takeAwayModal" tabindex="-1" role="dialog" aria-labelledby="takeAwayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-takeaway-header">
                <h5 class="modal-takeaway-title" id="takeAwayModalLabel">Take Away</h5>
            </div>
            <div class="modal-body">
                <form id="takeAwayForm" method="post" action="">
                    <input type="hidden" name="confirm_order" value="1">
                    <input type="hidden" name="order_type" value="take_away">
                    <div class="form-group">
                        <label for="take_away_name">Nama:</label>
                        <input type="text" class="form-control" id="take_away_name" name="take_away_name">
                    </div>
                    <div class="form-group">
                        <label for="take_away_phone">Nomor HP:</label>
                        <input type="text" class="form-control" id="take_away_phone" name="take_away_phone">
                    </div>
                    <div class="modal-takeaway-footer">
                        <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
                        <button type="button" class="btn btn-secondary" style="margin-left: 2%;" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<h1 style="text-align: center; margin-top: 1%;">Tipe Pesanan:</h1>
<div class="container-tipe-pesanan">
    <div class="card-tipe-pesanan" data-bs-toggle="modal" data-bs-target="#dineInModal">
        <img src="img/dine-svgrepo-com.svg" style="width: 60%;">
        <p>Dine In</p>
    </div>
    <div class="card-tipe-pesanan" data-bs-toggle="modal" data-bs-target="#takeAwayModal">
        <img src="img/take-away-svgrepo-com.svg" style="width: 60%;">
        <p>Take Away</p>
    </div>
</div>

<button class="cancel-button-co" onclick="cancelCheckout()">Batalkan Pesanan</button>

<?php
include('layout/footer.php');
?>