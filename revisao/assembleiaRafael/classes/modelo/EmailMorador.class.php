<?php
require_once(__DIR__ . "/./Morador.class.php");

class EmailMorador {
    private $morador;
    private $email;

    public function __construct() {
        $this->morador = new Morador();
    }

    public function getMorador() {
        return $this->morador;
    }
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
}