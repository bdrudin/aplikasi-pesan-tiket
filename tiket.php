<?php
require_once "koneksi-mysql.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Anda</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="sticky-top navbar navbar-expand-lg navbar-dark bg-secondary text-bg-light mb-2">
        <div class="container">
            <a class="navbar-brand fw-bold" href="home.php">Wisataku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="home.php">Home</a>
                    <a class="nav-link " href="daftar-harga.php">Daftar Harga</a>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container mt-3 ms-auto">
            <div class="row justify-content-center">
                <div class="col-7 bg-light p-5">
                    <h4 class=" mb-4 fw-bold">Pesanan Anda:</h4>
                    <table class="table table-borderless">
                        <?php
                        $sql = "SELECT nama_lengkap, no_identitas, no_hp, tanggal_kunjungan, tempat_wisata,
                        pengunjung_dewasa, pengunjung_anak FROM pemesanan ORDER BY id DESC LIMIT 1";
                        $query = mysqli_query($koneksi, $sql);
                        $row = mysqli_fetch_array($query);
                        $nama = $row['nama_lengkap'];
                        $no_identitas = $row['no_identitas'];
                        $no_hp = $row['no_hp'];
                        $tempat_wisata = $row['tempat_wisata'];
                        $tanggal = $row['tanggal_kunjungan'];
                        $pengunjung_dewasa = $row['pengunjung_dewasa'];
                        $pengunjung_anak = $row['pengunjung_anak'];

                        $kebun_raya = 30000;
                        $kampung_koneng = 20000;
                        $kampung_tokyo = 25000;
                        $devoyage = 35000;

                        $diskon = 50 / 100;

                        echo "<tr>";
                        echo "<td>Nama Pemesan</td>";
                        echo "<td>: $nama</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>No Identitas</td>";
                        echo "<td>: $no_identitas</td>";
                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>No HP</td>";
                        echo "<td>: $no_hp</td>";
                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>Tempat Wisata</td>";
                        echo "<td>: $tempat_wisata</td>";
                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>Pengunjung Dewasa</td>";
                        echo "<td>: $pengunjung_dewasa orang</td>";
                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>Pengunjung Anak-anak</td>";
                        echo "<td>: $pengunjung_anak orang</td>";
                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>Harga Tiket</td>";
                        //perbandingan untuk menentukan total bayar
                        if ($tempat_wisata === "Kebun Raya") {
                            // tampilkan harga
                            echo "<td>: Rp. $kebun_raya</td>";
                            $total_hrg_pDewasa = $kebun_raya * $pengunjung_dewasa;
                            $total_hrg_pAnak = $kebun_raya * $pengunjung_anak * $diskon;
                            $total = $total_hrg_pDewasa + $total_hrg_pAnak;
                        } else if ($tempat_wisata === "Kampung Koneng") {
                            echo "<td>: Rp. $kampung_koneng</td>";
                            $total_hrg_pDewasa = $kampung_koneng * $pengunjung_dewasa;
                            $total_hrg_pAnak = $kampung_koneng * $pengunjung_anak * $diskon;
                            $total = $total_hrg_pDewasa + $total_hrg_pAnak;
                        } else if ($tempat_wisata === "Kampung Tokyo") {
                            echo "<td>: Rp. $kampung_tokyo</td>";
                            $total_hrg_pDewasa = $kampung_tokyo * $pengunjung_dewasa;
                            $total_hrg_pAnak = $kampung_tokyo * $pengunjung_anak * $diskon;
                            $total = $total_hrg_pDewasa + $total_hrg_pAnak;
                        } else if ($tempat_wisata === "Devoyage") {
                            echo "<td>: Rp. $devoyage</td>";
                            $total_hrg_pDewasa = $devoyage * $pengunjung_dewasa;
                            $total_hrg_pAnak = $devoyage * $pengunjung_anak * $diskon;
                            $total = $total_hrg_pDewasa + $total_hrg_pAnak;
                        }

                        echo "
                        </tr>";
                        echo "<tr>";
                        echo "<td>Total Bayar</td>";
                        echo "<td>: Rp. $total</td>";
                        echo "
                        </tr>";
                        ?>
                    </table>
                    <p class="text-center fw-bold mt-5">**Pesanan Anda akan diproses lebih lanjut**</p>
                </div>
            </div>
        </div>
    </section>
    <script>
    window.print();
    </script>
</body>

</html>