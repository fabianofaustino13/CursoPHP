<?php
    
    require_once 'Cliente.class.php';

abstract class Conta {

        protected $cliente;
        protected $agencia;
        protected $numero;
        protected $saldo;

        // function __construct($agencia, $conta) {
        //     $this->setAgencia($agencia);
        //     $this->setConta($conta);
        // }

        public function setCliente(Cliente $cliente) {
            $this->cliente = $cliente;
        }
        
        public function getCliente() {
            return $this->cliente;
        }

        public function setAgencia($agencia) {
            $this->agencia = $agencia;
        }
        
        public function getAgencia() {
            return $this->agencia;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }
        
        public function getNumero() {
            return $this->numero;
        }

        public function setSaldo($saldo) {
            $this->saldo = $saldo;
        }
        
        public function getSaldo() {
            return $this->saldo;
        }

        public abstract function saca($valor);

        public function deposita($valor) {
            if (is_numeric($valor) && $valor > 0) {
                $this->saldo += $valor;
                return true;
            }
            return false;
        }

        public function transfere($valor, Conta $conta) {
            if ($this->saca($valor)) {
                $conta->deposita($valor);
                return true;
            }
            return false;
        }

        // function __toString() {
        //     return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}";
        // }
        //ToString para voltar uma string
        public function __toString() {
            $resultado = "<{$this->agencia}|{$this->numero}|{$this->saldo}|{$this->cliente->getNome()}|{$this->cliente->getCpf()}";
            return $resultado;
        }
    }

?>