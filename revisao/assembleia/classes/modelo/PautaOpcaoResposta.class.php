<?php

require_once('Morador.class.php');
require_once('Pauta.class.php');
require_once('OpcaoResposta.class.php');

class PautaOpcaoResposta {

    //private $id;
    private $morador;
    private $pauta;
    private $opcaoResposta;    

    public function __construct() {
        $this->morador = new Morador();
        $this->pauta = new Pauta();
        $this->opcaoResposta = new OpcaoResposta();
    }
 
    public function getMorador() {
        return $this->morador;
    }
    
    public function setMorador(Morador $morador) {
        $this->morador = $morador;
    }

    public function getPauta() {
        return $this->pauta;
    }
    
    public function setPauta(Pauta $pauta) {
        $this->pauta = $pauta;
    }

    public function getOpcaoResposta() {
        return $this->opcaoResposta;
    }
    
    public function setOpcaoResposta(OpcaoResposta $opcaoResposta) {
        $this->opcaoResposta = $opcaoResposta;
    }
}