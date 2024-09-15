<div class="card mt-4">
    <a class="nav-link" href="./?page=penjualan"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <div class="card-header">
        <h1>Detail Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Master / Transaksi / Detail Transaksi</li>
        </ol>
    </div>
</div>
<?php
include "../koneksi.php";
$query = $conn->query("SELECT * FROM tb_penjualan JOIN tb_pelanggan
							  ON tb_penjualan.id_pelanggan = tb_pelanggan.id_pelanggan
							  WHERE tb_penjualan.id_penjualan = '$_GET[id]'");

$result = $query->fetch_assoc();

?>

<div class="card mb-4 mt-4">
    <div class="card-header">
        <strong>
            <h1>Order ID : <?= $result['order_id'];?></h1>
            <?php echo "Nama Pelanggan : " . $result['nama_pelanggan']; ?>
            <br>
            <?php echo "Kelas : " . $result['asal_kelas']; ?>
            <br>Tanggal Pemesanan:
            <?php
            setlocale(LC_TIME, 'id_ID'); // Set locale ke bahasa Indonesia
            echo strftime("%d %B %Y", strtotime($result['tanggal_penjualan'])); // Format tanggal dengan nama bulan dalam bahasa Indonesia
            ?>

            <br>
            Total :
            <?php echo "Rp. " . number_format($result['total_penjualan']); ?>
            <br>
            Status :
            <?php
                        if ($result['transaction_status'] == 1) {
                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                        } else if ($result['transaction_status'] == 2) {
                            echo '<span class="badge bg-success">Pending</span>';
                        } elseif ($result['transaction_status'] == 3) {
                            echo '<span class="badge bg-info">Pembayaran Berhasil</span>';
                        } else {
                            echo '<span class="badge bg-danger">Pembayaran Gagal</span>';
                        }
                        ?>
            <br>
            <?php echo "Telepon : " . $result['no_hp']; ?>
            <br>
            <?php echo "E-Mail : " . $result['email'] ?>
            <br>
            <?php echo "Keterangan : " . $result['keterangan'] ?>
            <br>

        </strong>
    </div>
    <div class="card-body">
    <table class="table">
        <thead class="thead light">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>SubTotal</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php $query = $conn->query("SELECT * FROM tb_penjualan_produk JOIN tb_produk ON 
											tb_penjualan_produk.id_produk = tb_produk.id_produk
											WHERE tb_penjualan_produk.id_penjualan = '$_GET[id]'"); ?>
            <?php while ($result = $query->fetch_assoc()) { ?>

                <tr>
                    <td>
                        <?php echo $no; ?>
                    </td>
                    <td>
                        <?php echo $result['nama_produk']; ?>
                    </td>
                    <td>
                        <?php echo "Rp. " . number_format($result['harga_produk']); ?>
                    </td>
                    <td>
                        <?php echo $result['qty_keluar']; ?>
                    </td>
                    <td>
                        <?php echo "Rp. " . number_format($result['harga_produk'] * $result['qty_keluar']); ?>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php } ?>
        </tbody>
    </table>
</div></div>