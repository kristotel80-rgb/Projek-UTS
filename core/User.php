<?php

abstract class User {
    protected $nama;
    protected $email;

    public function __construct($nama, $email) {
        $this->nama = $nama;
        $this->email = $email;
    }

    abstract public function getRole();

    public function getNama() {
        return $this->nama;
    }

    public function getEmail() {
        return $this->email;
    }
}