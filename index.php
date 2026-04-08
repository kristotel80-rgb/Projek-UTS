<?php
session_start();

// kalau sudah login → redirect sesuai role
if (isset($_SESSION['login'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } elseif ($_SESSION['role'] == 'dosen') {
        header("Location: dosen/dashboard.php");
    } else {
        header("Location: mahasiswa/dashboard.php");
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIAKAD MINI</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            text-align: center;
            padding-top: 100px;
        }
        .box {
            background: white;
            padding: 30px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>SIAKAD MINI</h1>
    <p>Sistem Informasi Akademik Sederhana</p>

    <a href="auth/login.php">Login</a>
</div>

</body>
</html>