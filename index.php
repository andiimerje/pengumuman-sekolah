<?php 
include "includes/config.php"; 

// --- Format tanggal Indonesia ---
function tanggal_indo($tgl){
    $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $bulan = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    $t = strtotime($tgl);
    return $hari[date('w',$t)] . ", " . date('d',$t) . " " . $bulan[(int)date('m',$t)] . " " . date('Y',$t);
}

$q = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="assets/css/style.css">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5GLR2VDCLF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-5GLR2VDCLF');
</script>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f2f2f2;
    margin: 15px;
}

.list-container {
    margin-top: 10px;
}

.card-link {
    text-decoration: none;
    color: inherit;
}

.card {
    background: #ffffff;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 12px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    transition: 0.2s;
}

.card:hover {
    transform: scale(1.01);
}

.card-title {
    font-weight: 600;
    font-size: 18px;
    margin: 0;
}

.card-date {
    color: #777;
    font-size: 13px;
}

.card-preview {
    color: #444;
    font-size: 14px;
}

/* Badge kategori */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    color: #fff;
    font-weight: 500;
    width: fit-content;
}

.badge-pembayaran { background: #e74c3c; } /* merah */
.badge-nilai       { background: #27ae60; } /* hijau */
.badge-info        { background: #3498db; } /* biru */
</style>
</head>

<body>

<h2 style="margin-bottom: 15px;">📢 Daftar Pengumuman Adiwiyata SMPN 27</h2>

<div class="list-container">

<?php while($d = mysqli_fetch_assoc($q)) { ?>

    <?php 
    // Tentukan badge kategori
    $kat = strtolower($d['kategori']);
    $badgeClass = "badge-info";
    if ($kat == "pembayaran") $badgeClass = "badge-pembayaran";
    if ($kat == "nilai")       $badgeClass = "badge-nilai";
    ?>

    <a href="detail.php?id=<?= $d['id']?>" class="card-link">
        <div class="card">

            <span class="badge <?= $badgeClass ?>">
                <?= htmlspecialchars($d['kategori']) ?>
            </span>

            <h3 class="card-title"><?= htmlspecialchars($d['judul']) ?></h3>

            <div class="card-date">
                <?= tanggal_indo($d['tanggal']) ?>
            </div>

            <p class="card-preview">
                <?= substr(strip_tags($d['isi']), 0, 70) ?>...
            </p>

        </div>
    </a>

<?php } ?>

</div>

</body>
</html>
