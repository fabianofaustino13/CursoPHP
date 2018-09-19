<?php
require_once(__DIR__ . "/./Dependente.class.php");

class FoneDependente {
    private $dependente;
    private $fone;

    public function __construct() {
        $this->dependente = new Dependente();
    }

    public function getDependente() {
        return $this->dependente;
    }
    public function setDependente(Dependente $dependente) {
        $this->dependente = $dependente;
    }

    public function getFone() {
        return $this->fone;
    }
    public function setFone($fone) {
        $this->fone = $fone;
    }
}