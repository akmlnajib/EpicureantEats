<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
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
    $password = $row['password'];
} else {
    echo "Profil tidak ditemukan";
}

if (isset($_POST['ubah'])) {
    $nama_baru = $_POST['nama'];
    $username_baru = $_POST['username'];
    $password_baru = $_POST['password'];

    $sql_ubah = "UPDATE tb_admin SET nama = '$nama_baru', username = '$username_baru', password = '$password_baru' WHERE id = '$id_admin'";
    if ($conn->query($sql_ubah) === TRUE) {
        echo "<script>alert('Berhasil diubah.');</script>";
        header("Location: ./?page=settings");
        exit();
    } else {
        echo "Error: " . $sql_ubah . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<div class="card mt-4">
    <div class="card-header">
        <h1>Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Setting / Ubah</li>
        </ol>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
            </div>
            <div class="col-md-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
            </div>
        </form>
    </div>
</div>
