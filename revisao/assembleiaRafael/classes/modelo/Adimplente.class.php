<?php

class Adimplente {

    private $id;
    private $nome;
    private $imagem;
   
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
        $this->nome = $nome;
    }

    public function getImagem() {
        return $this->imagem;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
}