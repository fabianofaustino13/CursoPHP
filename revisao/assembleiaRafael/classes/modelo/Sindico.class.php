<?php

require_once('Morador.class.php');

class Sindico {

    private $id;
    private $data_inicio;
    private $data_fim;
    private $morador;
   
    public function __construct() {
        $this->morador = new Morador();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getDataInicio() {
        return $this->data_inicio;
    }
    
    public function setDataInicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    public function getDataFim() {
        return $this->data_fim;
    }
    
    public function setDataFim($data_fim) {
        $this->data_fim = $data_fim;
    }

    public function getMorador() {
        return $this->morador;
    }
    
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }
}