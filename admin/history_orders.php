<?php
include('layout/header.php');
include('../config/db.php');

$sql = "SELECT * FROM orders WHERE status = 1";
$result = $conn->query($sql);
?>

<h1 style="text-align: center; font-size: 36px; font-weight: bold; padding-top: 2%;">Pesanan yang telah terkonfirmasi</h1>

<div class="container-fluid" style="padding-bottom: 1%;">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div style="margin-top: 2%; margin-bottom: -3%; text-align: center; display: flex; justify-content: center; flex-direction: column; align-items: center;">
                <label for="dateFilter">Filter berdasarkan tanggal:</label>
                <input type="text" id="dateFilter" class="form-control form-control-date text-center z-50" placeholder="Pilih Tanggal">
            </div>

            <table id="ordersTable" class="table table-striped table-responsive text-center" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Kode Pesanan</th>
                        <th scope="col" class="text-center">Tanggal Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td onclick="showOrderDetails('<?php echo htmlspecialchars($row['order_code']); ?>', 'table')" style="cursor: pointer;">
                        <?php echo htmlspecialchars($row['order_code']); ?>
                    </td>
                    <td onclick="showOrderDetails('<?php echo htmlspecialchars($row['order_code']); ?>', 'table')" style="cursor: pointer;"><?php echo date('d-m-Y (H:i)', strtotime($row['order_date'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan detail pesanan dari tombol rincian -->
<div class="modal fade" id="order-details-modal-table" tabindex="-1" aria-labelledby="order-details-modal-table-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="order-details-content-table">
                <!-- Kode pesanan akan ditampilkan di sini -->
                <div id="order-code-display"></div>
                <!-- Detail pesanan akan ditampilkan di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php
include('layout/footer.php');
?>