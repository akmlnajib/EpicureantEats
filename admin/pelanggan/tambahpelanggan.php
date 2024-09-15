<?php
include "../koneksi.php";
if (isset ($_POST['submit'])) {

    // Mengambil data dari form
    $kd_pelanggan = $_POST['kd_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $asal_kelas = $_POST['asal_kelas'];
    $no_hp = $_POST['no_hp'];

    $conn->query("INSERT INTO tb_pelanggan (kd_pelanggan, email, nama_pelanggan, password, asal_kelas, no_hp)
                     VALUES ('$kd_pelanggan', '$email','$nama_pelanggan', '$password', '$asal_kelas', '$no_hp')");

    echo "<script>alert('Data berhasil disimpan.');</script>";
    echo "<script>location = './?page=pelanggan';</script>";
}
?>
<div class="card mt-4">
    <div class="card-header">
<h1 class="mt-4">Tambah pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / pelanggan / Tambah pelanggan</li>
</ol>
</div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <?php
                $query = mysqli_query($conn, "SELECT max(kd_pelanggan) as kd_pelanggan FROM tb_pelanggan");
                $data = mysqli_fetch_array($query);
                $kd_pelanggan = $data['kd_pelanggan'];
                $urutan = (int) substr($kd_pelanggan, 3, 3);
                $urutan++;
                $huruf = "PLG";
                $kd_pelanggan = $huruf . sprintf("%03s", $urutan);
                ?>
                <label for="kd_pelanggan" class="form-label">Kode pelanggan</label>
                <input type="text" class="form-control" id="kd_pelanggan" name="kd_pelanggan" readonly
                    value="<?php echo $kd_pelanggan ?>">
                <div id="kd_pelanggan" class="form-text">*Kode pelanggan otomatis.</div>
            </div>
            <div class="col-md-4">
                <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" name="email">
                <div id="email" class="form-text">*ex : ex@gmail.com</div>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-4">
                <label for="asal_kelas" class="form-label">Kelas</label>
                <input class="form-control" type="text" id="formFile" name="asal_kelas">
                <div id="asal_kelas" class="form-text">*ex : 12 TKR 1/ 12 IPS 1</div>
            </div>
            <div class="col-md-4">
                <label for="no_hp" class="form-label">No Handphone</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp">
                <div id="no_hp" class="form-text">*ex : 089767483492.</div>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>