<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_pelanggan WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $loginError = true;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>EpicureanEats 2024</title>

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
            max-width: 800px;
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
    <div class="card form-signin opacity-50" style=" border-radius: 20px; width: 18rem;">
        <div class="card-body">
            <img class="mb-4 card-title" src="admin/assets/img/log1.png" alt="" width="100" height="75">
            <form method="POST" enctype="multipart/form-data">
                <h5 class="card-subtitle mb-2">Login</h5>
                <?php if (isset($loginError) && $loginError): ?>
                    <!-- Menampilkan alert danger jika login gagal -->
                    <div class="alert alert-danger" role="alert">
                        Login gagal! Periksa kembali username dan password Anda.
                    </div>
                <?php endif; ?>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="example"
                        autocomplete="off">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password" autocomplete="off">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-dark mb-2" name="submit">
                    <h6>Login</h6>
                </button>
                <small><a href="daftar.php">Belum memiliki akun ?</a> </small>
                <p>
                <h6>&copy;EpicureanEats 2024</h6>
                </p>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>
