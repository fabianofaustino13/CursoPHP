<?php
    
    require_once 'Conta.class.php';

class ContaCorrente extends Conta {
        
        //Contador privado para o número de contas criadas
        private static $qtdContas = 0;

        private $limite;
        //private $taxaSaque = 0.10;

        //Usando constante para taxa
        private const TAXA = 0.10;

        //Self chama a classe e não o atributo
        public function __construct() {
            self::$qtdContas++;
        }

        public function setLimite($limite) {
            $this->limite = $limite;
        }
        
        public function getLimite() {
            return $this->limite;
        }
        
        public function saca($valor) {
            //$saldoVirtual = parent::getSaldo() + $this->limite + $this->taxaSaque;
            // $saldoVirtual = parent::getSaldo() + $this->limite + self::TAXA;
            // if (is_numeric($valor) && $valor > 0 && $valor <= $saldoVirtual) {
            //     //$novoSaldo = parent::getSaldo() - $valor - $this->taxaSaque;
            //     $novoSaldo = parent::getSaldo() - $valor - self::TAXA;
            //     parent::setSaldo($novoSaldo); 
            //     return true;
            // }
            // return false;
            $saldoVirtual = parent::getSaldo() + $this->limite + self::TAXA;
            if (!is_numeric($valor)) {
                throw new Exception("O valor do saque deve ser um NÚMERO");
            }
            else if ($valor <= 0) {
                throw new Exception("O valor do saque deve ser maior que ZERO");
            }
            else if ($valor > $saldoVirtual) {
                throw new Exception("Saldo INSUFICIENTE");
            }
            else {
                $novoSaldo = parent::getSaldo() - $valor - self::TAXA;
                parent::setSaldo($novoSaldo); 
            }
        }

        public static function getQuantidadeContas() {
            return self::$qtdContas;
        }

    }
?>