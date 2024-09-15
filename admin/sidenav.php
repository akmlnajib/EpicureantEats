<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu mb-5">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="./?page=dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Data Master</div>
                            <a class="nav-link" href="./?page=produk">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="./?page=pelanggan">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                Pelanggan
                            </a>
                            <a class="nav-link" href="./?page=penjualan">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                                Transaksi
                            </a>
                    </div>
                    <?php
                    include "koneksi.php";
                    if (!isset ($_SESSION['username'])) {
                        header("Location: login.php");
                        exit();
                    }
                    
                    $username = $_SESSION['username'];
                    
                    $sql = "SELECT * FROM tb_admin WHERE username = '$username'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nama = $row['nama'];
                    } else {
                        echo "Profil tidak ditemukan";
                    }
                    
                    $conn->close();
                    ?>                    <div class="sb-sidenav-footer mt-5">
                        <div class="small">Logged in as: </div>
                        <?= $nama; ?>
                    </div>
                </nav>