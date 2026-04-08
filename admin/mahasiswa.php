<?php

$dataFile = "../data/mahasiswa.json";
$mahasiswa = json_decode(file_get_contents($dataFile), true);

// TAMBAH
if (isset($_POST['tambah'])) {
    $mahasiswa[] = [
        "nim" => $_POST['nim'],
        "nama" => $_POST['nama']
    ];
    file_put_contents($dataFile, json_encode($mahasiswa, JSON_PRETTY_PRINT));
    header("Location: mahasiswa.php");
}

// HAPUS
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($mahasiswa[$index]);
    $mahasiswa = array_values($mahasiswa);
    file_put_contents($dataFile, json_encode($mahasiswa, JSON_PRETTY_PRINT));
    header("Location: mahasiswa.php");
}

// EDIT AMBIL
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $mahasiswa[$_GET['edit']];
    $editIndex = $_GET['edit'];
}

// UPDATE
if (isset($_POST['update'])) {
    $mahasiswa[$_POST['index']] = [
        "nim" => $_POST['nim'],
        "nama" => $_POST['nama']
    ];
    file_put_contents($dataFile, json_encode($mahasiswa, JSON_PRETTY_PRINT));
    header("Location: mahasiswa.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}

body {
    background:#f4f6f9;
    padding:20px;
}

.container {
    max-width:950px;
    margin:auto;
}

/* HEADER */
.header {
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}

.header h2 {
    color:#0a192f;
    font-size:18px;
}

.counter {
    font-size:12px;
    color:#666;
}

/* CARD */
.card {
    background:white;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    border:1px solid #e5e7eb;
}

/* FORM */
.form-row {
    display:flex;
    gap:10px;
}

input {
    flex:1;
    padding:8px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:13px;
}

input:focus {
    border-color:#0a192f;
    outline:none;
}

/* BUTTON */
button {
    padding:8px 12px;
    border:none;
    border-radius:6px;
    background:#0a192f;
    color:white;
    cursor:pointer;
    font-size:13px;
}

button:hover {
    background:#112240;
}

/* SEARCH */
.search input {
    width:100%;
    margin-bottom:10px;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

thead {
    background:#0a192f;
    color:white;
}

th, td {
    padding:10px;
    text-align:center; /* ⬅️ SEMUA JADI CENTER */
}

tbody tr {
    border-bottom:1px solid #eee;
    transition:0.2s;
}

tbody tr:hover {
    background:#f1f5f9;
}

/* ACTION */
.action a {
    font-size:12px;
    padding:5px 8px;
    border-radius:5px;
    text-decoration:none;
    margin:0 2px;
}

.edit {
    background:#e6f0ff;
    color:#0a192f;
}

.hapus {
    background:#ffe6e6;
    color:#cc0000;
}

.edit:hover {
    background:#d6e6ff;
}

.hapus:hover {
    background:#ffd6d6;
}

/* FOOTER */
.footer {
    text-align:center;
    font-size:11px;
    color:#aaa;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
    <h2>Manajemen Mahasiswa</h2>
    <div class="counter"><?= count($mahasiswa) ?> data</div>
</div>

<!-- FORM -->
<div class="card">
<form method="POST">
    <div class="form-row">

        <input type="text" name="nim" placeholder="NIM"
            value="<?= $editData['nim'] ?? '' ?>" required>

        <input type="text" name="nama" placeholder="Nama"
            value="<?= $editData['nama'] ?? '' ?>" required>

        <?php if ($editData): ?>
            <input type="hidden" name="index" value="<?= $editIndex ?>">
            <button name="update">Update</button>
        <?php else: ?>
            <button name="tambah">Tambah</button>
        <?php endif; ?>

    </div>
</form>
</div>

<!-- SEARCH -->
<div class="search">
    <input type="text" id="search" placeholder="Cari mahasiswa...">
</div>

<!-- TABLE -->
<div class="card">
<table id="table">

<thead>
<tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php foreach ($mahasiswa as $i => $m): ?>
<tr>
    <td><?= $m['nim'] ?></td>
    <td><?= $m['nama'] ?></td>
    <td class="action">
        <a href="?edit=<?= $i ?>" class="edit">Edit</a>
        <a href="?hapus=<?= $i ?>" class="hapus"
           onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
</div>

<div class="footer">© 2026 Sistem Akademik</div>

</div>

<script>
// SEARCH
document.getElementById("search").addEventListener("keyup", function() {
    let val = this.value.toLowerCase();
    document.querySelectorAll("#table tbody tr").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(val) ? "" : "none";
    });
});
</script>

</body>
</html>