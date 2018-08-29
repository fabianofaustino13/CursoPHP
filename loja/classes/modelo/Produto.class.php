<?php

require_once(__DIR__ . "/./Marca.class.php");
require_once(__DIR__ . "/./Departamento.class.php");

class Produto {

    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $qntMinima;
    private $qntEstoque;
    private $marca;
    private $departamento;

    public function __construct() {
        $this->marca = new Marca();
        $this->departamento = new Departamento();
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

    public function getPrecoFormatado() {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }
    
    public function getPreco() {
        return $this->preco;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = strtoupper($descricao);
    }

    public function getQntMinima() {
        return $this->qntMinima;
    }
    
    public function setQntMinima($qntMinima) {
        $this->qntMinima = $qntMinima;
    }

    public function getQntEstoque() {
        return $this->qntEstoque;
    }
    
    public function setQntEstoque($qntEstoque) {
        $this->qntEstoque = $qntEstoque;
    }

    public function getMarca() {
        return $this->marca;
    }
    
    public function setMarca(Marca $marca) {
        $this->marca = $marca;
    }

    public function getDepartamento() {
        return $this->departamento;
    }
    
    public function setDepartamento(Departamento $departamento) {
        $this->departamento = $departamento;
    }
}