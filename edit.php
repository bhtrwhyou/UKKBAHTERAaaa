<?php
include 'koneksi.php';

// 1. Pastikan parameter 'id' ada dan merupakan angka
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid. <a href='index.php'>Kembali ke Daftar</a>");
}

$id = intval($_GET['id']); // Konversi ke integer untuk keamanan

// 2. Eksekusi query dan cek apakah berhasil
$query = "SELECT * FROM alumni WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// 3. Ambil data
$data = mysqli_fetch_assoc($result);

// 4. Jika data tidak ditemukan, tampilkan pesan
if (!$data) {
    die("Data dengan ID $id tidak ditemukan. <a href='index.php'>Kembali ke Daftar</a>");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Alumni</title>
    <link rel='stylesheet' href='page.css'>
</head>

<body>
    <h2>Edit Data Alumni</h2>
    <form method="POST">
        <!-- Tambahkan input tersembunyi untuk menyimpan ID -->
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        <input type="text" name="nik" value="<?= htmlspecialchars($data['nik']) ?>" required>
        <input type="text" name="nisn" value="<?= htmlspecialchars($data['nisn']) ?>" required>
        <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($data['tempat_lahir']) ?>" required>
        <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>" required>
        <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        <input type="number" name="tahun_lulus" value="<?= htmlspecialchars($data['tahun_lulus']) ?>" required>
        <select name="jurusan" required>
            <option value="">Jurusan</option>
            <option value="RPL" <?= $data['jurusan'] == 'RPL' ? 'selected' : '' ?>>RPL</option>
            <option value="TKJ" <?= $data['jurusan'] == 'TKJ' ? 'selected' : '' ?>>TKJ</option>
            <option value="TJAT" <?= $data['jurusan'] == 'TJAT' ? 'selected' : '' ?>>TJAT</option>
            <option value="ANIMASI" <?= $data['jurusan'] == 'ANIMASI' ? 'selected' : '' ?>>ANIMASI</option>
        </select>
        <button type="submit" name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        // Validasi ulang ID dari form
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            echo "<p style='color:red;'>ID tidak valid.</p>";
        } else {
            $id_update = intval($_POST['id']);
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);
            $nik = mysqli_real_escape_string($conn, $_POST['nik']);
            $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
            $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
            $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
            $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
            $tahun_lulus = mysqli_real_escape_string($conn, $_POST['tahun_lulus']);
            $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);

            // Gunakan prepared statement atau setidaknya escape string untuk keamanan
            $sql = "UPDATE alumni SET
                nama='$nama', nik='$nik', nisn='$nisn',
                tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir',
                alamat='$alamat', tahun_lulus='$tahun_lulus', jurusan='$jurusan'
                WHERE id=$id_update";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Data berhasil diupdate! <a href='index.php'>Kembali</a></p>";
            } else {
                echo "<p style='color:red;'>Gagal mengupdate data: " . mysqli_error($conn) . "</p>";
            }
        }
    }
    ?>
    <footer>
    &copy; <?= date('Y') ?> UKK LV3 — SMK TELKOM LAMPUNG 2025
</footer>

</body>

</html>