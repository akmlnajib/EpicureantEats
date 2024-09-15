<div class="card mt-4">
    <div class="card-header">
<h1>Data Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / Transaksi</li>
</ol>
</div>
</div>
<div class="card mb-4 mt-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                <th>No</th>
				<th>Order ID</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal Pembelian</th>
				<th>Total Pembelian</th>
				<th>Status Transaksi</th>
				<th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include "../koneksi.php";
                $no = 1;
                $query = $conn->query("SELECT * FROM tb_penjualan JOIN tb_pelanggan ON tb_penjualan.id_pelanggan=tb_pelanggan.id_pelanggan");
                while ($result = $query->fetch_assoc()) {
                    ?>
                <tr>
                    <td><?= $no?></td>
                    <td><?= $result['order_id']?></td>
                    <td><?= $result['nama_pelanggan']?></td>
                    <td><?= $result['tanggal_penjualan']?></td>
                    <td><?= $result['total_penjualan']?></td>
                    <td>
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
                    </td>
                    <td>
                    <a class="btn btn-dark btn-block"
														href="./?page=detail&id=<?php echo $result['id_penjualan']; ?>">Detail</a>
                    </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>