<?php
    
    require_once 'Investimento.class.php';
    
    class Poupanca extends Investimento {

        public function setRende($valor) {
            $novoSaldo = parent::getSaldo() + (($valor * parent::getSaldo())/100);
            parent::setSaldo($novoSaldo);
            //return $novoSaldo;
        }
    }
?>