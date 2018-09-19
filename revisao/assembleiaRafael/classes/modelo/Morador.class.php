<?php

require_once "Perfil.class.php";
class Morador {

    private $id;
    private $nome;
    private $cpf;
    private $login;
    private $senha;
    private $status;
    private $perfil;
    
    public function __construct() {
        $this->perfil = new Perfil();
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
        // $this->senha = md5($senha);
        $this->senha = $senha;
    }

    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPerfil() {
        return $this->perfil;
    }
    
    public function setPerfil(Perfil $perfil) {
        $this->perfil = $perfil;
    }
}