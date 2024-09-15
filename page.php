<?php
$page=htmlspecialchars(@$_GET['page']);
switch ($page){
    case null:
        include 'content.php';
        break;
    case 'content':
        include 'content.php';
        break;
    case 'allcontent':
        include 'allcontent.php';
        break;
    case 'keranjang':
        include 'keranjang.php';
        break;
        case 'riwayat':
            include 'riwayat.php';
            break;
        case 'checkout':
            include 'checkout.php';
            break;
    case 'makananBerat':
        include 'makananBerat.php';
        break;
    case 'makananRingan':
            include 'makananRingan.php';
            break;
    case 'minuman':
        include 'minuman.php';
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