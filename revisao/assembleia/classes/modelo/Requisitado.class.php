<?php

require_once('Adimplente.class.php');
require_once('Bloco.class.php');
require_once('Morador.class.php');
require_once('Apartamento.class.php');

class Requisitado {

    private $id;
    // private $nome;
    // private $adimplente;
    // private $bloco;
    private $apartamento;
    private $morador;
   
    public function __construct() {
        // $this->adimplente = new Adimplente();
        // $this->bloco = new Bloco();
        $this->apartamento = new Apartamento();
        $this->morador = new Morador();
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    // public function getAdimplente() {
    //     return $this->adimplente;
    // }
    
    // public function setAdimplente(Adimplente $adimplente) {
    //     $this->adimplente = $adimplente;
    // }

    // public function getBloco() {
    //     return $this->bloco;
    // }
    
    // public function setBloco(Bloco $bloco) {
    //     $this->bloco = $bloco;
    // }
    public function getApartamento() {
        return $this->apartamento;
    }
    
    public function setApartamento(Apartamento $apartamento) {
        $this->apartamento = $apartamento;
    }

    public function getMorador() {
        return $this->morador;
    }
    
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }

}