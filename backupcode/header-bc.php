<?php
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nama Restoran</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .container {
        display: flex;
    }
    .content {
        flex: 1;
    }
    .navbar {
        background-color: #333;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
    }
    .navbar img {
        height: 50px;
        margin-right: 10px;
    }
    .navbar h1 {
        margin: 0;
        font-size: 24px;
    }
    .menu {
        background-color: #444;
        display: flex;
        justify-content: space-around;
    }
    .menu a {
        color: white;
        text-decoration: none;
        padding: 10px 20px;
    }
    .menu a:hover {
        background-color: #555;
    }
        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
            padding: 20px;
        }
        .card {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
        }
        .card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .card-index {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 185px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
        }
        .card-index img {
            width: 100%;
            border-radius: 5px;
        }
        .card-index h3 {
            margin-top: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 50px;
            animation: fadeIn 0.5s;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 0 auto; /* Menengahkan modal */
            padding: 20px;
            border: 1px solid #888;
            width: 30%; /* Mengatur lebar konten modal */
            text-align: center;
        }
        .modal-content button {
            margin: 10px auto;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .cart-button-container{
            position: fixed;
            bottom: 30px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cart-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .cart-button:hover {
            background-color: #0056b3;
        }

        .carousel-container {
            position: relative;
            max-height: 250px;
            margin: 0 auto;
            overflow: hidden;
        }

        .carousel-slide {
            display: flex;
        }   

        .carousel-slide img {
            width: 100%;
            display: none;
        }

        .carousel-slide img.active {
            display: block;
        }

        #btn-index {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
        }

        .carousel-dots {
            text-align: center;
            margin-top: 10px;
        }

        .dot {
            display: inline-block;
            height: 10px;
            width: 10px;
            background-color: #bbb;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .active-dot {
            background-color: #717171;
        }

        button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        #welcomeMessage {
            font-size: 24px;
            color: #333;
            animation: fadeIn 2s ease-in-out forwards;
            text-align: center;
        }

        #mainContent {
            display: none; /* Konten utama disembunyikan saat preloading */
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .quantity-container {
            align-items: center;
        }

        .quantity-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            margin: 0;
        }

        .quantity-input {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        /* checkout */
        .checkout-container {
            padding: 20px;
        }
        .checkout-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .checkout-item h3 {
            margin: 0;
        }
        .checkout-total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .confirm-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .tipe-pesanan {
            display: flex;
            justify-content: center;
        }
        input[type=text]{
            width: 90%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-size: 16px;
        }
        .card-co {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-size: 24px;
            margin-bottom: 3%;
        }
        .cancel-button-co {
            background-color: red;
            bottom: 0px;
            display: block;
            position: fixed;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: 6%;
            border-radius: 0px;
            font-size: 20px;
        }

        .cancel-button-co:hover {
            background-color: maroon;
            bottom: 0px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: 6%;
        }


        /* Pahe */
        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quantity-input {
            font-size: 18px;
        }
        .order-btn {
            width: 30%;
            background-color: #04aa6d;
            font-size: 18px;
            transition: transform 0.8s;
        }
        .order-btn:hover {
            background-color: #008a57;
            transform: scale(1.1);
        }

        /* Tampilan mobile */
        @media only screen and (max-width: 600px) {
            .container {
                flex-direction: column;
            }

            .menu {
                overflow-y: auto; /* Mengatur menu dapat digulir secara vertikal */
                justify-content: flex-start;
            }

            .modal {
                width: 100%; /* Mengatur lebar modal untuk layar kecil */
                height: 100%; /* Mengatur tinggi modal untuk layar kecil */
            }

            .modal-content {
                width: 80%; /* Mengatur lebar konten modal untuk layar kecil */
            }
        }
</style>
</head>
<body>
<div class="navbar">
    <img src="img/HONDA.png" alt="Semoga Berkah">
    <h1>Semoga Berkah</h1>
</div>

<div class="menu">
    <a href="home.php">Home</a>
    <a href="paket_hemat.php">Paket Hemat</a>
    <a href="#rice-bowl">Rice Bowl</a>
    <a href="#makanan">Makanan</a>
    <a href="#minuman">Minuman</a>
    <a href="#juice">Juice</a>
    <a href="#side-dish">Side Dish</a>
</div>

<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'checkout.php') {
    echo "<div class='cart-button-container'>";
    echo "<button class='cart-button' onclick='openCartModal()'>Lihat Keranjangku</button>";
    echo "</div>";
}
?>

    <!-- Modal Keranjang -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCartModal()">&times;</span>
            <h2>Keranjang</h2>
            <div id="cartModalContent"></div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
   <div id="notificationModal" class="modal">
       <div class="modal-content">
           <span class="close" onclick="closeNotificationModal()">&times;</span>
           <p id="notificationMessage"></p>
       </div>
   </div>