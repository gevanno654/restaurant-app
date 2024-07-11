<?php
include('layout/header.php');
?>
<div id="content" class="content">

        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="img/PromoA1.png" alt="Image 1" onclick="openModalIndex(1)">
                <img src="img/PromoA2.png" alt="Image 2" onclick="openModalIndex(2)">
                <img src="img/PromoA3.png" alt="Image 3" onclick="openModalIndex(3)">
            </div>
            <button id="btn-index" class="prev" onclick="prevSlide()"><</button>
            <button id="btn-index" class="next" onclick="nextSlide()">></button>
            <div class="carousel-dots"></div>
        </div>

        <div class="carousel-container">
            <div class="carousel">
                <div class="item active">
                    <img src="img/PromoA1.png" alt="Image 1" onclick="openModalIndex(1)"/>
                    <p class="caption">Caption for Image 1</p>
                </div>
                <div class="item">
                    <img src="https://bit.ly/3lkp5DW" alt="Image 2" />
                    <p class="caption">Caption for Image 2</p>
                </div>
                <div class="item">
                    <img src="https://bit.ly/3iMHuI1" alt="Image 3" />
                    <p class="caption">Caption for Image 3</p>
                </div>
            </div>

            <button class="btn prev">Prev</button>
            <button class="btn next">Next</button>
            <div class="dots"></div>
        </div>

        <h2 style="text-align: center; margin-top: 50px; margin-bottom: -30px;">Mau Pesan Apa Hari Ini?</h2>

        <div class="card-container">
            <div class="card-index" onclick="goToPage('Paket Hemat')">
                <img src="paket-hemat.jpg" alt="Paket Hemat">
                <h3>Paket Hemat</h3>
            </div>
            <div class="card-index" onclick="goToPage('Rice Bowl')">
                <img src="rice-bowl.jpg" alt="Rice Bowl">
                <h3>Rice Bowl</h3>
            </div>
            <div class="card-index" onclick="goToPage('Makanan')">
                <img src="makanan.jpg" alt="Makanan">
                <h3>Makanan</h3>
            </div>
            <div class="card-index" onclick="goToPage('Minuman')">
                <img src="minuman.jpg" alt="Minuman">
                <h3>Minuman</h3>
            </div>
            <div class="card-index" onclick="goToPage('Juice')">
                <img src="juice.jpg" alt="Juice">
                <h3>Juice</h3>
            </div>
            <div class="card-index" onclick="goToPage('Side Dish')">
                <img src="side-dish.jpg" alt="Side Dish">
                <h3>Side Dish</h3>
            </div>
        </div>



        <!-- Modal -->
        <div id="myModal" class="modal">
            <div id="modalContent" class="modal-content">
            </div>
        </div>

    </div>

<?php include('layout/footer.php'); ?>

