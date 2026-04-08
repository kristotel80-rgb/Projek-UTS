<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$fileNilai = "../data/nilai.json";

$nilai = json_decode(file_get_contents($fileNilai), true);

// ambil session
$namaUser = $_SESSION['nama'];
$nimUser  = $_SESSION['nim'] ?? null;

// fungsi grade
function getGrade($nilai){
    if($nilai >= 85) return ["A",4];
    if($nilai >= 75) return ["B",3];
    if($nilai >= 65) return ["C",2];
    if($nilai >= 50) return ["D",1];
    return ["E",0];
}

// filter nilai
$dataNilai = [];
$total_sks = 0;
$total_bobot = 0;

foreach ($nilai as $n) {
    if ($n['nim'] == $nimUser) {

        list($grade,$bobot) = getGrade($n['nilai']);

        $n['grade'] = $grade;
        $n['bobot'] = $bobot;

        $total_sks += $n['sks'];
        $total_bobot += ($bobot * $n['sks']);

        $dataNilai[] = $n;
    }
}

$ipk = $total_sks > 0 ? $total_bobot / $total_sks : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>KHS Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body {
    background:#f4f6f9;
    padding:20px;
}

.container {
    max-width:900px;
    margin:auto;
}

/* CARD */
.card {
    background:white;
    padding:25px;
    border-radius:10px;
    border:1px solid #e5e7eb;
}

/* HEADER KAMPUS */
.kop {
    text-align:center;
    margin-bottom:15px;
}

.kop h3 {
    margin:0;
    color:#0a192f;
}

.kop small {
    color:#666;
}

/* INFO */
.info {
    font-size:13px;
    margin-bottom:10px;
    color:#444;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    font-size:13px;
}

thead {
    background:#0a192f;
    color:white;
}

th, td {
    padding:10px;
    text-align:center;
}

tbody tr {
    border-bottom:1px solid #eee;
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
    margin-top:15px;
    font-size:13px;
}

/* BUTTON */
.actions {
    margin-top:15px;
    display:flex;
    gap:10px;
}

.print {
    padding:8px 12px;
    background:#0a192f;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.back {
    padding:8px 12px;
    background:#ccc;
    color:#333;
    border-radius:6px;
    text-decoration:none;
}

/* PRINT MODE */
@media print {
    body {
        background:white;
        padding:0;
    }

    .actions {
        display:none;
    }

    .card {
        border:none;
        box-shadow:none;
    }
}
</style>
</head>

<body>

<div class="container">

<div class="card">

    <!-- KOP -->
    <div class="kop">
        <h3>KHS</h3>
        <small>Kartu Hasil Studi Mahasiswa</small>
    </div>

    <!-- INFO -->
    <div class="info">
        Nama: <strong><?= $namaUser ?></strong><br>
        NIM: <strong><?= $nimUser ?></strong>
    </div>

    <!-- TABLE -->
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
        <?php if(count($dataNilai) > 0): ?>
            <?php foreach ($dataNilai as $d): ?>
            <tr>
                <td><?= $d['nama_matkul'] ?></td>
                <td><?= $d['sks'] ?></td>
                <td><?= $d['nilai'] ?></td>
                <td>
                    <span class="badge grade<?= $d['grade'] ?>">
                        <?= $d['grade'] ?>
                    </span>
                </td>
                <td><?= $d['bobot'] ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Belum ada data nilai</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="summary">
        <div>Total SKS: <strong><?= $total_sks ?></strong></div>
        <div>IPK: <span class="badge ipk"><?= number_format($ipk,2) ?></span></div>
    </div>

</div>

<!-- ACTION -->
<div class="actions">
    <button onclick="printKHS()" class="print">🖨️ Cetak PDF</button>
    <a href="dashboard.php" class="back">Kembali</a>
</div>

</div>

<script>
function printKHS(){
    window.print();
}
</script>

</body>
</html>