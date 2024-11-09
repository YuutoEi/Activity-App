<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "kegiatan";
$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("koneksi gagal : " . mysqli_connect_error());
}


?>