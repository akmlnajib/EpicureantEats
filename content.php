<div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/b.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/images/d.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h3>Makanan Berat</h3>
    </div>
    <div class="col-md-12">
        <a href="./?page=makananBerat"><small>See More</small></a>
    </div>
</div>
<hr>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!-- Item 1 -->
    <?php
    include "koneksi.php";
    $query = $conn->query("SELECT * FROM tb_produk LIMIT 6");
    while ($row = $query->fetch_assoc()) {
        if ($row['id_jenis'] == 1) {
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
<div class="row mt-2">
    <div class="col">
        <h3>Makanan Ringan</h3>
    </div>
    <div class="col-md-12">
        <a href="./?page=makananRingan"><small>See More</small></a>
    </div>
</div>
<hr>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!-- Item 1 -->
    <?php
    include "koneksi.php";
    $query = $conn->query("SELECT * FROM tb_produk LIMIT 4");
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
<div class="row mt-2">
    <div class="col">
        <h3>Minuman</h3>
    </div>
    <div class="col-12">
        <a href="./?page=minuman"><small>See More</small></a>
    </div>
</div>
<hr>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!-- Item 1 -->
    <?php
    include "koneksi.php";
    $query = $conn->query("SELECT * FROM tb_produk LIMIT 4");
    while ($row = $query->fetch_assoc()) {
        if ($row['id_jenis'] == 3) {
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