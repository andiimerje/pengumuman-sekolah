<?php
session_start();
include "../includes/config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$q = mysqli_query($koneksi, "
    SELECT * FROM pengumuman 
    ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelola Pengumuman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f4f4;
    font-family: 'Poppins', sans-serif;
    padding: 20px;
}
.table-container {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
</style>
</head>

<body>

<div class="container">

    <h2 class="text-center mb-4">📃 Kelola Pengumuman</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="tambah.php" class="btn btn-success">➕ Tambah Pengumuman</a>
        <a href="home.php" class="btn btn-secondary">🏠 Dashboard</a>
    </div>

    <div class="table-container">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $no = 1; while($d = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['judul']) ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($d['tanggal'])) ?></td>
                    <td><?= htmlspecialchars($d['kategori']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                        <a href="hapus.php?id=<?= $d['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus?')" 
                           class="btn btn-danger btn-sm">🗑 Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
