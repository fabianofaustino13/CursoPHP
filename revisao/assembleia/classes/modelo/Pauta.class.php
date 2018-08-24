<?php

class Pauta {

    private $id;
    private $nome;
    private $descricao;
    private $status;
    private $voto;
    private $fkPauAss;


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

    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

    public function getVoto() {
        return $this->voto;
    }
    
    public function setVoto($voto) {
        $this->voto = $voto;
    }

    public function getFkPauAss() {
        return $this->fkPauAss;
    }
    
    public function setFkPauAss($fkPauAss) {
        $this->fkPauAss = $fkPauAss;
    }
}