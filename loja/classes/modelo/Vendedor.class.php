<?php

require_once(__DIR__ . "/./Sexo.class.php");

class Vendedor {

    private $id;
    private $nome;
    private $cpf;
    private $matricula;
    private $sexo;

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

    public function getCpf() {
        return $this->cpf;
    }
    
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getMatricula() {
        return $this->matricula;
    }
    
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getSexo() {
        return $this->sexo;
    }
    
    public function setSexo(Sexo $sexo) {
        $this->sexo = $sexo;
    }

}