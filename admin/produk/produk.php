<div class="card mt-4">
    <div class="card-header">
        <h1>Data Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Master / Produk</li>
        </ol>
    </div>
</div>

<div class="card mb-4 mt-4">
    <div class="card-body">
        <div class="col-md-12 col-lg-12 mb-3 mt-2 d-flex justify-content-end">
            <a class="btn btn-dark" href="./?page=tambahProduk">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i> Tambah Produk</div>
            </a>
        </div>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Jenis Produk</th>
                    <th>Harga Produk</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../koneksi.php";
                $nomor = 1;
                $query = $conn->query("SELECT tb_produk.*, tb_jenis.nama_jenis FROM tb_produk 
                LEFT JOIN tb_jenis ON tb_produk.id_jenis = tb_jenis.id_jenis");
                while ($result = $query->fetch_assoc()) {
                    $id_produk = $result['id_produk'];
                    ?>
                    <tr>
                        <td>
                            <?= $nomor; ?>
                        </td>
                        <td>
                            <?= $result['kd_produk']; ?>
                        </td>
                        <td>
                            <?= $result['nama_produk']; ?>
                        </td>
                        <td>
                            <?= $result['nama_jenis']; ?>
                        </td>
                        <td>
                            <?= "Rp. " . number_format($result['harga_produk']); ?>
                        </td>
                        <td><img src="../assets/images/<?= $result['foto_produk']; ?>" width="50" height="50"></td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="./?page=ubahproduk&id=<?php echo $result['id_produk']; ?>"
                                        class="btn btn-warning btn-block">Edit</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="./?page=hapusproduk&id=<?php echo $result['id_produk']; ?>"
                                        class="btn btn-danger btn-block">Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $nomor++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>