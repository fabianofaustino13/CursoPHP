<?php

class Lampada {
    
    public $estado;
    private $potencia;

    function __construct($estado=false, $potencia=0) {
        $this->estado = $estado;
        $this->setPotencia($potencia);
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