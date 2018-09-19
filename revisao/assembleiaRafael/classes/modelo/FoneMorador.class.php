<?php
require_once(__DIR__ . "/./Morador.class.php");

class FoneMorador {
    private $morador;
    private $fone;

    public function __construct() {
        $this->morador = new Morador();
    }

    public function getMorador() {
        return $this->morador;
    }
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }

    public function getFone() {
        return $this->fone;
    }
    public function setFone($fone) {
        $this->fone = $fone;
    }
}