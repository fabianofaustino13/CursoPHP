<?php
    
    require_once 'Investimento.class.php';
    
    class Poupanca extends Investimento {

        public function setRende($valor) {
            $novoSaldo = parent::getSaldo() + $valor;
            return $novoSaldo;
        }
    }
?>