<?php
include('layout/header.php');
session_start();

// Hapus sesi keranjang belanja
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
?>

<div class="page-container">
    <div class="thank-you-container">
        <h1 class="thank-you-title" style="font-weight: bold;">Thank You for Your Order!</h1>
        <?php if (isset($_GET['order_code'])): ?>
            <div style="font-size: 24px; margin-top: 3%; margin-bottom: 1%;">Kode Pesanan Anda: </div>
            <div class="card-kode-pesanan">
                <div class="bg">
                    <div style="display: flex; justify-content: center; text-align: center; font-size: 32px; font-weight: bold;"><?php echo htmlspecialchars($_GET['order_code']); ?></div>
                </div>
                <div class="blob"></div>
            </div>
        <?php endif; ?>
        <div style="font-size: 22px; margin-top: 3%;">Sihlakan tunjukkan kode pesanan ke kasir untuk melanjutkan pembayaran!</div>
        <a href="home.php" class="btn btn-success" style="margin-top: 1%; font-size: 18px;">Kembali ke Beranda</a>
    </div>
</div>

<?php
include('layout/footer.php');
?>