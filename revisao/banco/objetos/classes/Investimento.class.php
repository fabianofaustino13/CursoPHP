<?php
    
    require_once 'Conta.class.php';
    
    abstract class Investimento extends Conta {
        
        private $rendimento;

        public function setRendimento($rendimento) {
            $this->rendimento = $rendimento;
        }
        
        public function getRendimento() {
            return $this->rendimento;
        }

       // public abstract function rende();

        public function saca($valor) {
            if (is_numeric($valor) && $valor > 0 && $valor <= parent::getSaldo()) {
                $novoSaldo = parent::getSaldo() - $valor;
                parent::setSaldo($novoSaldo);
                return true;
            }
            return false;
        }

        public function rende() {
            $novoSaldo = parent::getSaldo() * (1 + $this->getPercentual());
            parent::setSaldo($novoSaldo);
        }

        public abstract function getPercentual();

    }
?>