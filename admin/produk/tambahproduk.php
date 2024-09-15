<?php
include "../koneksi.php";
if (isset ($_POST['submit'])) {

    $kd_produk = $_POST['kd_produk'];
    $nama_produk = $_POST['nama_produk'];
    $id_jenis = $_POST['id_jenis'];
    $harga_produk = $_POST['harga_produk'];

    $namafoto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../assets/images/" . $namafoto);

    $conn->query("INSERT INTO tb_produk (kd_produk, id_jenis, nama_produk, harga_produk, foto_produk)
                     VALUES ('$kd_produk', '$id_jenis','$nama_produk', '$harga_produk', '$namafoto')");

    echo "<script>alert('Data berhasil disimpan.');</script>";
    echo "<script>location = './?page=produk';</script>";
}
?>

<div class="card mt-4">
    <div class="card-header">
<h1 class="mt-4">Tambah Produk</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / Produk / Tambah Produk</li>
</ol>
</div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <?php
                $query = mysqli_query($conn, "SELECT max(kd_produk) as kd_produk FROM tb_produk");
                $data = mysqli_fetch_array($query);
                $kd_produk = $data['kd_produk'];
                $urutan = (int) substr($kd_produk, 3, 3);
                $urutan++;
                $huruf = "PRO";
                $kd_produk = $huruf . sprintf("%03s", $urutan);
                ?>
                <label for="kode_barang" class="form-label">Kode Produk</label>
                <input type="text" class="form-control" id="kd_produk" name="kd_produk" readonly
                    value="<?php echo $kd_produk ?>">
                <div id="kd_produk" class="form-text">*Kode produk otomatis.</div>
            </div>
            <div class="col-md-4">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
            </div>
            <div class="col-md-4">
                <label for="id_jenis" class="form-label">Jenis Produk</label>
                <select class="form-select" id="id_jenis" name="id_jenis">
                    <option selected disabled>Pilih Nama Produk</option>
                    <option value="1">Makanan Berat</option>
                    <option value="2">Makanan Ringan</option>
                    <option value="3">Minuman</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="text" class="form-control" id="harga_produk" name="harga_produk">
                <div id="harga_produk" class="form-text">*ex : 15000.</div>
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Upload Gambar</label>
                <input class="form-control" type="file" id="formFile" name="foto">
                <div id="qty_produk" class="form-text">*Format gambar dalam bentuk .JPG .PNG</div>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>