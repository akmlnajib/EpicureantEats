<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM tb_pelanggan WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $nama = $row['nama_pelanggan'];
    $email = $row['email'];
    $asal_kelas = $row['asal_kelas'];
    $no_hp = $row['no_hp'];
} else {
    echo "Profil tidak ditemukan";
}

$conn->close();
?>
<div class="card mt-4">
    
<h1 class="card-header text-center mt-2">Informasi Akun</h1>
    <div class="card-body">
    <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" readonly class="form-control" value="<?= $username?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" readonly class="form-control" value="<?= $nama?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Asal Kelas</label>
                <input type="text" readonly class="form-control" value="<?= $asal_kelas?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" readonly class="form-control" value="<?= $email?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">No Telepon</label>
                <input type="text" readonly class="form-control" value="<?= $no_hp?>">
            </div>
            <div class="col-md-12 col-lg-12 mb-3 mt-2 d-flex justify-content-end">
            <a class="btn btn-dark" href="./?page=setting">
                <div class="sb-nav-link-icon">Ubah</div>
            </a>
        </div>
        </form>
    </div>
</div>