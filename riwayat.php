<?php
include "koneksi.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query_pelanggan = "SELECT id_pelanggan FROM tb_pelanggan WHERE username = '$username'";
    $result_pelanggan = $conn->query($query_pelanggan);

    // Jika data pelanggan ditemukan
    if ($result_pelanggan->num_rows == 1) {
        $row_pelanggan = $result_pelanggan->fetch_assoc();
        $id_pelanggan = $row_pelanggan['id_pelanggan'];

        $jumlahDPH = 10;

        $rslt = $conn->query("SELECT COUNT(*) AS total FROM tb_penjualan WHERE id_pelanggan='$id_pelanggan'");
        $dataTotal = $rslt->fetch_assoc();
        $totalData = $dataTotal['total'];

        $jumlahHalaman = ceil($totalData / $jumlahDPH);

        $hAktif = (isset($_GET["riwayat"]) ? $_GET["riwayat"] : 1);

        $awalData = ($jumlahDPH * $hAktif) - $jumlahDPH;

        if (isset($_POST['bcari'])) {
            $pencarian = htmlspecialchars($_POST['cari']);
            $query = "SELECT * FROM tb_penjualan WHERE id_pelanggan='$id_pelanggan' AND (order_id LIKE '%$pencarian%' OR total_penjualan LIKE '%$pencarian%' OR transaction_status LIKE '%$pencarian%' OR tanggal_penjualan LIKE '%$pencarian%' OR keterangan LIKE '%$pencarian%')";
        } else {
            $query = "SELECT * FROM tb_penjualan WHERE id_pelanggan='$id_pelanggan' LIMIT $awalData, $jumlahDPH";
        }

        $execute = mysqli_query($conn, $query);

        if (!$execute) {
            die('Error in SQL query: ' . mysqli_error($conn));
        }
    } else {
        echo "Data pelanggan tidak ditemukan.";
    }
} else {
    echo "Username tidak ditemukan.";
}
?>

<h1 class="mt-4">Riwayat Pembelian</h1>

<div class="card">
    <div class="card-body">
        <div class="container d-flex flex-wrap justify-content-end">
            <form class="row g-2 align-items-center" method="POST">
                <div class="col-auto">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="cari">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark" name="bcari">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Order</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembelian</th>
                <th>Status Transaksi</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = $awalData + 1;
            while ($row = mysqli_fetch_assoc($execute)) {
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $row['order_id']; ?></td>
                    <td><?= $row['tanggal_penjualan']; ?></td>
                    <td><?= "Rp." . number_format($row['total_penjualan']); ?></td>
                    <td>
                        <?php
                        if ($row['transaction_status'] == 1) {
                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                        } else if ($row['transaction_status'] == 2) {
                            echo '<span class="badge bg-info">Pending</span>';
                        } elseif ($row['transaction_status'] == 3) {
                            echo '<span class="badge bg-success">Pembayaran Berhasil.</span>';
                        } else {
                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-dark btn-block" href="detail.php?id=<?= $row['id_penjualan']; ?>">Detail</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $hAktif == 1 ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=riwayat&riwayat=<?= ($hAktif - 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <li class="page-item <?= $hAktif == $i ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="./?page=riwayat&riwayat=<?= $i . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $hAktif == $jumlahHalaman ? 'disabled' : ''; ?>">
                <a class="page-link"
                    href="./?page=riwayat&riwayat=<?= ($hAktif + 1) . (isset($_POST['bcari']) ? '&bcari=Cari&cari=' . $pencarian : ''); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
