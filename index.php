<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Alumni</title>
    <link rel="stylesheet" href="page.css">
</head>

<body>

    <div class="container-nav">
        <div class="nav">
            <h1>Data Alumni Sekolah</h1>
             <a href="tambah.php" id="tambahdata">+ Tambah Data</a>
        </div>
    </div>

    
    <!-- FORM PENCARIAN -->
     <div class="container-pencarian">
         <form method="GET" style="margin-bottom: 20px;">
             <h2>PENCARIAN</h2>
             <input type="text" name="cari" placeholder="Cari nama / NIK / NISN / Jurusan..."
             value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
             <button type="submit">Cari</button>
            </form>
        </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>NISN</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tahun Lulus</th>
            <th>Jurusan</th>
            <th>Perubahan</th>
        </tr>

        <?php
        // PENCARIAN
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            $result = mysqli_query($conn, "SELECT * FROM alumni 
                WHERE nama LIKE '%$cari%' 
                OR nik LIKE '%$cari%' 
                OR nisn LIKE '%$cari%' 
                OR jurusan LIKE '%$cari%' 
                OR tahun_lulus LIKE '%$cari%' ");
        } else {
            $result = mysqli_query($conn, "SELECT * FROM alumni");
        }

        // TAMPILKAN DATA
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['nik']}</td>
                <td>{$row['nisn']}</td>
                <td>{$row['tempat_lahir']}</td>
                <td>{$row['tanggal_lahir']}</td>
                <td>{$row['alamat']}</td>
                <td>{$row['tahun_lulus']}</td>
                <td>{$row['jurusan']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> |
                    <a href='hapus.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
      

</body>
</html>
<div class="footer">© 2025 UKK LV3 — SMK TELKOM LAMPUNG</div>


