<?php

require_once(__DIR__ . "/./Sexo.class.php");
require_once(__DIR__ . "/./Cep.class.php");

class Vendedor {

    private $id;
    private $nome;
    private $cpf;
    private $matricula;
    private $logradouro;
    private $numero;
    private $complemento;
    private $dataAdmissao;
    private $dataDemissao;
    private $sexo;
    private $cep;

    public function __construct() {
        $this->sexo = new Sexo();
        $this->cep = new Cep();
        // $this->supervisor = new Vendedor();
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

    public function getLogradouro() {
        return $this->logradouro;
    }
    
    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }
    
    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }
    
    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getDataAdmissao() {
        return $this->dataAdmissao;
    }
    
    public function setDataAdmissao($dataAdmissao) {
        $this->dataAdmissao = $dataAdmissao;
    }

    public function getDataDemissao() {
        return $this->dataDemissao;
    }
    
    public function setDataDemissao($dataDemissao) {
        $this->dataDemissao = $dataDemissao;
    }

    public function getSexo() {
        return $this->sexo;
    }
    
    public function setSexo(Sexo $sexo) {
        $this->sexo = $sexo;
    }

    public function getCep() {
        return $this->cep;
    }
    
    public function setCep(Cep $cep) {
        $this->cep = $cep;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }
    
    public function setSupervisor(Vendedor $supervisor) {
        $this->supervisor = $supervisor;
    }

}