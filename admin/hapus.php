<?php
session_start();
include "../includes/config.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);

mysqli_query($koneksi, "DELETE FROM pengumuman WHERE id=$id");

header("Location: pengumuman.php");
exit;

