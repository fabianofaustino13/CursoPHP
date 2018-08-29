<?php

require_once 'Assembleia.class.php';

class Pauta {

    private $id;
    private $nome;
    private $descricao;
    private $status;
    private $voto;
    private $assembleia;


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

    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = strtoupper($descricao);
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = strtoupper($status);
    }

    public function getVoto() {
        return $this->voto;
    }
    
    public function setVoto($voto) {
        $this->voto = $voto;
    }

    public function getFkPauAss() {
        return $this->assembleia;
    }
    
    public function setFkPauAss($assembleia) {
        $this->assembleia = $assembleia;
    }
}