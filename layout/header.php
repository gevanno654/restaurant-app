<?php
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="navbar">
    <h1 style="margin-right: 10px;">Semoga</h1>
    <img src="img/berkah_logos.png" alt="Berkah">
</div>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'checkout.php' && $current_page !== 'thank_you.php') {
    echo "<div class='menu'>";
    echo "<a href='home.php'>Home</a>";
    echo "<a href='paket_hemat.php'>Paket Hemat</a>";
    echo "<a href='rice_bowl.php'>Rice Bowl</a>";
    echo "<a href='makanan.php'>Makanan</a>";
    echo "<a href='minuman.php'>Minuman</a>";
    echo "<a href='side-dish.php'>Side Dish</a>";
    echo "</div>";
}
?>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'checkout.php' && $current_page !== 'thank_you.php') {
    echo "<div class='keranjang-container'>";
    echo "<button class='keranjang' onclick='openCartModal()'>";
    echo "<div class='svg-wrapper'>";
    echo "<img src='img/cart-svgrepo-com.svg'style='width: 25px; height: 25px;''>";
    echo "</div>";
    echo "<span>Keranjangku</span>";
    echo "</button>";
    echo "</div>";
}
?>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="font-weight: bold; width: 100%;">Keranjang</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cartModalContent"></div>
            </div>
        </div>
    </div>
</div>