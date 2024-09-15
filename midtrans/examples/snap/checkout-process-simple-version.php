<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'Your Server Key';
Config::$clientKey = 'Your Client Key';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required

include "../../../koneksi.php";
$order_id = $_GET['order_id'];

// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT tb_penjualan.*, tb_pelanggan.nama_pelanggan, tb_pelanggan.email, tb_pelanggan.asal_kelas, tb_pelanggan.no_hp 
          FROM tb_penjualan 
          JOIN tb_pelanggan ON tb_penjualan.id_pelanggan = tb_pelanggan.id_pelanggan 
          WHERE tb_penjualan.order_id='$order_id'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_array($sql);

$nama_pelanggan = $data['nama_pelanggan'];
$email = $data['email'];
$asal_kelas = $data['asal_kelas'];
$no_hp = $data['no_hp'];
$id_pelanggan = $data['id_pelanggan'];

$total_penjualan = $data['total_penjualan'];
$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $total_penjualan, // no decimal allowed for creditcard
);
// Optional
$item_details = array(
    array(
        'id' => 'a1',
        'price' => $total_penjualan,
        'quantity' => 1,
        'name' => "Pemesanan"
    ),
);
// Optional
$customer_details = array(
    'first_name' => "$nama_pelanggan",
    'last_name' => "",
    'email' => "$email",
    'phone' => "$no_hp",
    'address' => "$asal_kelas",

);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'Your Server Key\';');
        die();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EpicureanEats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://kit.fontawesome.com/8a4de1b88e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .card {
            height: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand ps-3" href="index.html"><img src="../../../admin/assets/img/log1.png" alt=""
                    width="100" height="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../../?page=content"><i class="fa-solid fa-house-chimney"></i>
                            Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../?page=allcontent"><i class="fa-solid fa-border-all"></i> All
                            Item</a>
                    </li>
                    <?php
                    session_start();
                    if (isset ($_SESSION["username"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../?page=keranjang"><i class="fa-solid fa-cart-shopping"></i>
                                Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../?page=riwayat"><i class="fa-solid fa-list-check"></i> Riwayat</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./?page=settings">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout <i
                                            class="fa-solid fa-right-from-bracket"></i></a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../login.php"><i class="fa-solid fa-right-to-bracket"></i>
                                Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="py-4 mb-5">
        <div class="container">
        <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card text-center">
                <div class="card-header">
                    NOTIFICATION
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pemesanan berhasil <i class="fa-solid fa-check"></i></h5>
                    <p class="card-text">Selesaikan pembayaran sekarang agar pesanan segera dibuat.</p>
                    <button id="pay-button" class="btn btn-dark"><i class="fa-solid fa-money-check-dollar"></i> BAYAR SEKARANG</button>
                </div>
            </div>
        </div>
    </div>
        </div>
    </section>
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>Support Payment :</p>
            <img src="../../../admin/assets/img/qris.png" alt="" width="200" height="100" >
            <p class="mt-2" >&copy; 2024 EpicureanEats. All rights reserved.</p>
        </div>
    </footer>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>');
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>

</html>