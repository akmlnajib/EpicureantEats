<div class="card mt-4">
    <div class="card-header">
<h1>Data Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / Pelanggan</li>
</ol>
</div>
</div>
<div class="card mb-4 mt-4">
    <div class="card-body">
    <div class="col-md-12 col-lg-12 mb-3 mt-2 d-flex justify-content-end">
            <a class="btn btn-dark" href="./?page=tambahpelanggan">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i> Tambah Pelanggan</div>
            </a>
        </div>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>No Tlp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include "../koneksi.php";
                $nomor = 1;
                $query = $conn->query("SELECT * FROM tb_pelanggan");
                while ($result = $query->fetch_assoc()) {
                    ?>
                <tr>
                    <td><?= $nomor?></td>
                    <td><?= $result['kd_pelanggan']?></td>
                    <td><?= $result['nama_pelanggan']?></td>
                    <td><?= $result['asal_kelas']?></td>
                    <td><?= $result['email']?></td>
                    <td><?= $result['no_hp']?></td>
                    <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="./?page=ubahpelanggan&id=<?php echo $result['id_pelanggan']; ?>"
                                        class="btn btn-warning btn-block">Edit</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="./?page=hapuspelanggan&id=<?php echo $result['id_pelanggan']; ?>"
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