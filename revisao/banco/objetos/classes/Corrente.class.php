<?php
    
    require_once 'Conta.class.php';

class Corrente extends Conta {
        
        private $limite;
        private $taxaSaque = 0.10;

        public function setLimite($limite) {
            $this->limite = $limite;
        }
        
        public function getLimite() {
            return $this->limite;
        }
        
        public function saca($valor) {
            $saldoVirtual = parent::getSaldo() + $this->limite;
            if (is_numeric($valor) && $valor > 0 && $valor <= $saldoVirtual) {
                $novoSaldo = parent::getSaldo() - $valor - $this->taxaSaque;
                parent::setSaldo($novoSaldo); 
                return true;
            }
            return false;
        }


    }
?>