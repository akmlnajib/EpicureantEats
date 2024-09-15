<?php
include 'koneksi.php';

if (!isset ($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM tb_pelanggan WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_pelanggan = $row['id_pelanggan'];
    $username = $row['username'];
    $nama = $row['nama_pelanggan'];
    $email = $row['email'];
    $asal_kelas = $row['asal_kelas'];
    $no_hp = $row['no_hp'];
} else {
    echo "Profil tidak ditemukan";
}

if (isset ($_POST['ubah'])) {
    $nama_baru = $_POST['nama_pelanggan'];
    $username_baru = $_POST['username'];
    $password_baru = $_POST['password'];
    $asal_kelas_baru = $_POST['asal_kelas'];
    $email_baru = $_POST['email'];
    $no_hp_baru = $_POST['no_hp'];

    $sql_ubah = "UPDATE tb_pelanggan SET nama_pelanggan = ?, email = ?, username = ?, password = ?, asal_kelas = ?, no_hp = ? WHERE id_pelanggan = ?";
    $stmt = $conn->prepare($sql_ubah);
    $stmt->bind_param("ssssssi", $nama_baru, $email_baru, $username_baru, $password_baru, $asal_kelas_baru, $no_hp_baru, $id_pelanggan);
    if ($stmt->execute()) {
        echo "<script>alert('Berhasil diubah.');</script>";
        header("Location: ./?page=settings");
        exit();
    } else {
        echo "Error: " . $sql_ubah . "<br>" . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
<div>
        <a class="nav-link" href="./?page=settings"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
<div class="card mt-4">
    <h1 class="card-header text-center mt-2">Ubah Akun</h1>
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" required name="username" readonly class="form-control" value="<?= $username ?>">
                <div id="username" class="form-text">Username tidak dapat diubah.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" required name="nama_pelanggan" class="form-control" value="<?= $nama ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Asal Kelas</label>
                <input type="text" required name="asal_kelas" class="form-control" value="<?= $asal_kelas ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" required name="email" class="form-control" value="<?= $email ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">No Telepon</label>
                <input type="text" required name="no_hp" class="form-control" value="<?= $no_hp ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" class="form-control" required>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-dark" name="ubah">Ubah</button>
            </div>
        </form>
    </div>
</div>