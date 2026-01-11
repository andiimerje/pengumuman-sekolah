<?php 
include "includes/config.php"; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$q = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id = $id");
$d = mysqli_fetch_assoc($q);

if(!$d){
    echo "<h3>Pengumuman tidak ditemukan.</h3>";
    exit;
}

function tanggal_indo($tanggal){
    $bulan = [
        1=>'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
    ];
    $pecah = explode('-', substr($tanggal, 0, 10));
    return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}

$kat = strtolower($d['kategori']);
$icon = "assets/icons/" . $kat . ".png";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

/* ================================
   BASE (eReader Style)
================================ */
body {
    margin: 0;
    background: #f7f3e9;   /* PUTIH KREM LEMBUT */
    font-family: Arial, sans-serif;
    padding-bottom: 95px; /* ruang untuk footer */
    color: #222;
}

.container {
    max-width: 720px;
    margin: auto;
    padding: 18px;
}

/* ================================
   BACK BUTTON
================================ */
.back-btn {
    display: inline-block;
    background: #fff;
    padding: 10px 15px;
    color: #444;
    font-weight: bold;
    text-decoration: none;
    border-radius: 12px;
    margin-bottom: 18px;
    border: 1px solid #e3dccd;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

/* ================================
   HEADER (tanpa card)
================================ */
.detail-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 5px 0;
}

.detail-icon {
    width: 55px;
    height: 55px;
    object-fit: contain;
}

.detail-title {
    font-size: 22px;
    font-weight: bold;
    color: #222;
}

.detail-date {
    font-size: 13px;
    color: #777;
}

/* ================================
   IMAGE
================================ */
.detail-img {
    width: 100%;
    height: auto;
    max-height: 95vh;
    object-fit: contain;
    border-radius: 12px;
    margin: 15px 0;
    background: #f7f3e9; /* senada dengan background */
}

/* ================================
   TEXT
================================ */
.detail-text {
    font-size: 17px;
    line-height: 1.7;
    white-space: pre-line;
    color: #222;
}

/* ================================
   FOOTER FIXED — KUNING KEPUTIHAN
================================ */
.fixed-footer-btn {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999;
}

.fixed-footer-btn a {
    display: block;
    width: 100%;
    background: #f2e4a8; /* kuning keputihan lembut */
    padding: 16px 0;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    color: #000;
    border-top: 1px solid #e6d894;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.12);
}

.fixed-footer-btn a:hover {
    background: #e9d78f;
}

</style>
</head>

<body>

<div class="container">

    <a class="back-btn" href="index.php">← Kembali</a>

    <div class="detail-header">
        <img src="<?= $icon ?>" class="detail-icon">
        <div>
            <div class="detail-title"><?= $d['judul'] ?></div>
            <div class="detail-date">📅 <?= tanggal_indo($d['tanggal']) ?></div>
        </div>
    </div>

    <!-- GAMBAR -->
    <?php if($d['gambar']) { ?>
        <img src="uploads/<?= $d['gambar'] ?>" class="detail-img">
    <?php } ?>

    <!-- AUTO LINK -->
    <?php
    $isi = $d['isi'];
    $isi = preg_replace('/(https?:\/\/[^\s<]+)/', '<a href="$1" target="_blank">$1</a>', $isi);
    ?>

    <div class="detail-text"><?= $isi ?></div>

</div>

<!-- FOOTER BUTTON -->
<?php if(!empty($d['btn_text']) && !empty($d['btn_link'])) { 
    $link = trim($d['btn_link']);
    if (!preg_match('/^https?:\/\//', $link)) $link = "https://" . $link;
?>
<div class="fixed-footer-btn">
    <a href="<?= $link ?>" target="_blank">
        <?= htmlspecialchars($d['btn_text']) ?>
    </a>
</div>
<?php } ?>

</body>
</html>
