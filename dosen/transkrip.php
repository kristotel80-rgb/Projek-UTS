<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$fileNilai = "../data/nilai.json";
$fileMhs = "../data/mahasiswa.json";

$nilai = json_decode(file_get_contents($fileNilai), true);
$mahasiswa = json_decode(file_get_contents($fileMhs), true);

// fungsi grade
function getGrade($nilai){
    if($nilai >= 85) return ["A",4];
    if($nilai >= 75) return ["B",3];
    if($nilai >= 65) return ["C",2];
    if($nilai >= 50) return ["D",1];
    return ["E",0];
}

// ambil mahasiswa yang dipilih
$selected = $_GET['nim'] ?? null;
$dataTranskrip = [];
$total_sks = 0;
$total_bobot = 0;

if ($selected) {
    foreach ($nilai as $n) {
        if ($n['nim'] == $selected) {
            list($grade,$bobot) = getGrade($n['nilai']);

            $n['grade'] = $grade;
            $n['bobot'] = $bobot;

            $total_sks += $n['sks'];
            $total_bobot += ($bobot * $n['sks']);

            $dataTranskrip[] = $n;
        }
    }
}

$ipk = $total_sks > 0 ? $total_bobot / $total_sks : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Transkrip Nilai</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {font-family:'Segoe UI'; background:#f4f6f9; padding:20px;}
.container {max-width:1000px;margin:auto;}

h2 {color:#0a192f;margin-bottom:15px;}

.card {
    background:white;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    border:1px solid #eee;
}

/* SELECT */
select {
    width:100%;
    padding:8px;
    border-radius:6px;
    border:1px solid #ccc;
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

th,td {
    padding:10px;
    text-align:center;
}

tbody tr:hover {
    background:#f1f5f9;
}

/* BADGE */
.badge {
    padding:3px 8px;
    border-radius:5px;
    font-size:11px;
}

.gradeA{background:#d1fae5;color:#065f46;}
.gradeB{background:#e0f2fe;color:#0369a1;}
.gradeC{background:#fef9c3;color:#854d0e;}
.gradeD{background:#ffe4e6;color:#9f1239;}
.gradeE{background:#eee;color:#333;}

.ipk {
    background:#0a192f;
    color:white;
}

/* SUMMARY */
.summary {
    display:flex;
    justify-content:space-between;
    margin-top:10px;
    font-size:13px;
}

</style>
</head>

<body>

<div class="container">

<h2>Transkrip Nilai Mahasiswa</h2>

<!-- PILIH MAHASISWA -->
<div class="card">
<form method="GET">
<select name="nim" onchange="this.form.submit()">
<option value="">-- Pilih Mahasiswa --</option>

<?php foreach ($mahasiswa as $m): ?>
<option value="<?= $m['nim'] ?>" <?= ($selected == $m['nim']) ? 'selected' : '' ?>>
<?= $m['nim'] ?> - <?= $m['nama'] ?>
</option>
<?php endforeach; ?>

</select>
</form>
</div>

<?php if ($selected): ?>

<!-- TRANSKRIP -->
<div class="card">
<table>
<thead>
<tr>
<th>Mata Kuliah</th>
<th>SKS</th>
<th>Nilai</th>
<th>Grade</th>
<th>Bobot</th>
</tr>
</thead>

<tbody>
<?php foreach ($dataTranskrip as $d): ?>
<tr>
<td><?= $d['nama_matkul'] ?></td>
<td><?= $d['sks'] ?></td>
<td><?= $d['nilai'] ?></td>
<td><span class="badge grade<?= $d['grade'] ?>"><?= $d['grade'] ?></span></td>
<td><?= $d['bobot'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="summary">
<div>Total SKS: <strong><?= $total_sks ?></strong></div>
<div>IPK: <span class="badge ipk"><?= number_format($ipk,2) ?></span></div>
</div>

</div>

<?php endif; ?>

</div>

</body>
</html>