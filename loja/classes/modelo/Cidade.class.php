<?php

require_once(__DIR__ . "/./Estado.class.php");

class Cidade {

    private $id;
    private $nome;
    private $estado;

    public function __construct() {
        $this->estado = new Estado();
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = strtoupper($nome);
    }

    public function getEstado() {
        return $this->estado;
    }
    
    public function setEstado(Estado $estado) {
        $this->estado = $estado;
    }
}