<?php

class Lampada {
    
    public $estado;
    private $potencia;
    private $imgLigada;
    private $imgDesligada;

    function __construct($desligada, $ligada) {
        $this->estado = false;
        $this->potencia = 0;
        $this->imgDesligada = $desligada;
        $this->imgLigada = $ligada;
    }
    
    function setPotencia($potencia) {
        $this->potencia = $potencia >= 0 ? $potencia : 0;
    }

    function getPotencia() {
        return $this->potencia;
    }

    function getEstado() {
        return $this->estado;
    }

    function getImagem() {
        return $this->estado ? $this->imgLigada : $this->imgDesligada;
    }

    function liga() {
        $this->estado = true;
    }

    function desliga() {
        $this->estado = false;
    }

    function __toString() {
        return "Lampada{estado={$this->estado},potencia={$this->potencia}}";
    }
}

?>