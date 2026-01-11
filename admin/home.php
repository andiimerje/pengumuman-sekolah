<?php
session_start();

// Cek login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f2f2f2;
    font-family: 'Poppins', sans-serif;
}

.dashboard {
    max-width: 900px;
    margin: 40px auto;
}

.card-menu {
    padding: 25px;
    text-align: center;
    border-radius: 15px;
    transition: .2s;
}

.card-menu:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

a {
    text-decoration: none;
}
</style>
</head>

<body>

<div class="dashboard">
    <h2 class="text-center mb-4">📊 Dashboard Admin</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="tambah.php">
                <div class="card bg-warning card-menu">
                    <h4>➕ Tambah Pengumuman</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="pengumuman.php">
                <div class="card bg-primary text-white card-menu">
                    <h4>📃 Kelola Pengumuman</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="logout.php">
                <div class="card bg-danger text-white card-menu">
                    <h4>🚪 Logout</h4>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>
