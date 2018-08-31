<?php

require_once(__DIR__ . "/./Bairro.class.php");

class Cep {

    private $id;
    private $logradouro;
    private $bairro;

    public function __construct() {
        $this->bairro = new Bairro();
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }
    
    public function setLogradouro($logradouro) {
        $this->logradouro = strtoupper($logradouro);
    }

    public function getBairro() {
        return $this->bairro;
    }
    
    public function setBairro(Bairro $bairro) {
        $this->bairro = $bairro;
    }
}