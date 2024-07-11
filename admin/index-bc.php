<?php
include('layout/header.php');
include('../config/db.php');

$sql = "SELECT * FROM orders WHERE status = 0";
$result = $conn->query($sql);
?>

<h1 style="text-align: center; font-size: 36px; font-weight: bold; padding-top: 3%;">Pesanan terbaru</h1>

<div class="orders-container">
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="papper" onclick="showOrderDetails('<?php echo $row['order_code']; ?>', 'card')">
        <div class="papper-info">
            <div class="papper-text">
                <p class="text-title">Kode Pesanan: </p>
                <p class="text-code"><?php echo htmlspecialchars($row['order_code']); ?></p>
                <p class="text-subtitle">Waktu: <?php echo date('H:i (d-m-Y)', strtotime($row['order_date'])); ?></p>
            </div>
        </div>
        <div class="ribbon-wrap">
            <div class="ribbon">New Order!</div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<!-- Modal untuk menampilkan detail pesanan dari card -->
<div class="modal fade" id="order-details-modal-card" tabindex="-1" aria-labelledby="order-details-modal-card-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="order-details-modal-card-label">Detail Pesanan</h5>
            </div>
            <div class="modal-body" id="order-details-content-card">
                <!-- Detail pesanan akan ditampilkan di sini -->
            </div>
            <div class="modal-footer">
                <form action="cancel_order.php" method="post" id="cancel-order-form-card">
                    <input type="hidden" id="modal-order-id-card-cancel" name="order_id" value="">
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
                <form action="complete_order.php" method="post" id="complete-order-form-card">
                    <input type="hidden" id="modal-order-id-card" name="order_id" value="">
                    <button type="submit" class="btn btn-success">Selesaikan Pesanan</button>
                </form>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="notification-container" class="fixed bottom-4 right-4 z-50"></div>

<?php
include('layout/footer.php');
?>

<script>
$(document).ready(function() {
    let lastOrderCount = 0;

    function fetchNewOrders() {
        let cacheBuster = new Date().getTime();
        $.ajax({
            url: 'get_new_orders.php?cb=' + cacheBuster,
            method: 'GET',
            success: function(data) {
                var orders = JSON.parse(data);
                var ordersContainer = $('#orders-container');

                if (orders.length > lastOrderCount) {
                    for (let i = lastOrderCount; i < orders.length; i++) {
                        var order = orders[i];
                        var orderHtml = `
                        <div class="papper" onclick="showOrderDetails('${order.order_code}', 'card')">
                            <div class="papper-info">
                                <div class="papper-text">
                                    <p class="text-title">Kode Pesanan: </p>
                                    <p class="text-code">${order.order_code}</p>
                                    <p class="text-subtitle">Waktu: ${new Date(order.order_date).toLocaleString('id-ID', { hour12: false })}</p>
                                </div>
                            </div>
                            <div class="ribbon-wrap">
                                <div class="ribbon">New Order!</div>
                            </div>
                        </div>`;
                        ordersContainer.append(orderHtml);
                        console.log('Card added to DOM');
                    }

                    showNotification('Ada pesanan baru masuk!');
                }

                lastOrderCount = orders.length;
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            }
        });
    }

    function showNotification(message) {
        var notificationHtml = `
        <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50 notification">
            <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
                <div class="flex gap-2">
                    <div class="text-[#2b9875] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white">${message}</p>
                    </div>
                </div>
                <button class="text-gray-600 text-gray-600 hover:bg-white/5 p-1 rounded-md transition-colors ease-linear close-notification">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>`;
        $('#notification-container').append(notificationHtml);

        // Hilangkan notifikasi setelah 3 detik dengan animasi fade out
        setTimeout(function() {
            $('.notification').fadeOut(500, function() {
                $(this).remove();
            });
        }, 5000);

        // Tambahkan event listener untuk tombol X
        $('.close-notification').click(function() {
            $(this).closest('.notification').fadeOut(500, function() {
                $(this).remove();
            });
        });
    }

    setInterval(function() {
        console.log('Fetching new orders...');
        fetchNewOrders();
    }, 1000);
});
</script>