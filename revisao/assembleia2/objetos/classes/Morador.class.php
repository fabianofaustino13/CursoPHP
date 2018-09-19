<?php

class Morador {

    private $nomeMorador;
    private $cpf;
    private $email;

    public function setNomeMorador($nomeMorador) {
        $this->nomeMorador = $nomeMorador;
    }

    public function getNomeMorador() {
        return $this->nomeMorador;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
}

?>