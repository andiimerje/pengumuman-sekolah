<?php
session_start();
include "../includes/config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$q  = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id=$id");
$d  = mysqli_fetch_assoc($q);

if(!$d){
    echo "Data tidak ditemukan";
    exit;
}

if(isset($_POST['simpan'])){

    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi_html']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $btn_text = mysqli_real_escape_string($koneksi, $_POST['btn_text']);
    $btn_link = mysqli_real_escape_string($koneksi, $_POST['btn_link']);
    $tanggal  = mysqli_real_escape_string($koneksi, $_POST['tanggal']);

    $gambar = $d['gambar'];
    if(!empty($_FILES['gambar']['name'])){
        $gambar = time()."_".$_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/".$gambar);
    }

    mysqli_query($koneksi, "
        UPDATE pengumuman SET
            judul='$judul',
            isi='$isi',
            gambar='$gambar',
            kategori='$kategori',
            btn_text='$btn_text',
            btn_link='$btn_link',
            tanggal='$tanggal'
        WHERE id=$id
    ");

    header("Location: pengumuman.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengumuman</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- QUILL CDN -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
form{ padding:15px; }
input, select{
    width:100%; padding:10px; margin-bottom:12px;
    border-radius:8px; border:1px solid #ccc;
}
#editor{
    background:white; height:200px;
    border-radius:8px;
}
button{
    padding:11px 18px; background:#2980b9; 
    border:none; border-radius:8px;
    color:white; font-weight:bold;
}
</style>
</head>

<body>

<h2 style="padding-left:15px;">Edit Pengumuman</h2>

<form method="post" enctype="multipart/form-data">

    <label>Judul</label>
    <input name="judul" value="<?= htmlspecialchars($d['judul']) ?>" required>

    <!-- TANGGAL POSTING -->
    <label>Tanggal Posting</label>
    <input type="datetime-local" name="tanggal"
value="<?= date('Y-m-d\TH:i', strtotime($d['tanggal'])) ?>" required>


    <!-- EDITOR -->
    <label>Isi Pengumuman:</label>
    <div id="editor"><?= $d['isi'] ?></div>
    <input type="hidden" name="isi_html" id="isi_html">

    <!-- KATEGORI -->
    <label>Kategori:</label>
    <select name="kategori" required>
        <option value="pengumuman" <?= $d['kategori']=="pengumuman"?"selected":"" ?>>Pengumuman</option>
        <option value="iklan" <?= $d['kategori']=="iklan"?"selected":"" ?>>Iklan</option>
        <option value="akademik" <?= $d['kategori']=="akademik"?"selected":"" ?>>Akademik</option>
    </select>

    <!-- GAMBAR -->
    <label>Gambar Saat Ini:</label><br>
    <?php if($d['gambar']){ ?>
        <img src="../uploads/<?= $d['gambar'] ?>" width="150" style="border-radius:8px; margin-bottom:10px;"><br>
    <?php } else { ?>
        <small><i>Tidak ada gambar.</i></small><br>
    <?php } ?>

    <label>Ganti Gambar (opsional):</label>
    <input type="file" name="gambar" accept="image/*">

    <!-- BUTTON -->
    <label>Button Text (Opsional):</label>
    <input name="btn_text" value="<?= htmlspecialchars($d['btn_text']) ?>">

    <label>Button Link (Opsional):</label>
    <input name="btn_link" value="<?= htmlspecialchars($d['btn_link']) ?>">

    <button name="simpan">Simpan Perubahan</button>
</form>

<!-- QUILL SCRIPT -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
var toolbarOptions = [
  ['bold', 'italic', 'underline'],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'align': [] }],
  ['clean']
];

var quill = new Quill('#editor', {
    theme: 'snow',
    modules: { toolbar: toolbarOptions }
});

// Submit → simpan HTML
document.querySelector("form").onsubmit = function(){
    document.querySelector("#isi_html").value = quill.root.innerHTML;
};
</script>

</body>
</html>
