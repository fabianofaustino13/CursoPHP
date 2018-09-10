<?php

require_once(__DIR__ . "/./Sexo.class.php");
// require_once(__DIR__ . "/./Cep.class.php");

class Funcionario {

    private $matricula;
    private $nome;
    private $cpf;
    private $sexo;
    private $supervisor;
   
    public function __construct() {
        $this->sexo = new Sexo();
    }
    
    public function getMatricula() {
        return $this->matricula;
    }
    
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
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
    
    public function getSexo() {
        return $this->sexo;
    }
    
    public function setSexo(Sexo $sexo) {
        $this->sexo = $sexo;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }
    
    public function setSupervisor(Funcionario $supervisor) {
        $this->supervisor = $supervisor;
    }

}