<?php
include "../koneksi.php";

if(isset($_POST['ubah'])) {
    $stmt = $conn->prepare("UPDATE tb_pelanggan SET email=?, nama_pelanggan=?, password=?, asal_kelas=?, no_hp=? WHERE id_pelanggan=?");
    $stmt->bind_param("ssssss", $_POST['email'], $_POST['nama_pelanggan'], $_POST['password'], $_POST['asal_kelas'], $_POST['no_hp'], $_GET['id']);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Data Berhasil di Ubah');</script>";
    echo "<script>location = './?page=pelanggan';</script>";
}

$query = $conn->query("SELECT * FROM tb_pelanggan WHERE id_pelanggan ='$_GET[id]'");
$row = $query->fetch_assoc();
?>

<div class="card mt-4">
    <div class="card-header">
<h1 class="mt-4">Ubah Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / Pelanggan / Ubah Pelanggan</li>
</ol>
</div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="kd_pelanggan" class="form-label">Kode pelanggan</label>
                <input type="text" class="form-control" id="kd_pelanggan" name="kd_pelanggan" value="<?php echo $row['kd_pelanggan']; ?>" readonly>
                <div id="kd_pelanggan" class="form-text">*Kode pelanggan tidak dapat diubah.</div>
            </div>
            <div class="col-md-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $row['nama_pelanggan']; ?>">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="col-md-4">
                <label for="asal_kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="asal_kelas" name="asal_kelas" value="<?php echo $row['asal_kelas']; ?>">
            </div>
            <div class="col-md-4">
                <label for="no_hp" class="form-label">No Handphone</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>">
            </div>
            <div class="col-md-4">
                <label for="password_baru" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru">
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-dark" name="ubah">Ubah</button>
            </div>
        </form>
    </div>
</div>
