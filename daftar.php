<?php
session_start();
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>EpicureanEats</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    -->


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Gaya CSS untuk mengatur latar belakang */
        body {
            /* URL gambar atau warna latar belakang */
            background: url('https://scx2.b-cdn.net/gfx/news/hires/2020/apple.jpg') no-repeat center center fixed;
            /* Properti latar belakang lainnya */
            background-size: cover;
            /* Mengisi seluruh area dengan gambar */
            /* atau gunakan warna latar belakang jika tidak menggunakan gambar */
            /* background-color: #f0f0f0; */
            /* Properti lainnya */
            color: #333;
            /* Warna teks */
            font-family: Arial, sans-serif;
            /* Jenis font teks */
            margin: 0;
            /* Menghilangkan margin di sekitar halaman */
            padding: 0;
            /* Menghilangkan padding di sekitar halaman */
        }

        /* Gaya CSS untuk mengatur konten di dalam body */
        .container {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Warna latar belakang konten */
            border-radius: 10px;
            /* Sudut melengkung pada konten */
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="card form-signin opacity-50" style=" border-radius: 20px; width: 100;">
        <div class="card-body">
            <img class="mb-4 card-title" src="admin/assets/img/log1.png" alt="" width="100" height="75">
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <h4 class="card-subtitle mb-2">Daftar</h4>
                <?php if (isset ($loginError) && $loginError): ?>
                    <div class="alert alert-danger" role="alert">
                        Login gagal! Periksa kembali username dan password Anda.
                    </div>
                <?php endif; ?>
                <?php
                $query = mysqli_query($conn, "SELECT max(kd_pelanggan) as kd_pelanggan FROM tb_pelanggan");
                $data = mysqli_fetch_array($query);
                $kd_pelanggan = $data['kd_pelanggan'];
                $urutan = (int) substr($kd_pelanggan, 3, 3);
                $urutan++;
                $huruf = "PLG";
                $kd_pelanggan = $huruf . sprintf("%03s", $urutan);
                ?>
                <input type="text" id="kd_pelanggan" name="kd_pelanggan" class="form-control"
                    value="<?php echo $kd_pelanggan ?>" hidden>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="ex@gmail.com"
                        autocomplete="off" required>
                    <label for="username">Username</label>
                </div>
                <div class="col-md-8">
                    <div class="form-floating">
                        <input type="text" name="nama_pelanggan" class="form-control" id="floatingInput"
                            placeholder="example" autocomplete="off" required>
                        <label for="floatingInput">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="asal_kelas" class="form-control" id="floatingemail"
                            placeholder="12 IPS 1/ 12 TKJ 3" autocomplete="off" required>
                        <label for="asal Kelas">Kelas</label>
                    </div>
                </div>
                <div class="form-floating">
                    <input type="text" name="email" class="form-control" id="floatingInput" placeholder="ex@gmail.com"
                        autocomplete="off" required>
                    <label for="floatingemail">Email</label>
                </div>
                <div class="form-floating">
                    <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="08XXXXXXXX"
                        autocomplete="off" required>
                    <label for="floatingemail">Nomor Telepon</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password" autocomplete="off" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-dark" name="daftar">
                    <h6>Daftar</h6>
                </button>
                <small><a href="login.php">Sudah memiliki akun ?</a></small>
                <p>
                <h6>&copy;EpicureanEats 2024</h6>
                </p>
            </form>
        </div>
    </div>
</body>
<?php

if (isset ($_POST["daftar"]) && empty ($_SESSION["keranjang"])) {

    $kd_pelanggan = $_POST['kd_pelanggan'];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $asal_kelas = $_POST["asal_kelas"];
    $no_hp = $_POST["no_hp"];

    $sql = $conn->query("INSERT INTO tb_pelanggan (kd_pelanggan, email, username, password, nama_pelanggan, asal_kelas, no_hp)  VALUES ('$kd_pelanggan', '$email', '$username','$password', '$nama_pelanggan', '$asal_kelas', '$no_hp')");

    if ($sql === true) {
        echo "<script>alert('Pendaftaran Berhasil, Silakan Login');</script> ";
        echo "<script>location='login.php';</script> ";
    } else {
        echo "Gagal: " . $conn->error;
    }

}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>