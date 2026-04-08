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
    animation:pulse 3s infinite;
}

@keyframes pulse {
    0%,100% {box-shadow:0 0 0 0 rgba(10,25,47,0.3);}
    50% {box-shadow:0 0 0 6px rgba(10,25,47,0);}
}

/* CONTAINER */
.container {
    max-width:1000px;
    margin:auto;
    padding:25px;
    animation:fadeIn 0.6s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(15px);}
    to {opacity:1; transform:translateY(0);}
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
    grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
    gap:15px;
}

/* CARD */
.card {
    background:white;
    padding:16px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    position:relative;
    overflow:hidden;
    cursor:pointer;
    transition:0.3s;
}

/* Ripple */
.card::after {
    content:"";
    position:absolute;
    inset:0;
    background:radial-gradient(circle, rgba(10,25,47,0.08), transparent 70%);
    opacity:0;
    transition:0.3s;
}

.card:hover::after {
    opacity:1;
}

/* Hover */
.card:hover {
    transform:translateY(-4px) scale(1.01);
    box-shadow:0 15px 30px rgba(0,0,0,0.08);
}

/* ICON */
.icon {
    font-size:22px;
    color:#0a192f;
    margin-bottom:8px;
    transition:0.3s;
}

.card:hover .icon {
    transform:scale(1.2) rotate(3deg);
}

/* TEXT */
.card h3 {
    font-size:13px;
    color:#0a192f;
}

.card p {
    font-size:11px;
    color:#777;
}

/* LOGOUT */
.logout {
    margin-top:20px;
    display:inline-flex;
    align-items:center;
    gap:5px;
    font-size:12px;
    color:#0a192f;
    text-decoration:none;
    padding:6px 10px;
    border-radius:6px;
    border:1px solid #e5e7eb;
    transition:0.25s;
}

.logout:hover {
    background:#0a192f;
    color:white;
    transform:translateY(-1px);
}

/* FOOTER */
.footer {
    margin-top:30px;
    text-align:center;
    font-size:11px;
    color:#aaa;
}

.material-symbols-outlined {
    font-size:22px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div><strong>SIAKAD</strong></div>

    <div class="user">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['nama'],0,1)); ?>
        </div>
        <span><?= $_SESSION['nama']; ?></span>
    </div>
</div>

<div class="container">

    <div class="header">
        <h2>Dashboard Dosen</h2>
        <p>Selamat Datang</p>
    </div>

    <!-- MENU -->
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