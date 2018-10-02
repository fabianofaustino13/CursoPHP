<?php

require_once("Perfil.class.php");
require_once("Sindico.class.php");
require_once("Situacao.class.php");
// require_once("Apartamento.class.php");
class Morador {

    private $id; //id do morador - gerado automaticamente
    private $nome; //nome do morador
    private $cpf; //cpf do morador
    private $login; //login do morador
    private $senha; //senha do morador
    private $situacao; //se o morador está ativo - Ativo (Apartamento com morador) - Inativo (Apartamento sem morador)
    private $perfil; //perfil do morador - USUÁRIO, SÍNDICO, ADMINISTRADOR OU ROOT
    // private $apartamento; //associar um moradar em um apartamento
    
    public function __construct() {
        $this->perfil = new Perfil();
        $this->situacao = new Situacao(); //Saber se o morador está ativo ou não.
        // $this->apartamento = new Apartamento();
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
     
    public function getSituacao() {
        return $this->situacao;
    }
    
    public function setSituacao(Situacao $situacao) {
        $this->situacao = $situacao;
    }

    public function getPerfil() {
        return $this->perfil;
    }
    
    public function setPerfil(Perfil $perfil) {
        $this->perfil = $perfil;
    }

    // public function getApartamento() {
    //     return $this->apartamento;
    // }
    
    // public function setApartamento(Apartamento $apartamento) {
    //     $this->apartamento = $apartamento;
    // }
}