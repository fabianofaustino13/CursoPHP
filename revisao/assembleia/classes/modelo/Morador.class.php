<?php

// require_once 'Apartamento.class.php';

class Morador {

    private $id;
    private $nome;
    private $login;
    private $senha;
    private $ultimoAcesso;
    private $foto;
    // private $sindico;
    private $apartamento;

    // public function __construct() {
    //     $this->apartamento = new Apartamento();
    // }
   
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

    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getUltimoAcesso() {
        return $this->ultimoAcesso;
    }
    
    public function setUltimoAcesso($ultimoAcesso) {
        $this->ultimoAcesso = $ultimoAcesso;
    }

    public function getFoto() {
        return $this->foto;
    }
    
    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // public function getSindico() {
    //     return $this->sindico;
    // }
    
    // public function setSindico($sindico) {
    //     $this->sindico = $sindico;
    // }

    // public function getApartamento() {
    //     return $this->apartamento;
    // }
    
    // public function setApartamento(Apartamento $apartamento) {
    //     $this->apartamento = $apartamento;
    // }
}