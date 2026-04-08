<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<style>
* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body {
    background:#f4f6f9;
}

/* NAVBAR */
.navbar {
    height:55px;
    background:#0a192f;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 20px;
    color:white;
    font-size:14px;
}

/* USER */
.user {
    display:flex;
    align-items:center;
    gap:8px;
}

.avatar {
    width:28px;
    height:28px;
    background:#e6f0ff;
    color:#0a192f;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    font-weight:bold;
}

/* CONTAINER */
.container {
    max-width:900px;
    margin:auto;
    padding:25px;
}

/* HEADER */
.header h2 {
    font-size:18px;
    color:#0a192f;
}

.header p {
    font-size:13px;
    color:#666;
    margin-bottom:20px;
}

/* GRID */
.grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(160px,1fr));
    gap:15px;
}

/* CARD */
.card {
    background:white;
    padding:16px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    text-align:center;
    position:relative;
    transition:0.25s;
    cursor:pointer;
}

.card:hover {
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,0.08);
}

/* ICON */
.icon {
    font-size:26px;
    color:#0a192f;
    margin-bottom:6px;
}

/* TEXT */
.card h3 {
    font-size:13px;
    color:#333;
}

/* FULL CLICK */
.card a {
    position:absolute;
    inset:0;
}

/* LOGOUT */
.logout {
    margin-top:20px;
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:8px 12px;
    background:#0a192f;
    color:white;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
    transition:0.25s;
}

.logout:hover {
    background:#112240;
}

/* FOOTER */
.footer {
    margin-top:25px;
    font-size:11px;
    color:#999;
    text-align:center;
}

.material-symbols-outlined {
    font-size:26px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <span><strong>SIAKAD</strong></span>

    <div class="user">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['nama'],0,1)); ?>
        </div>
        <span><?= $_SESSION['nama']; ?></span>
    </div>
</div>

<div class="container">

    <div class="header">
        <h2>Dashboard Mahasiswa</h2>
        <p>Selamat datang di sistem akademik</p>
    </div>

    <!-- MENU -->
    <div class="grid">

        <div class="card">
            <div class="icon material-symbols-outlined">description</div>
            <h3>Lihat KHS</h3>
            <a href="khs.php"></a>
        </div>

    </div>

    <!-- LOGOUT -->
    <a href="../auth/logout.php" class="logout">
        <span class="material-symbols-outlined">logout</span>
        Logout
    </a>

    <div class="footer">
        © 2026 Sistem Akademik
    </div>

</div>

</body>
</html>