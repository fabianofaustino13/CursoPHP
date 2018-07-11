<?php

class Cliente {

    private $nome;
    private $cpf;
    private $email;

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getNome() {
        return $this->nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getEmail() {
        return $this->email;
    }
}

?>