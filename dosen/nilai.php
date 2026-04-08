<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$fileNilai = "../data/nilai.json";
$fileMhs = "../data/mahasiswa.json";
$fileMatkul = "../data/matkul.json";

$nilai = json_decode(file_get_contents($fileNilai), true);
$mahasiswa = json_decode(file_get_contents($fileMhs), true);
$matkul = json_decode(file_get_contents($fileMatkul), true);

// TAMBAH
if (isset($_POST['simpan'])) {

    $sks = 0;
    foreach ($matkul as $m) {
        if ($m['nama'] == $_POST['matkul']) {
            $sks = $m['sks'];
        }
    }

    $nilai[] = [
        "nim" => $_POST['nim'],
        "nama_matkul" => $_POST['matkul'],
        "sks" => $sks,
        "nilai" => $_POST['nilai']
    ];

    file_put_contents($fileNilai, json_encode($nilai, JSON_PRETTY_PRINT));
    header("Location: nilai.php");
}

// HAPUS
if (isset($_GET['hapus'])) {
    unset($nilai[$_GET['hapus']]);
    $nilai = array_values($nilai);
    file_put_contents($fileNilai, json_encode($nilai, JSON_PRETTY_PRINT));
    header("Location: nilai.php");
}

// EDIT AMBIL
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $nilai[$_GET['edit']];
    $editIndex = $_GET['edit'];
}

// UPDATE
if (isset($_POST['update'])) {

    $sks = 0;
    foreach ($matkul as $m) {
        if ($m['nama'] == $_POST['matkul']) {
            $sks = $m['sks'];
        }
    }

    $nilai[$_POST['index']] = [
        "nim" => $_POST['nim'],
        "nama_matkul" => $_POST['matkul'],
        "sks" => $sks,
        "nilai" => $_POST['nilai']
    ];

    file_put_contents($fileNilai, json_encode($nilai, JSON_PRETTY_PRINT));
    header("Location: nilai.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Input Nilai</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}
body{background:#f4f6f9;padding:20px;}
.container{max-width:1000px;margin:auto;}

h2{color:#0a192f;margin-bottom:15px;}

.card{
    background:white;
    padding:18px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    margin-bottom:15px;
}

.form-row{display:flex;gap:10px;flex-wrap:wrap;}

select,input{
    flex:1;
    padding:8px;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    padding:8px 14px;
    background:#0a192f;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

button:hover{background:#112240;}

.search input{width:100%;margin-bottom:10px;}

table{width:100%;border-collapse:collapse;font-size:13px;}
thead{background:#0a192f;color:white;}
th,td{padding:10px;text-align:center;}

tbody tr:hover{background:#f1f5f9;}

/* BADGE */
.badge{
    padding:3px 8px;
    border-radius:5px;
    font-size:11px;
}

.sks{background:#e6f0ff;color:#0a192f;}

/* NILAI WARNA */
.nilai-hijau{
    background:#e8fff0;
    color:#0a7f3f;
}

.nilai-merah{
    background:#ffe6e6;
    color:#cc0000;
}

/* ACTION */
.action a{
    font-size:12px;
    padding:5px 8px;
    border-radius:5px;
    text-decoration:none;
    margin:0 2px;
}

.edit{background:#e6f0ff;color:#0a192f;}
.hapus{background:#ffe6e6;color:#cc0000;}

.footer{text-align:center;font-size:11px;color:#aaa;margin-top:15px;}
</style>
</head>

<body>

<div class="container">

<h2>Input Nilai</h2>

<!-- FORM -->
<div class="card">
<form method="POST">
<div class="form-row">

<select name="nim">
<?php foreach ($mahasiswa as $m): ?>
<option value="<?= $m['nim'] ?>"
<?= ($editData && $editData['nim']==$m['nim'])?'selected':'' ?>>
<?= $m['nim'] ?> - <?= $m['nama'] ?>
</option>
<?php endforeach; ?>
</select>

<select name="matkul">
<?php foreach ($matkul as $mk): ?>
<option value="<?= $mk['nama'] ?>"
<?= ($editData && $editData['nama_matkul']==$mk['nama'])?'selected':'' ?>>
<?= $mk['nama'] ?>
</option>
<?php endforeach; ?>
</select>

<input type="number" name="nilai" placeholder="Nilai"
value="<?= $editData['nilai'] ?? '' ?>" required>

<?php if ($editData): ?>
<input type="hidden" name="index" value="<?= $editIndex ?>">
<button name="update">Update</button>
<?php else: ?>
<button name="simpan">Simpan</button>
<?php endif; ?>

</div>
</form>
</div>

<!-- SEARCH -->
<div class="search">
<input type="text" id="search" placeholder="Cari data nilai...">
</div>

<!-- TABLE -->
<div class="card">
<table id="table">

<thead>
<tr>
<th>NIM</th>
<th>Mata Kuliah</th>
<th>SKS</th>
<th>Nilai</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php foreach ($nilai as $i => $n): ?>
<tr>
<td><?= $n['nim'] ?></td>
<td><?= $n['nama_matkul'] ?></td>
<td><span class="badge sks"><?= $n['sks'] ?></span></td>

<td>
<span class="badge <?= $n['nilai'] >= 80 ? 'nilai-hijau' : 'nilai-merah' ?>">
<?= $n['nilai'] ?>
</span>
</td>

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