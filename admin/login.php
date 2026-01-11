<?php
session_start();
include "../includes/config.php";

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ambil data admin berdasarkan username
    $query = mysqli_query($koneksi, 
        "SELECT * FROM admin WHERE username='$username' LIMIT 1"
    );

    $data = mysqli_fetch_assoc($query);

    // Cek password (TIDAK HASH)
    if ($data && $password == $data['password']) {

        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];

        header("Location: home.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>




<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-box {
        background: white;
        width: 330px;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0,0,0,0.15);
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .login-box input {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    .login-box button {
        width: 100%;
        background: #4A90E2;
        border: none;
        padding: 12px;
        margin-top: 10px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
        transition: 0.3s;
    }

    .login-box button:hover {
        background: #3b7ac2;
    }

    .error {
        background: #ffdddd;
        padding: 10px;
        border-left: 4px solid #ff4444;
        margin-top: 10px;
        border-radius: 5px;
        color: #cc0000;
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <form method="post">
        <input name="username" type="text" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <button name="login">Masuk</button>
    </form>

    <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
</div>

</body>
</html>
