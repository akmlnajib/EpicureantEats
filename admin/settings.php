<?php
include 'koneksi.php';

if (!isset ($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM tb_admin WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_admin = $row['id'];
    $nama = $row['nama'];
    $username = $row['username'];
} else {
    echo "Profil tidak ditemukan";
}

$conn->close();
?>
<div class="card mt-4">
    <div class="card-header">
        <h1>Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Setting</li>
        </ol>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <h1 class="card-title text-center">Informasi Akun</h1>
        <p class="card-text">Nama :
            <?php echo $nama; ?>
        </p>
        <p class="card-text">Username :
            <?php echo $username; ?>
        </p>
        <div class="col-md-12 col-lg-12 mb-3 mt-2 d-flex justify-content-end">
            <a class="btn btn-dark" href="./?page=setting">
                <div class="sb-nav-link-icon">Ubah</div>
            </a>
        </div>
    </div>
</div>