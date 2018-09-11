<?php

require_once('Morador.class.php');

class Sindico {

    private $id;
    private $data_inicio;
    private $data_fim;
    private $sindico;
   
    public function __construct() {
        $this->sindico = new Morador();
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

    public function getSindico() {
        return $this->sindico;
    }
    
    public function setSindico(Morador $sindico) {
        $this->sindico = $sindico;
    }
}