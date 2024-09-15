<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian - EpicureanEats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://kit.fontawesome.com/8a4de1b88e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand ps-3" href="./?page=content"><img src="admin/assets/img/log1.png" alt="" width="100"
                    height="60"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./?page=content"><i class="fa-solid fa-house-chimney"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?page=allcontent"><i class="fa-solid fa-border-all"></i> All
                            Item</a>
                    </li>
                    <?php
                    if (isset($_SESSION["username"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./?page=keranjang"><i class="fa-solid fa-cart-shopping"></i>
                                Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?page=riwayat"><i class="fa-solid fa-list-check"></i> Riwayat</a>
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
                            <a class="nav-link" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-4">
        <div class="container">
            <div>
                <a class="nav-link" href="./?page=riwayat"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
            <h1>Detail Pemesanan</h1>
            <?php
            if (isset($_GET['id']) && $_GET['id'] !== '') {
                $id_penjualan = $_GET['id'];
                $stmt = $conn->prepare("SELECT * FROM tb_penjualan JOIN tb_pelanggan
                                ON tb_penjualan.id_pelanggan = tb_pelanggan.id_pelanggan
                                WHERE tb_penjualan.id_penjualan = ?");
                $stmt->bind_param("s", $id_penjualan);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $detail = $result->fetch_assoc();
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>
                                        <br>
                                        <h1>ID Order :
                                            <?php echo $detail['order_id']; ?>
                                        </h1>
                                        <br>Tanggal Pemesanan:
                                        <?php
                                        setlocale(LC_TIME, 'id_ID'); // Set locale ke bahasa Indonesia
                                        echo strftime("%d %B %Y", strtotime($detail['tanggal_penjualan'])); // Format tanggal dengan nama bulan dalam bahasa Indonesia
                                        ?>

                                        <br>
                                        Total :
                                        <?php echo "Rp. " . number_format($detail['total_penjualan']); ?>
                                        <br>
                                        Status Transaksi :
                                        <?php
                                        if ($detail['transaction_status'] == 1) {
                                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                                        } else if ($detail['transaction_status'] == 2) {
                                            echo '<span class="badge bg-info">Pending</span>';
                                        } elseif ($detail['transaction_status'] == 3) {
                                            echo '<span class="badge bg-success">Pembayaran Berhasil.</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                                        }
                                        ?>
                                    </strong>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <div class="table-responsive m-b-40">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Foto</th>
                                                    <th>Harga</th>
                                                    <th>Kuantiti</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $stmt = $conn->prepare("SELECT * FROM tb_penjualan_produk JOIN tb_produk ON 
                                                tb_penjualan_produk.id_produk = tb_produk.id_produk
                                                WHERE tb_penjualan_produk.id_penjualan = ?");
                                                $stmt->bind_param("s", $id_penjualan);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $no; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['nama_produk']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo "Rp. " . number_format($row['harga_produk']); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['qty_keluar']; ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5'>Data produk tidak ditemukan</td></tr>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Data tidak ditemukan.";
                }
            } else {
                echo "ID Pemesanan tidak valid.";
            }
            ?>
        </div>
    </section>
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>Support Payment :</p>
            <img src="admin/assets/img/pembayaran.png" alt="" width="200" height="100">
            <p class="mt-2">&copy; 2024 EpicureanEats. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>