<?php
require_once(__DIR__ . "/./Morador.class.php");
require_once(__DIR__ . "/./Dependente.class.php");

class DepMorador {
    private $dependente;
    private $morador;

    public function __construct() {
        $this->dependente = new Dependente();
        $this->morador = new Morador();
    }

    public function getDependente() {
        return $this->dependente;
    }
    public function setDependente(Dependente $dependente) {
        $this->dependente = $dependente;
    }

    public function getMorador() {
        return $this->morador;
    }
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }
}