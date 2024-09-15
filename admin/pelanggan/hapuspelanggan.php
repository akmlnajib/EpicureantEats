<?php

$ambil = $koneksi->query("SELECT * FROM tb_pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM tb_pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('Pelanggan Dengan kode'". $id_pelanggan.  "' Berhasil di Hapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";



?>