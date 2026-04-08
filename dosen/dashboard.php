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
    <title>Dashboard Dosen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Icon -->
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
    background:linear-gradient(270deg,#0a192f,#112240,#0a192f);
    background-size:400% 400%;
    animation:navMove 8s ease infinite;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
    color:white;
    font-size:14px;
}

@keyframes navMove {
    0% {background-position:0%}
    50% {background-position:100%}
    100% {background-position:0%}
}

/* USER */
.user {
    display:flex;
    align-items:center;
    gap:8px;
}

/* AVATAR */
.avatar {
    width:32px;
    height:32px;
    background:#e6f0ff;
    color:#0a192f;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:bold;
}

/* CONTAINER */
.container {
    max-width:1000px;
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

/* GRID (CENTER CARD) */
.grid {
    display:flex;
    justify-content:center;
}

/* CARD */
.card {
    width:500px;
    max-width:100%;
    background:white;
    padding:30px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    cursor:pointer;
    transition:0.3s;

    /* 🔥 CENTER ISI CARD */
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
}

.card:hover {
    transform:translateY(-4px);
    box-shadow:0 12px 25px rgba(0,0,0,0.08);
}

/* ICON */
.icon {
    font-size:32px;
    color:#0a192f;
    margin-bottom:10px;
}

/* TEXT */
.card h3 {
    font-size:16px;
    color:#0a192f;
    margin-bottom:4px;
}

.card p {
    font-size:13px;
    color:#777;
}

/* LOGOUT */
.logout {
    margin-top:25px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:10px 16px;
    border-radius:10px;
    background:#0a192f; 
    color:white;      
    text-decoration:none;
    font-size:13px;
    transition:0.3s;
    border:none;

}

.logout:hover {
    background:#112240; 
    transform:translateY(-1px);
    box-shadow:0 6px 12px rgba(0,0,0,0.15);
}

/* FOOTER */
.footer {
    margin-top:30px;
    text-align:center;
    font-size:11px;
    color:#aaa;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <strong>SIAKAD</strong>

    <div class="user">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['nama'],0,1)); ?>
        </div>
        <span><?= $_SESSION['nama']; ?></span>
    </div>
</div>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2>Dashboard Dosen</h2>
        <p>Selamat Datang</p>
    </div>

    <!-- CARD -->
    <div class="grid">
        <div class="card" onclick="goTo('nilai.php')">
            <div class="icon material-symbols-outlined">edit_note</div>
            <h3>Input Nilai</h3>
            <p>Kelola dan input nilai mahasiswa</p>
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

<script>
function goTo(url){
    window.location.href = url;
}
</script>

</body>
</html>