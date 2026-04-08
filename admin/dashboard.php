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
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #f4f6f9;
}

/* Navbar */
.navbar {
    height: 55px;
    background: #0a192f;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 18px;
    font-size: 14px;
}

/* Right navbar */
.nav-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Logout button */
.logout {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 6px;
    background: rgba(255,255,255,0.1);
    color: white;
    text-decoration: none;
    font-size: 12px;
    transition: 0.25s;
}

.logout:hover {
    background: white;
    color: #0a192f;
}

/* Sidebar */
.sidebar {
    position: fixed;
    top: 60px;
    left: 12px;
    width: 55px;
    background: #0a192f;
    border-radius: 12px;
    padding: 8px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.side-item {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #cbd5e1;
    text-decoration: none;
}

.side-item:hover {
    background: rgba(255,255,255,0.08);
    color: white;
}

.side-item.active {
    background: white;
    color: #0a192f;
}

/* Main */
.main {
    margin-left: 85px;
    padding: 20px;
}

/* Grid */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
}

.card {
    background: white;
    border-radius: 10px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    text-align: center;
    position: relative;
    transition: 0.25s;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

.icon {
    font-size: 28px;
    color: #0a192f;
    margin-bottom: 6px;
}

.card a {
    position: absolute;
    inset: 0;
}

.footer {
    margin-top: 25px;
    font-size: 11px;
    color: #999;
}

.material-symbols-outlined {
    font-size: 20px;
}
</style>
</head>

<body>

<!-- Navbar -->
<div class="navbar">
    <span><strong>SIAKAD</strong></span>

    <div class="nav-right">
        <span><?= $_SESSION['nama'] ?? 'Admin'; ?></span>

        <a href="../auth/logout.php" class="logout">
            <span class="material-symbols-outlined">logout</span>
            Logout
        </a>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#" class="side-item active">
        <span class="material-symbols-outlined">dashboard</span>
    </a>

    <a href="mahasiswa.php" class="side-item">
        <span class="material-symbols-outlined">school</span>
    </a>

    <a href="matkul.php" class="side-item">
        <span class="material-symbols-outlined">menu_book</span>
    </a>
</div>

<!-- Main -->
<div class="main">

    <h2>Dashboard</h2>
    <p style="font-size:12px;color:#777;margin-bottom:20px;">
        Manajemen sistem akademik
    </p>

    <div class="grid">

        <div class="card">
            <div class="icon material-symbols-outlined">school</div>
            <h3>Mahasiswa</h3>
            <a href="mahasiswa.php"></a>
        </div>

        <div class="card">
            <div class="icon material-symbols-outlined">menu_book</div>
            <h3>Mata Kuliah</h3>
            <a href="matkul.php"></a>
        </div>

    </div>

    <div class="footer">
        © 2026 Sistem Akademik
    </div>

</div>

</body>
</html>