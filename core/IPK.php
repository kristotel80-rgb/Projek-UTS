<?php

class IPK {

    public function hitung($dataNilai) {
        $totalBobot = 0;
        $totalSKS = 0;

        foreach ($dataNilai as $n) {
            $bobot = $this->konversiNilai($n['nilai']);
            $totalBobot += $bobot * $n['sks'];
            $totalSKS += $n['sks'];
        }

        if ($totalSKS == 0) return 0;

        return round($totalBobot / $totalSKS, 2);
    }

    private function konversiNilai($nilai) {
        if ($nilai >= 85) return 4;
        elseif ($nilai >= 75) return 3;
        elseif ($nilai >= 65) return 2;
        elseif ($nilai >= 50) return 1;
        else return 0;
    }
}