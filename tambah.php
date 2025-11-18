<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Alumni</title>
    <link rel="stylesheet" href="page.css">
</head>

<body>
    <h2>Tambah Data Alumni</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="nik" placeholder="NIK" required>
        <input type="text" name="nisn" placeholder="NISN" required>
        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
        <input type="date" name="tanggal_lahir" required>
        <textarea name="alamat" placeholder="Alamat" required></textarea>
        <input type="number" name="tahun_lulus" placeholder="Tahun Lulus" required>
        <select name="jurusan" required>
            <option value="">Jurusan</option>
            <option value="RPL">RPL</option>
            <option value="TKJ">TKJ</option>
            <option value="TJAT">TJAT</option>
            <option value="ANIMASI">ANIMASI</option>
        </select>
        <button type="submit" name="submit">Simpan</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $nik = $_POST['nik'];
        $nisn = $_POST['nisn'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $tahun_lulus = $_POST['tahun_lulus'];
        $jurusan = $_POST['jurusan'];

        // 🔍 Cek apakah NIK atau NISN sudah ada
        $cek = mysqli_query($conn, "SELECT * FROM alumni WHERE nik='$nik' OR nisn='$nisn'");

        if (mysqli_num_rows($cek) > 0) {
            echo "<p style='color:red;'>NIK atau NISN sudah digunakan! Silakan periksa kembali.</p>";
        } else {
            // Jika belum ada, simpan data
            $sql = "INSERT INTO alumni (nama, nik, nisn, tempat_lahir, tanggal_lahir, alamat, tahun_lulus, jurusan)
                    VALUES ('$nama', '$nik', '$nisn', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$tahun_lulus', '$jurusan')";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color:green;'>✅ Data berhasil disimpan!</p>";
                header("Location: index.php");
            } else {
                echo "<p style='color:red;'>Gagal menyimpan data!</p>";
            }
        }
    }
    ?>

</body>
<footer>
    &copy; <?= date('Y') ?> UKK LV3 — SMK TELKOM LAMPUNG 2025
</footer>

</html>