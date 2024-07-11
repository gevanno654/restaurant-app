<?php
session_start();
$totalHarga = 0;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $key => $item) {
        echo "<div class='cart-item'>";
        echo "<div class='cart-item-content'>";
        echo "<div class='item-name' style='font-weight: bold; font-size: 20px;'>" . htmlspecialchars($item['nama']) . "</div>";
        echo "<div class='quantity-container'>
                    <button class='quantity-button' id='spinner' onclick='decreaseQuantity(this)'>&minus;</button>
                    <input type='text' class='quantity-input' data-index='" . $key . "' value='" . $item['jumlah'] . "' min='1' onchange='updateQuantity(" . $key . ", this.value)'>
                    <button class='quantity-button' id='spinner' onclick='increaseQuantity(this)'>&plus;</button>
                </div>";
        echo "<div class='item-price'>" . htmlspecialchars($item['harga']) . "</div>";
        echo "<button class='delete-btn' onclick='removeItem(" . $key . ")'>
                    <svg viewBox='0 0 15 17.5' height='17.5' width='15' xmlns='http://www.w3.org/2000/svg' class='icon-delete'>
                        <path transform='translate(-2.5 -1.25)' d='M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z' id='Fill'></path>
                    </svg>
                </button>";
        echo "</div>";
        echo "</div>";
    
        $hargaStr = $item['harga'];
        $hargaNumerik = intval(preg_replace('/\D/', '', $hargaStr));
    
        $totalHarga += $hargaNumerik * $item['jumlah'];
    }

    echo "<p style='text-align: right; margin-left: 10px; margin-top: -5px; margin-bottom: 0px; font-weight: 300; font-size: 10px; font-style: italic;'>Total Harga sudah termasuk PPN*</p>";
    echo "<p style='font-size: 20px; font-weight: 700; text-align: right;'>Total Harga: Rp " . number_format($totalHarga, 0, ',', '.') . "</p>";

    echo "<button class='co-btn' style='float: right;' onclick='redirectToCheckout()'>";
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

<style>
        .cart-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #000;
        }

        .cart-item-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 20px;
        }

        .item-name {
            flex: 1; /* Adjust the flex-grow value */
            width: 150px; /* Set a minimum width */
            width: 150px; /* Set a maximum width */
        }

        .quantity-container, .item-price, .delete-btn {
            white-space: nowrap;
        }

        @media only screen and (max-width: 360px) {
            .item-name {
                margin-right: 5px;
                margin-left: -8px;
            }
            .item-price {
                font-size: 14px;
                margin-left: -10px;
                margin-right: -10px;
            }
        }

        /* tes */
        .co-btn {
        --color: #000;
        --background: #cc937f;
        --background-hover: #D4AC94;
        --background-left: #cc7f7f;
        --folder: #F3E9CB;
        --folder-inner: #BEB393;
        --paper: #FFFFFF;
        --paper-lines: #BBC1E1;
        --paper-behind: #E1E6F9;
        --pencil-cap: #fff;
        --pencil-top: #275EFE;
        --pencil-middle: #fff;
        --pencil-bottom: #5C86FF;
        --shadow: rgba(13, 15, 25, .2);
        border: none;
        outline: none;
        cursor: pointer;
        position: relative;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        line-height: 19px;
        -webkit-tap-highlight-color: transparent;
        padding: 17px 29px 17px 69px;
        transition: background 0.3s;
        color: var(--color);
        background: var(--bg, var(--background));
        }

        .co-btn > div {
        top: 0;
        left: 0;
        bottom: 0;
        width: 53px;
        position: absolute;
        overflow: hidden;
        border-radius: 5px 0 0 5px;
        background: var(--background-left);
        }

        .co-btn > div .folder {
        width: 23px;
        height: 27px;
        position: absolute;
        left: 15px;
        top: 13px;
        }

        .co-btn > div .folder .top {
        left: 0;
        top: 0;
        z-index: 2;
        position: absolute;
        transform: translateX(var(--fx, 0));
        transition: transform 0.4s ease var(--fd, 0.3s);
        }

        .co-btn > div .folder .top svg {
        width: 24px;
        height: 27px;
        display: block;
        fill: var(--folder);
        transform-origin: 0 50%;
        transition: transform 0.3s ease var(--fds, 0.45s);
        transform: perspective(120px) rotateY(var(--fr, 0deg));
        }

        .co-btn > div .folder:before, .co-btn > div .folder:after,
        .co-btn > div .folder .paper {
        content: "";
        position: absolute;
        left: var(--l, 0);
        top: var(--t, 0);
        width: var(--w, 100%);
        height: var(--h, 100%);
        border-radius: 1px;
        background: var(--b, var(--folder-inner));
        }

        .co-btn > div .folder:before {
        box-shadow: 0 1.5px 3px var(--shadow), 0 2.5px 5px var(--shadow), 0 3.5px 7px var(--shadow);
        transform: translateX(var(--fx, 0));
        transition: transform 0.4s ease var(--fd, 0.3s);
        }

        .co-btn > div .folder:after,
        .co-btn > div .folder .paper {
        --l: 1px;
        --t: 1px;
        --w: 21px;
        --h: 25px;
        --b: var(--paper-behind);
        }

        .co-btn > div .folder:after {
        transform: translate(var(--pbx, 0), var(--pby, 0));
        transition: transform 0.4s ease var(--pbd, 0s);
        }

        .co-btn > div .folder .paper {
        z-index: 1;
        --b: var(--paper);
        }

        .co-btn > div .folder .paper:before, .co-btn > div .folder .paper:after {
        content: "";
        width: var(--wp, 14px);
        height: 2px;
        border-radius: 1px;
        transform: scaleY(0.5);
        left: 3px;
        top: var(--tp, 3px);
        position: absolute;
        background: var(--paper-lines);
        box-shadow: 0 12px 0 0 var(--paper-lines), 0 24px 0 0 var(--paper-lines);
        }

        .co-btn > div .folder .paper:after {
        --tp: 6px;
        --wp: 10px;
        }

        .co-btn > div .pencil {
        height: 2px;
        width: 3px;
        border-radius: 1px 1px 0 0;
        top: 8px;
        left: 105%;
        position: absolute;
        z-index: 3;
        transform-origin: 50% 19px;
        background: var(--pencil-cap);
        transform: translateX(var(--pex, 0)) rotate(35deg);
        transition: transform 0.4s ease var(--pbd, 0s);
        }

        .co-btn > div .pencil:before, .co-btn > div .pencil:after {
        content: "";
        position: absolute;
        display: block;
        background: var(--b, linear-gradient(var(--pencil-top) 55%, var(--pencil-middle) 55.1%, var(--pencil-middle) 60%, var(--pencil-bottom) 60.1%));
        width: var(--w, 5px);
        height: var(--h, 20px);
        border-radius: var(--br, 2px 2px 0 0);
        top: var(--t, 2px);
        left: var(--l, -1px);
        }

        .co-btn > div .pencil:before {
        -webkit-clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
        clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
        }

        .co-btn > div .pencil:after {
        --b: none;
        --w: 3px;
        --h: 6px;
        --br: 0 2px 1px 0;
        --t: 3px;
        --l: 3px;
        border-top: 1px solid var(--pencil-top);
        border-right: 1px solid var(--pencil-top);
        }

        .co-btn:before, .co-btn:after {
        content: "";
        position: absolute;
        width: 10px;
        height: 2px;
        border-radius: 1px;
        background: var(--color);
        transform-origin: 9px 1px;
        transform: translateX(var(--cx, 0)) scale(0.5) rotate(var(--r, -45deg));
        top: 26px;
        right: 16px;
        transition: transform 0.3s;
        }

        .co-btn:after {
        --r: 45deg;
        }

        .co-btn:hover {
        --cx: 2px;
        --bg: var(--background-hover);
        --fx: -40px;
        --fr: -60deg;
        --fd: .15s;
        --fds: 0s;
        --pbx: 3px;
        --pby: -3px;
        --pbd: .15s;
        --pex: -24px;
        }
</style>