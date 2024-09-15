<a class="navbar-brand ps-3" href="./?page=content"><img src="admin/assets/img/log1.png" alt="" width="100"
        height="60"></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="./?page=content"><i class="fa-solid fa-house-chimney"></i> Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./?page=allcontent"><i class="fa-solid fa-border-all"></i> All Item</a>
        </li>
        <?php
        session_start();
        if (isset ($_SESSION["username"])): ?>
            <li class="nav-item">
                <a class="nav-link" href="./?page=keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?page=riwayat"><i class="fa-solid fa-list-check"></i> Riwayat</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="./?page=settings">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            </li>

        <?php endif ?>
    </ul>
</div>