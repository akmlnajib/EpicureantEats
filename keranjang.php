<?php
include "koneksi.php";
ob_start();

if (!isset($_SESSION["keranjang"]) || empty($_SESSION["keranjang"])) {
    echo "<script>alert('Silahkan Pilih Produk Lebih Dahulu');</script>";
    echo "<script>location='index.php';</script>";
    exit;
}

if (!isset($_SESSION["username"])) {
    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit;
}

$username = $_SESSION["username"];
$query_pelanggan = "SELECT id_pelanggan FROM tb_pelanggan WHERE username = ?";
$stmt_pelanggan = $conn->prepare($query_pelanggan);
$stmt_pelanggan->bind_param("s", $username);
$stmt_pelanggan->execute();
$result_pelanggan = $stmt_pelanggan->get_result();

if ($result_pelanggan->num_rows > 0) {
    $row_pelanggan = $result_pelanggan->fetch_assoc();
    $id_pelanggan = $row_pelanggan["id_pelanggan"];
} else {
    echo "<script>alert('Pelanggan tidak ditemukan');</script>";
    echo "<script>location='login.php';</script>";
    exit;
}
$stmt_pelanggan->close();
?>

<form action="" method="POST">
<div class="card mt-5">
  <div class="card-header">
    <h2 class="">Keranjang Belanja</h2>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Total</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $totalbelanja = 0;
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): 
            $query = $conn->query("SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
            $row = $query->fetch_assoc();
            $subtotal = $row['harga_produk'] * $jumlah;
            $totalbelanja += $subtotal;
        ?>
        <tr>
          <th scope="row"><?= $no; ?></th>
          <td><?= $row['nama_produk']; ?></td>
          <td><?= "Rp " . number_format($row['harga_produk']); ?></td>
          <td><?= $jumlah; ?></td>
          <td><?= "Rp " . number_format($subtotal); ?></td>
          <td><a class="btn btn-danger" href="hapuskeranjang.php?id=<?= $id_produk; ?>">Hapus</td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-end">
      <div class="form-group">
        <label for="keterangan">Keterangan:</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan">
      </div>
      <h4>Total Belanja: <?= "Rp. " . number_format($totalbelanja); ?></h4>
      <button type="submit" name="submit" class="btn btn-dark">Checkout</button>
    </div>
  </div>
</div>
</form>

<?php
if (isset($_POST["submit"])) {
    $order_id = rand();
    $total_penjualan = $totalbelanja;
    $tanggal_penjualan = date("Y-m-d");
    $transaction_status = 1;
    $transaction_id = "";
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    $stmt_penjualan = $conn->prepare("INSERT INTO tb_penjualan (order_id, id_pelanggan, tanggal_penjualan, total_penjualan, transaction_status, transaction_id, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_penjualan->bind_param("sssssis", $order_id, $id_pelanggan, $tanggal_penjualan, $total_penjualan, $transaction_status, $transaction_id, $keterangan);

    if ($stmt_penjualan->execute()) {
        $id_penjualan_barusan = $conn->insert_id;

        foreach ($_SESSION['keranjang'] as $id_produk => $qty_keluar) {
            $stmt_penjualan_produk = $conn->prepare("INSERT INTO tb_penjualan_produk (id_penjualan, id_produk, qty_keluar) VALUES (?, ?, ?)");
            $stmt_penjualan_produk->bind_param("sss", $id_penjualan_barusan, $id_produk, $qty_keluar);

            if (!$stmt_penjualan_produk->execute()) {
                echo "Gagal menyimpan detail produk: " . $stmt_penjualan_produk->error;
                $stmt_penjualan->close();
                $stmt_penjualan_produk->close();
                exit();
            }
            $stmt_penjualan_produk->close();
        }

        unset($_SESSION['keranjang']);

        header("location:./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id");
        ob_end_flush();
    } else {
        echo "Gagal menyimpan pemesanan: " . $conn->error;
    }

    $stmt_penjualan->close();
}
?>
