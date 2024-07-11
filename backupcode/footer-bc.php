<script>
    function loadContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    function openModal(nama, img, keterangan, harga) {
       document.getElementById('modalNama').textContent = nama;
       document.getElementById('modalImg').src = img;
       document.getElementById('modalKeterangan').textContent = keterangan;
       document.getElementById('modalHarga').textContent = "Harga: " + harga;
       document.querySelector('.quantity-input').value = 1;
       document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    function pesan() {
        var nama = document.getElementById('modalNama').innerText;
        var harga = document.getElementById('modalHarga').innerText.replace("Harga: Rp ", "");
        var jumlah = document.querySelector('.quantity-input').value; // Mengambil nilai jumlah yang dimasukkan manual

        // Tambahkan item ke sesi
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nama: nama, harga: harga, jumlah: jumlah }) // Mengirimkan nilai jumlah
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('notificationMessage').innerText = nama + " telah ditambahkan ke keranjang.";
            } else {
                document.getElementById('notificationMessage').innerText = "Terjadi kesalahan saat menambahkan ke keranjang.";
            }
            openNotificationModal();
        })
        .catch(error => console.error('Error:', error));

        closeModal();
    }

    function openNotificationModal() {
        document.getElementById('notificationModal').style.display = 'block';
    }

    function closeNotificationModal() {
        document.getElementById('notificationModal').style.display = 'none';
    }

        // Tutup modal ketika pengguna mengklik di luar modal
        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openCartModal() {
            // Memuat konten keranjang ke dalam modal
            fetch('load_cart_content.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('cartModalContent').innerHTML = data;
                    document.getElementById('cartModal').style.display = "block";
                })
                .catch(error => console.error('Error:', error));
        }

        function closeCartModal() {
            document.getElementById('cartModal').style.display = "none";
        }

        function removeItem(index) {
            fetch('remove_item.php?index=' + index)
                .then(response => response.text())
                .then(data => {
                    openCartModal(); // Memuat kembali konten keranjang setelah menghapus item
                })
                .catch(error => console.error('Error:', error));
        }

        function updateQuantity(index, quantity) {
            fetch('update_quantity.php?index=' + index + '&quantity=' + quantity)
                .then(response => response.text())
                .then(data => {
                    openCartModal(); // Memuat kembali konten keranjang setelah memperbarui jumlah
                })
                .catch(error => console.error('Error:', error));
        }

        function redirectToCheckout() {
            window.location.href = 'checkout.php';
        }

        //Carousel
        let slideIndex = 0;
        showSlides(slideIndex);

        function prevSlide() {
            showSlides(slideIndex -= 1);
        }

        function nextSlide() {
            showSlides(slideIndex += 1);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            const slides = document.getElementsByClassName("carousel-slide")[0].getElementsByTagName("img");
            const dots = document.getElementsByClassName("dot");

            if (n >= slides.length) {
                slideIndex = 0;
            }
            if (n < 0) {
                slideIndex = slides.length - 1;
            }

            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }

            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active-dot");
            }

            slides[slideIndex].classList.add("active");
        }

    //Card index
    function goToPage(page) {
        // Redirect ke halaman sesuai judul card
        switch (page) {
            case 'Paket Hemat':
                window.location.href = 'paket_hemat.php';
                break;
            case 'Rice Bowl':
                window.location.href = 'rice-bowl.html';
                break;
            case 'Makanan':
                window.location.href = 'makanan.html';
                break;
            case 'Minuman':
                window.location.href = 'minuman.html';
                break;
            case 'Juice':
                window.location.href = 'juice.html';
                break;
            case 'Side Dish':
                window.location.href = 'side-dish.html';
                break;
            default:
                break;
        }
    }

    //modal untuk index
    function openModalIndex(id) {
       const xhr = new XMLHttpRequest();
       xhr.open('GET', 'get_menu_data.php?id=' + id, true);

       xhr.onload = function() {
           if (xhr.status >= 200 && xhr.status < 400) {
               const modalContent = document.getElementById('modalContent');
               if (modalContent) {
                   modalContent.innerHTML = xhr.responseText;
                   const modal = document.getElementById('myModal');
                   modal.style.display = 'block';
               } else {
                   console.error('Elemen modalContent tidak ditemukan');
               }
           } else {
               console.error('Gagal mengambil data');
           }
       };

       xhr.send();
   }

   //preloading screen
   window.addEventListener('load', function() {
       const preloader = document.getElementById('preloader');
       const mainContent = document.getElementById('mainContent');

       setTimeout(function() {
           document.getElementById('preloader').style.opacity = '0'; // Mengatur opacity menjadi 0
           setTimeout(function() {
               preloader.style.display = 'none'; // Sembunyikan preloading screen setelah transisi selesai
               mainContent.style.display = 'block'; // Tampilkan konten utama
               window.location.href = 'home.php'; // Redirect ke halaman home.php
           }, 750); // Tunggu 1 detik sebelum menyembunyikan preloading screen
       }, 3000); // Tampilkan pesan selamat datang selama 3 detik
   });

   //Tanda
    function decreaseQuantity(button) {
        var input = button.nextElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value;
        value = value > 1 ? value - 1 : 1;
        input.value = value;
    }

    function increaseQuantity(button) {
        var input = button.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value;
        value++;
        input.value = value;
    }

    //Checkout
    function openOrderTypeModal(type) {
        if (type === 'dine-in') {
            document.getElementById('dineInModal').style.display = "block";
        } else if (type === 'take-away') {
            document.getElementById('takeAwayConfirmationModal').style.display = "block";
        }
    }
    function closeModalCO(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

        function confirmTakeAwayOrder() {
            // Proses konfirmasi pesanan Take Away
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'thank_you.php';
                } else {
                    alert("Terjadi kesalahan saat mengosongkan keranjang.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function accDineInOrder(){
            // Tambahkan pemanggilan clear_cart.php untuk membersihkan keranjang pesanan
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect ke halaman thank_you.php setelah membersihkan keranjang
                    window.location.href = 'thank_you.php';
                } else {
                    alert("Terjadi kesalahan saat mengosongkan keranjang.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function confirmDineInOrder() {
            // Tambahkan kode untuk menampilkan modal konfirmasi Dine In
            document.getElementById('dineInConfirmationModal').style.display = "block";
        }

        function selectOrderType(type) {
            if (type === 'dine-in') {
                openOrderTypeModal('dine-in');
            } else if (type === 'take-away') {
                completeOrder();
            }
        }

        function completeOrder() {
            var seatNumber = document.getElementById('seatNumber').value;
            if (seatNumber) {
                alert("Pesanan Anda telah dikonfirmasi untuk Dine In di tempat duduk nomor " + seatNumber);
            } else {
                alert("Pesanan Anda telah dikonfirmasi untuk Take Away.");
            }
            // Kosongkan keranjang setelah konfirmasi
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'thank_you.php';
                } else {
                    alert("Terjadi kesalahan saat mengosongkan keranjang.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function cancelCheckout() {
            window.location.href = 'home.php';
        }
</script>

</body>
</html>