<?php

class Bloco {

    private $id;
    private $nome;
    private $apelido;
   
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

    public function getApelido() {
        return $this->apelido;
    }
    
    public function setApelido($apelido) {
        $this->apelido = strtoupper($apelido);
    }
}