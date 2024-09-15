<?php
$page=htmlspecialchars(@$_GET['page']);
switch ($page){
    case null:
        include 'dashboard.php';
        break;
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'pelanggan':
        include 'pelanggan/pelanggan.php';
        break;
    case 'tambahpelanggan':
        include 'pelanggan/tambahpelanggan.php';
        break;
    case 'ubahpelanggan':
        include 'pelanggan/ubahpelanggan.php';
        break;
    case 'hapuspelanggan':
        include 'pelanggan/hapuspelanggan.php';
        break;
    case 'produk':
        include 'produk/produk.php';
        break;
    case 'tambahProduk':
        include 'produk/tambahproduk.php';
        break;
    case 'ubahproduk':
        include 'produk/ubahproduk.php';
        break;
    case 'hapusproduk':
        include 'produk/hapusproduk.php';
        break;
    case 'penjualan':
        include 'penjualan/penjualan.php';
        break;
    case 'detail':
            include 'penjualan/detail.php';
            break;
    case 'setting':
            include 'setting.php';
            break;
    case 'settings':
        include 'settings.php';
        break;
    default:
        include '404.php';
}