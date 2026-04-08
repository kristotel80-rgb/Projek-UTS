<?php
require_once "User.php";

class Mahasiswa extends User {
    private $nim;
    private $nilai = [];

    public function __construct($nama, $email, $nim) {
        parent::__construct($nama, $email);
        $this->nim = $nim;
    }

    public function getRole() {
        return "Mahasiswa";
    }

    public function getNim() {
        return $this->nim;
    }

    public function setNilai($nilai) {
        $this->nilai = $nilai;
    }

    public function getNilai() {
        return $this->nilai;
    }
}