<?php

class Assembleia {

    private $id;
    private $nome;
    private $data;
    private $fkTda;

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

    public function getData() {
        return $this->data;
    }
    
    public function setData($data) {
        $this->data = $data;
    }

    public function getFkTda() {
        return $this->fkTda;
    }
    
    public function setFkTda($fkTda) {
        $this->fkTda = $fkTda;
    }
}