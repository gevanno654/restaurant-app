<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="./js/index.js" type="module"></script>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.left = "0";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.left = "-250px";
        document.getElementById("main").style.marginLeft = "0";
    }
    function setModalUsed(modal) {
        document.getElementById('modal_used').value = modal;
    }

    const converter = (base64Image) => {
        const base64Data = base64Image.split(',')[1];
        const contentType = base64Image.split(',')[0].split(':')[1].split(';')[0];
        const byteCharacters = atob(base64Data);
        const byteNumbers = new Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        const byteArray = new Uint8Array(byteNumbers);
        const blob = new Blob([byteArray], { type: contentType });
        return blob;
    }

    $(document).ready(function() {
        // AJAX untuk form add-minuman-form
        $('#add-minuman-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data minuman berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data minuman: ' + xhr.responseText
            });
            }
        });
        });

        // AJAX untuk form add-makanan-form
        $('#add-makanan-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data makanan berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data makanan: ' + xhr.responseText
            });
            }
        });
        });

        // AJAX untuk form add-sidedish-form
        $('#add-sidedish-form').submit(function(e) {
        e.preventDefault(); // Hindari pengiriman form secara default

        var formData = new FormData($(this)[0]); // Ambil data form
        $.ajax({
            url: './model/process_form.php', // URL ke process_form.php
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
            // Handle success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data sidedish berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Refresh halaman jika perlu
                location.reload();
            });
            },
            error: function(xhr, status, error) {
            // Handle error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data sidedish: ' + xhr.responseText
            });
            }
        });
        });
        // AJAX untuk form updateProductModal
        $('#update-product-form').submit(function(e) {
            e.preventDefault(); // Hindari pengiriman form secara default

            var formData = new FormData($(this)[0]); // Ambil data form
            const fileInput = $('#update-product-image-input')[0];
            const priviewSrc = document.getElementById('update-image-preview').src
            if (fileInput.files.length === 0) {
                const convertedImage = converter(priviewSrc)
                formData.delete("img")
                formData.append("img", convertedImage)
            }
            $.ajax({
                url: './model/process_form.php', // URL ke process_form.php
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                // Handle success
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Berhasil Diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Refresh halaman jika perlu
                    location.reload();
                });
                },
                error: function(xhr, status, error) {
                // Handle error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memperbarui data.: ' + xhr.responseText
                });
                }
            });
        });
    });

    function showOrderDetails(orderCode, modalType) {
        $.ajax({
            url: 'get_order_details.php', // File PHP yang akan menangani permintaan AJAX
            type: 'POST',
            data: { order_code: orderCode },
            success: function(response) {
                // Menampilkan detail pesanan dalam modal
                if (modalType === 'card') {
                    $('#order-details-content-card').html(response);

                    // Menampilkan kode pesanan di dalam modal
                    $('#order-details-content-card').prepend('<div style="font-size: 24px; text-align: center; font-weight: bold; margin-bottom: 3%;">Detail Pesanan ' + orderCode + '</div>');

                    // Mengambil order_id berdasarkan order_code
                    $.ajax({
                        url: 'get_order_id.php', // File PHP yang akan mengembalikan order_id berdasarkan order_code
                        type: 'POST',
                        data: { order_code: orderCode },
                        success: function(orderIdResponse) {
                            $('#modal-order-id-card').val(orderIdResponse); // Set nilai input hidden dengan order_id untuk selesaikan pesanan
                            $('#modal-order-id-card-cancel').val(orderIdResponse); // Set nilai input hidden dengan order_id untuk batalkan pesanan
                            var myModal = new bootstrap.Modal(document.getElementById('order-details-modal-card'));
                            myModal.show();

                            // Tambahkan event listener untuk tombol "Selesaikan Pesanan"
                            $('#complete-order-form-card button').on('click', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Apakah Anda yakin?',
                                    text: "Pesanan akan diselesaikan!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, selesaikan!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#complete-order-form-card').submit();
                                    }
                                });
                            });

                            // Tambahkan event listener untuk tombol "Batalkan Pesanan"
                            $('#cancel-order-form-card button').on('click', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Apakah Anda yakin?',
                                    text: "Pesanan akan dibatalkan!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, batalkan!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#cancel-order-form-card').submit();
                                    }
                                });
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan saat mengambil order_id.');
                        }
                    });
                } else if (modalType === 'table') {
                    $('#order-details-content-table').html(response);

                    // Menampilkan kode pesanan di dalam modal
                    $('#order-details-content-table').prepend('<div style="font-size: 24px; text-align: center; font-weight: bold; margin-bottom: 3%;">Detail Pesanan ' + orderCode + '</div>');

                    var myModal = new bootstrap.Modal(document.getElementById('order-details-modal-table'));
                    myModal.show();
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat mengambil detail pesanan.');
            }
        });
    }

    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "order": [[1, "desc"]] // Urutkan berdasarkan kolom tanggal pesanan secara descending
        });

        $('#dateFilter').datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText) {
                $('#ordersTable').DataTable().column(1).search(dateText).draw();
            }
        });
    });
</script>

</body>
</html>