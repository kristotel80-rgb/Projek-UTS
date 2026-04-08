<?php

$dataFile = "../data/matkul.json";
$matkul = json_decode(file_get_contents($dataFile), true);

// TAMBAH
if (isset($_POST['tambah'])) {
    $matkul[] = [
        "kode" => $_POST['kode'],
        "nama" => $_POST['nama'],
        "sks" => $_POST['sks']
    ];
    file_put_contents($dataFile, json_encode($matkul, JSON_PRETTY_PRINT));
    header("Location: matkul.php");
}

// HAPUS
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($matkul[$index]);
    $matkul = array_values($matkul);
    file_put_contents($dataFile, json_encode($matkul, JSON_PRETTY_PRINT));
    header("Location: matkul.php");
}

// EDIT AMBIL
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $matkul[$_GET['edit']];
    $editIndex = $_GET['edit'];
}

// UPDATE
if (isset($_POST['update'])) {
    $matkul[$_POST['index']] = [
        "kode" => $_POST['kode'],
        "nama" => $_POST['nama'],
        "sks" => $_POST['sks']
    ];
    file_put_contents($dataFile, json_encode($matkul, JSON_PRETTY_PRINT));
    header("Location: matkul.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Mata Kuliah</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}
body{background:#f4f6f9;padding:20px;}
.container{max-width:950px;margin:auto;}

.header{display:flex;justify-content:space-between;margin-bottom:15px;}
.header h2{color:#0a192f;font-size:18px;}
.counter{font-size:12px;color:#666;}

.card{background:white;padding:15px;border-radius:10px;margin-bottom:15px;border:1px solid #e5e7eb;}

.form-row{display:flex;gap:10px;}
input{flex:1;padding:8px;border-radius:6px;border:1px solid #ccc;font-size:13px;}
input:focus{border-color:#0a192f;outline:none;}

button{
    padding:8px 12px;
    border:none;
    border-radius:6px;
    background:#0a192f;
    color:white;
    cursor:pointer;
    font-size:13px;
}
button:hover{background:#112240;}

.search input{width:100%;margin-bottom:10px;}

table{width:100%;border-collapse:collapse;font-size:13px;}
thead{background:#0a192f;color:white;}
th,td{padding:10px;text-align:center;}

tbody tr{border-bottom:1px solid #eee;}
tbody tr:hover{background:#f1f5f9;}

.sks{
    background:#e6f0ff;
    color:#0a192f;
    padding:3px 8px;
    border-radius:5px;
    font-size:11px;
}

/* ACTION */
.action a{
    font-size:12px;
    padding:5px 8px;
    border-radius:5px;
    text-decoration:none;
    margin:0 2px;
}

.edit{
    background:#e6f0ff;
    color:#0a192f;
}

.hapus{
    background:#ffe6e6;
    color:#cc0000;
}

.edit:hover{background:#d6e6ff;}
.hapus:hover{background:#ffd6d6;}

.footer{text-align:center;font-size:11px;color:#aaa;margin-top:10px;}
</style>
</head>

<body>

<div class="container">

<div class="header">
    <h2>Manajemen Mata Kuliah</h2>
    <div class="counter"><?= count($matkul) ?> data</div>
</div>

<!-- FORM -->
<div class="card">
<form method="POST">
<div class="form-row">

    <input type="text" name="kode" id="kode" placeholder="Kode Matkul"
        value="<?= $editData['kode'] ?? '' ?>" required>

    <input type="text" name="nama" placeholder="Nama Mata Kuliah"
        value="<?= $editData['nama'] ?? '' ?>" required>

    <input type="number" name="sks" placeholder="SKS"
        value="<?= $editData['sks'] ?? '' ?>" required>

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
<input type="text" id="search" placeholder="Cari mata kuliah...">
</div>

<!-- TABLE -->
<div class="card">
<table id="table">

<thead>
<tr>
    <th>Kode</th>
    <th>Nama</th>
    <th>SKS</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php foreach ($matkul as $i => $m): ?>
<tr>
    <td><?= $m['kode'] ?></td>
    <td><?= $m['nama'] ?></td>
    <td><span class="sks"><?= $m['sks'] ?></span></td>
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

// AUTO UPPERCASE
document.getElementById("kode").addEventListener("input", function() {
    this.value = this.value.toUpperCase();
});
</script>

</body>
</html>