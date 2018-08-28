<?php

require_once 'TipoAssembleia.class.php';

class Assembleia {

    private $id;
    private $nome;
    private $data;
    private $tipoAssembleia;

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

    public function getData() {
        return $this->data;
    }
    
    public function setData($data) {
        $this->data = $data;
    }

    public function getTipoAssembleia() {
        return $this->tipoAssembleia;
    }
    
    public function setTipoAssembleia($tipoAssembleia) {
        $this->tipoAssembleia = $tipoAssembleia;
    }
}