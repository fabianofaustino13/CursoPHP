<?php
    
    require_once 'Investimento.class.php';
    
    class Acoes extends Investimento {

        private $percentual = 10 / 100;

        public function getPercentual() {
            return $this->percentual;
        }
        
        // public function rende() {
        //     $novoSaldo = parent::getSaldo() * (1 + $this->percentual);
        //     parent::setSaldo($novoSaldo);
        // }

        // public function setRende($valor) {
        //     $novoSaldo = parent::getSaldo() + (($valor * parent::getSaldo())/100);
        //     parent::setSaldo($novoSaldo);
        //     //return $novoSaldo;
        // }
    }
?>