<?php
session_start();
include "../includes/config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi_html']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $btn_text = mysqli_real_escape_string($koneksi, $_POST['btn_text']);
    $btn_link = mysqli_real_escape_string($koneksi, $_POST['btn_link']);

    // Upload gambar
    $gambar = "";
    if(!empty($_FILES['gambar']['name'])){
        $gambar = time()."_".$_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/".$gambar);
    }

    mysqli_query($koneksi, "
        INSERT INTO pengumuman 
        (judul, isi, gambar, kategori, btn_text, btn_link)
        VALUES
        ('$judul','$isi','$gambar','$kategori','$btn_text','$btn_link')
    ");

    header("Location: pengumuman.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Pengumuman</title>
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
    padding:11px 18px; background:#27ae60; /* hijau */
    border:none; border-radius:8px;
    color:white; font-weight:bold;
}
</style>
</head>

<body>

<h2 style="padding-left:15px;">Tambah Pengumuman</h2>

<form method="post" enctype="multipart/form-data">

    <input name="judul" placeholder="Judul Pengumuman" required>

    <!-- EDITOR -->
    <label>Isi Pengumuman:</label>
    <div id="editor"></div>
    <input type="hidden" name="isi_html" id="isi_html">

    <!-- KATEGORI -->
    <label>Kategori:</label>
    <select name="kategori" required>
        <option value="pengumuman">Pengumuman</option>
        <option value="iklan">Iklan</option>
        <option value="akademik">Akademik</option>
    </select>

    <!-- GAMBAR OPSIONAL -->
    <label>Upload Gambar (opsional):</label>
    <input type="file" name="gambar" accept="image/*">

    <!-- BUTTON KHUSUS -->
    <label>Button Text (Opsional):</label>
    <input name="btn_text" placeholder="Contoh: AMBIL TANTANGAN">

    <label>Button Link (Opsional):</label>
    <input name="btn_link" placeholder="https://contoh.com/halaman">

    <button name="simpan">Simpan</button>
</form>

<!-- QUILL SCRIPT -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
// Toolbar lengkap
var toolbarOptions = [
  ['undo', 'redo'],
  ['bold', 'italic', 'underline', 'strike'],
  [{ 'size': ['small', false, 'large', 'huge'] }],
  [{ 'align': [] }],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'indent': '-1'}, { 'indent': '+1' }],
  ['clean']
];

// Inisialisasi Editor
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: { toolbar: toolbarOptions }
});

// Submit form → simpan HTML
document.querySelector("form").onsubmit = function(){
    document.querySelector("#isi_html").value = quill.root.innerHTML;
};
</script>

</body>
</html>
