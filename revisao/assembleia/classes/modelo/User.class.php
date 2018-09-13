<?php

class User {
    private $login;
    private $senha;
    
    
    public function __construct($login, $senha) {
        $this->setLogin($login);
        $this->setSenha($senha);
    }
    public function setLogin($login) {
        $this->login = strtoupper($login);
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function logar($login, $senha) {
        if ($this->login == $login && $this->senha == $senha) {
            return true;
        }
        return false;
    }
}