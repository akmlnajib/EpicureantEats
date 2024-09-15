<?php
include "../koneksi.php";
$query = $conn->query("SELECT tb_produk.*, tb_jenis.nama_jenis FROM tb_produk 
LEFT JOIN tb_jenis ON tb_produk.id_jenis = tb_jenis.id_jenis 
WHERE tb_produk.id_produk ='$_GET[id]'");
$row = $query->fetch_assoc();

if (isset ($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    if (!empty ($lokasifoto)) {

        move_uploaded_file($lokasifoto, "../assets/images/$namafoto");

        $conn->query("UPDATE tb_produk SET id_jenis='$_POST[id_jenis]', nama_produk='$_POST[nama_produk]',
							 harga_produk='$_POST[harga_produk]', foto_produk='$namafoto' WHERE id_produk='$_GET[id]'");
    } else {
        $conn->query("UPDATE tb_produk SET id_jenis='$_POST[id_jenis]', nama_produk='$_POST[nama_produk]',
							 harga_produk='$_POST[harga_produk]' WHERE id_produk='$_GET[id]'");
    }

    echo "<script>alert('Data Berhasil di Ubah');</script>";
    echo "<script>location = './?page=produk';</script>";
}
?>

<div class="card mt-4">
    <div class="card-header">
<h1 class="mt-4">Ubah Produk</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Data Master / Produk / Ubah Produk</li>
</ol>
</div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="kode_barang" class="form-label">Kode Produk</label>
                <input type="text" class="form-control" id="kd_produk" name="kd_produk" readonly
                    value="<?php echo $row['kd_produk']; ?>" readonly>
                <div id="kd_produk" class="form-text">*Kode produk tidak dapat diubah.</div>
            </div>
            <div class="col-md-4">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>">
            </div>
            <div class="col-md-4">
                <label for="id_jenis" class="form-label">Jenis Produk</label>
                <select class="form-select" id="id_jenis" name="id_jenis">
                    <option selected value="<?php echo $row['id_jenis']; ?>"> <?= $row['nama_jenis']?></option>
                    <option value="1">Makanan Berat</option>
                    <option value="2">Makanan Ringan</option>
                    <option value="3">Minuman</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $row['harga_produk']; ?>">
                <div id="harga_produk" class="form-text">*ex : 15000.</div>
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Upload Gambar</label>
                <input class="form-control" type="file" id="formFile" name="foto">
                <div id="qty_produk" class="form-text">*Format gambar dalam bentuk .JPG .PNG</div>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-dark" name="ubah">Ubah</button>
            </div>
        </form>
    </div>
</div>