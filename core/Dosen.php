<?php
require_once "User.php";

class Dosen extends User {
    private $nidn;

    public function __construct($nama, $email, $nidn) {
        parent::__construct($nama, $email);
        $this->nidn = $nidn;
    }

    public function getRole() {
        return "Dosen";
    }

    public function getNidn() {
        return $this->nidn;
    }
}