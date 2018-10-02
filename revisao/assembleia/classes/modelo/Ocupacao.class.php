<?php
//Difinir se o apartamento está livre ou ocupado
//Ocupado: Apartamento com morador
//Livre: Apartamento sem morador

class Ocupacao {

    private $id;
    private $nome;
    
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
}