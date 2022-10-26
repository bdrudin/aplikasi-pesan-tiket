<?php
require_once "koneksi-mysql.php";
// cek apakah user sudah melakukan klik tombol pesan tiket
if (isset($_POST['pesan'])) {
    $nama = $_POST['nama'];
    $no_identitas = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $tempat_wisata = $_POST['tempat_wisata'];
    $tanggal = $_POST['tanggal'];
    $pengunjung_dewasa = $_POST['pengunjung_dewasa'];
    $pengunjung_anak = $_POST['pengunjung_anak'];

    // cek form input apakah kosong, jika tidak maka tambahkan user input kedalam database
    if (!empty($nama) && !empty($no_identitas) && !empty($no_hp) && !empty($tempat_wisata) && !empty($tanggal) && !empty($pengunjung_dewasa)) {
        $tambah_pesanan = "INSERT INTO pemesanan
        VALUES('', '$nama', '$no_identitas', '$no_hp', '$tempat_wisata', '$tanggal', '$pengunjung_dewasa', '$pengunjung_anak')";
        mysqli_query($koneksi, $tambah_pesanan);
    }
    // redirect jika sudah melakukan pesan
    header("Location: tiket.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisataku | Pesan tiket</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <style>
    .input-group-text {
        width: 200px;

    }
    </style>

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
        <div class="container mt-4 ms-auto">
            <div class="row justify-content-center">
                <div class="col-8">
                    <h3 class="fw-bold text-center">Form Pemesanan Tiket</h3>
                    <form method="post">
                        <div class="form-control mb-3 p-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama Lengkap</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" placeholder="masukan nama" name="nama">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nomor Identitas</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" placeholder="masukan nik ktp"
                                    name="nik">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nomor Hp</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" placeholder="masukan nomor hp"
                                    name="no_hp">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"> Pilih Tempat
                                    Wisata:</span>
                                <select id="tempat_wisata" name="tempat_wisata" class="form-control">
                                    <option value="Kebun Raya">Kebun Raya</option>
                                    <option value="Kampung Koneng">Kampung Koneng</option>
                                    <option value="Kampung Tokyo">Kampung Tokyo</option>
                                    <option value="Devoyage">Devoyage</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Tanggal Kunjungan</span>
                                <input type="date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="tanggal">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Pengunjung Dewasa</span>
                                <input type="number" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="pengunjung_dewasa" min="1"
                                    max="15" placeholder="jumlah pengunjung dewasa" id="pengunjung-dewasa">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Pengunjung
                                    Anak-anak</span>
                                <input type="number" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="pengunjung_anak" min="0" max="15"
                                    placeholder="jumlah pengunjung anak-anak dibawah 12 tahun" id="pengunjung-anak">
                            </div>

                            <div class="form-group mb-3 fw-bold mt-4 ms-5">
                                <label>Harga Tiket : <span class="harga-tiket"></span></label>
                            </div>
                            <div class="form-group mb-3 fw-bold ms-5">
                                <label>Total Bayar : <span class="total-bayar"></span></label>
                            </div>

                            <div class="input-group mb-3 p-3 text-center">
                                <label for="check">Saya dan/atau rombongan telah membaca, memahami, dan setuju
                                    berdasarkan syarat dan
                                    ketentuan yang telah ditetapkan.
                                    <input type="checkbox" id="check" name="check" required></label>
                            </div>
                            <div class="form-group mb-3 m-3 d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="button" class="btn btn-secondary hitung" id="hitung" name="hitung">Total
                                    bayar</button>
                                <button type="submit" class="btn btn-success" id="pesan" name="pesan">Pesan
                                    tiket</button>
                                <a href="home.php">
                                    <button type="button" class="btn btn-danger " id="cancel" name="cancel">Batal
                                        pesan</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
    const hitung = document.querySelector('.hitung');
    hitung.addEventListener('click', function() {
        const diskon = 50 / 100;
        const kebunRaya = 30000;
        const kampungKoneng = 20000;
        const kampungTokyo = 25000;
        const devoyage = 35000;

        const tempatWisata = document.getElementById('tempat_wisata').value
        const jumlahDewasa = document.getElementById('pengunjung-dewasa').value;
        const jumlahAnak = document.getElementById('pengunjung-anak').value;

        const hargaTiket = document.querySelector('.harga-tiket');
        const totalBayar = document.querySelector('.total-bayar');

        if (tempatWisata === "Kebun Raya") {
            let thPengunjungDewasa = kebunRaya * jumlahDewasa;
            let thPengunjungAnak = kebunRaya * jumlahAnak * diskon;
            let total = thPengunjungDewasa + thPengunjungAnak;
            if (jumlahDewasa >= 1 || jumlahAnak >= 1) {
                hargaTiket.innerText = "Rp. " + kebunRaya;
                totalBayar.innerText = "Rp. " + total;
            }
        } else if (tempatWisata === "Kampung Koneng") {
            let thPengunjungDewasa = kampungKoneng * jumlahDewasa;
            let thPengunjungAnak = kampungKoneng * jumlahAnak * diskon;
            let total = thPengunjungDewasa + thPengunjungAnak;
            if (jumlahDewasa >= 1 || jumlahAnak >= 1) {
                hargaTiket.innerText = "Rp. " + kampungKoneng;
                totalBayar.innerText = "Rp. " + total;
            }
        } else if (tempatWisata === "Kampung Tokyo") {
            let thPengunjungDewasa = kampungTokyo * jumlahDewasa;
            let thPengunjungAnak = kampungTokyo * jumlahAnak * diskon;
            let total = thPengunjungDewasa + thPengunjungAnak;
            if (jumlahDewasa >= 1 || jumlahAnak >= 1) {
                hargaTiket.innerText = "Rp. " + kampungTokyo;
                totalBayar.innerText = "Rp. " + total;
            }
        } else if (tempatWisata === "Devoyage") {
            let thPengunjungDewasa = devoyage * jumlahDewasa;
            let thPengunjungAnak = devoyage * jumlahAnak * diskon;
            let total = thPengunjungDewasa + thPengunjungAnak;
            if (jumlahDewasa >= 1 || jumlahAnak >= 1) {
                hargaTiket.innerText = "Rp. " + devoyage;
                totalBayar.innerText = "Rp. " + total;
            }
        }
    })
    </script>

</body>

</html>