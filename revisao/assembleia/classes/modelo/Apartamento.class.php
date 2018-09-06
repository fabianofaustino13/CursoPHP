<?php

require_once 'Adimplente.class.php';
require_once 'Bloco.class.php';
require_once 'Morador.class.php';

class Apartamento {

    private $id;
    private $nome;
    private $adimplente;
    private $bloco;
    private $morador;
   
    public function __construct() {
        $this->adimplente = new Adimplente();
        $this->bloco = new Bloco();
        $this->morador = new Morador();
    }

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

    public function getAdimplente() {
        return $this->adimplente;
    }
    
    public function setAdimplente(Adimplente $adimplente) {
        $this->adimplente = $adimplente;
    }

    public function getBloco() {
        return $this->bloco;
    }
    
    public function setBloco(Bloco $bloco) {
        $this->bloco = $bloco;
    }

    public function getMorador() {
        return $this->morador;
    }
    
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }
}