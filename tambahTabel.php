<?php
include 'koneksi.php';

// Ambil input dari pengguna dan sanitasi
$judul = $_POST['judul'];
$judul = preg_replace('/[^a-zA-Z0-9_]/', '', $judul); // Hanya izinkan huruf, angka, dan underscore

// Buat query untuk membuat tabel
$sql = "CREATE TABLE $judul (
    id INT AUTO_INCREMENT,
    judul VARCHAR(30),
    kegiatan VARCHAR(255) NOT NULL,
    cek VARCHAR(2) NOT NULL,
    PRIMARY KEY (id)
)";

// Eksekusi query dan cek hasilnya
if (mysqli_query($koneksi, $sql)) {
    echo "Tabel Berhasil Dibuat";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>