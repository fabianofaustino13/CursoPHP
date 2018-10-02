<?php
//Difinir se o morador está ativo ou inativo
//Ativo: Apartamento com morador
//Inativo: Apartamento sem morador

class Situacao {

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