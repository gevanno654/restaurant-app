<?php
session_start();
$totalHarga = 0;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $key => $item) {
        echo "<div class='cart-item'>";
        echo htmlspecialchars($item['nama']) . " - " . $item['harga'];
        echo "<br>";
        echo    "<div class='quantity-container'>Jumlah:
                    <button class='quantity-button' id='spinner' onclick='decreaseQuantity(this)'>
                        <span>
                            <img src='img/minus-svgrepo-com.svg' style='width: 20px; height: 20px;'>
                        </span>
                    </button>
                    <input type='text' class='quantity-input' data-index='" . $key . "' value='" . $item['jumlah'] . "' min='1' onchange='updateQuantity(" . $key . ", this.value)'>
                    <button class='quantity-button' id='spinner' onclick='increaseQuantity(this)'>
                        <span>
                            <img src='img/plus-svgrepo-com.svg' style='width: 20px; height: 20px;'>
                        </span>
                    </button>
                </div>";
        echo "<button class='delete' onclick='removeItem(" . $key . ")'>";
        echo "<span class='delete__text'>Delete</span>";
        echo "<span class='delete__icon'><svg class='svg' height='512' viewBox='0 0 512 512' width='512' xmlns='http://www.w3.org/2000/svg'><title></title><path d='M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320' style='fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'></path><line style='stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px' x1='80' x2='432' y1='112' y2='112'></line><path d='M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40' style='fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'></path><line style='fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px' x1='256' x2='256' y1='176' y2='400'></line><line style='fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px' x1='184' x2='192' y1='176' y2='400'></line><line style='fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px' x1='328' x2='320' y1='176' y2='400'></line></svg></span>";
        echo "</button>";
        echo "</div>";
        echo "</div>";

        $hargaStr = $item['harga'];
        $hargaNumerik = intval(preg_replace('/\D/', '', $hargaStr));

        $totalHarga += $hargaNumerik * $item['jumlah'];
    }

    echo "<p style='font-size: 20px; font-weight: 700;'>Total Harga: Rp " . number_format($totalHarga, 0, ',', '.') . "</p>";

    echo "<button class='co-btn' onclick='redirectToCheckout()'>";
    echo "<div>";
    echo "<div class='pencil'></div>";
    echo "<div class='folder'>";
    echo "<div class='top'>";
    echo "<svg viewBox='0 0 24 27'>";
    echo "<path d='M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z'></path>";
    echo "</svg>";
    echo "</div>";
    echo "<div class='paper'></div>";
    echo "</div>";
    echo "</div>";
    echo "Checkout";
    echo "</button>";

} else {
    echo "<p>Keranjang kosong.</p>";
}
?>