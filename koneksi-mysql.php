<?php
//hubungkan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "vsgH7ja6ka2I3km", "test_db");
// Check koneksi database
if (!$koneksi) {
    die("ERROR: Koneksi gagal. " . mysqli_connect_error());
}