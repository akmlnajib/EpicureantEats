<h3>Makanan Ringan</h3>
<hr>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!-- Item 1 -->
    <?php
    include "koneksi.php";
    $query = $conn->query("SELECT * FROM tb_produk");
    while ($row = $query->fetch_assoc()) {
        if ($row['id_jenis'] == 2) {
            ?>
            <div class="col">
                <div class="card">
                    <img src="assets/images/<?= $row['foto_produk']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $row['nama_produk']; ?>
                        </h5>
                        <p class="card-text">
                            <?= "Rp. " . number_format($row['harga_produk']); ?>
                        </p>
                        <?php if (isset($_SESSION["username"])): ?>
                        <a href="beli.php?id=<?= $row['id_produk']; ?>" class="btn btn-dark"><i class="fa-solid fa-cart-plus"></i>  Masukan keranjang</a>
                        <?php else: ?>
                            Login terlebih dahulu untuk melakukan pembelian
                        <?php endif ?>    
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>