<?php
include('layout/header.php');
?>

<h1 style="text-align: center; font-size: 36px; font-weight: bold; padding-top: 3%;">Pesanan terbaru</h1>

<div id="root"></div>

<div id="notification" class="notification" style="display: none;">
    <span>Ada pesanan baru!</span>
</div>

<!-- Modal untuk menampilkan detail pesanan dari card -->
<div class="modal fade" id="order-details-modal-card" tabindex="-1" aria-labelledby="order-details-modal-card-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
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

<script type="text/babel">
    function OrderList() {
        const [orders, setOrders] = React.useState([]);
        const [lastOrderCount, setLastOrderCount] = React.useState(0);

        React.useEffect(() => {
            const fetchNewOrders = async () => {
                try {
                    const response = await fetch('get_new_orders.php');
                    const newOrders = await response.json();

                    if (newOrders.length > lastOrderCount) {
                        setOrders(newOrders);
                        setLastOrderCount(newOrders.length);
                        showNotification();
                    }
                } catch (error) {
                    console.error("AJAX Error: ", error);
                }
            };

            const interval = setInterval(fetchNewOrders, 1000);
            return () => clearInterval(interval);
        }, [lastOrderCount]);

        const showNotification = () => {
            const notification = document.getElementById('notification');
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        };

        return (
            <div>
                <div id="orders-container" className="orders-container">
                    {orders.map(order => (
                        <div key={order.order_id} className="papper" onClick={() => showOrderDetails(order.order_code, 'card')}>
                            <div className="papper-info">
                                <div className="papper-text">
                                    <p className="text-title">Kode Pesanan: </p>
                                    <p className="text-code">{order.order_code}</p>
                                    <p className="text-subtitle">Waktu: {new Date(order.order_date).toLocaleString('id-ID', { hour12: false })}</p>
                                </div>
                            </div>
                            <div className="ribbon-wrap">
                                <div className="ribbon">New Order!</div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        );
    }

    ReactDOM.render(<OrderList />, document.getElementById('root'));
</script>

<?php
include('layout/footer.php');
?>