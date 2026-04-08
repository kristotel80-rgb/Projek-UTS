<?php
require_once "CetakLaporan.php";

class CetakKHS implements CetakLaporan {

    private $nama;
    private $nim;
    private $dataNilai;
    private $ipk;

    public function __construct($nama, $nim, $dataNilai, $ipk) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->dataNilai = $dataNilai;
        $this->ipk = $ipk;
    }

    public function cetak() {
        echo "<h2>Kartu Hasil Studi (KHS)</h2>";
        echo "Nama: " . $this->nama . "<br>";
        echo "NIM: " . $this->nim . "<br><br>";

        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Mata Kuliah</th><th>SKS</th><th>Nilai</th></tr>";

        foreach ($this->dataNilai as $n) {
            echo "<tr>
                    <td>{$n['nama_matkul']}</td>
                    <td>{$n['sks']}</td>
                    <td>{$n['nilai']}</td>
                  </tr>";
        }

        echo "</table>";
        echo "<br><strong>IPK: {$this->ipk}</strong>";
    }
}