<?php
require_once(__DIR__ . "/./Dependente.class.php");

class EmailDependente {
    private $dependente;
    private $email;

    public function __construct() {
        $this->dependente = new Dependente();
    }

    public function getDependente() {
        return $this->dependente;
    }
    public function setDependente(Dependente $dependente) {
        $this->dependente = $dependente;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
}