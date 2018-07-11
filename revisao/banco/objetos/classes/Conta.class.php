<?php
    
    require_once 'Cliente.class.php';

class Conta {
        protected $cliente;
        protected $agencia;
        protected $numero;
        protected $saldo;

        // function __construct($agencia, $conta) {
        //     $this->setAgencia($agencia);
        //     $this->setConta($conta);
        // }

        function setCliente(Cliente $cliente) {
            $this->cliente = $cliente;
        }
        
        function getCliente() {
            return $this->cliente;
        }

        function setAgencia($agencia) {
            $this->agencia = $agencia;
        }
        
        function getAgencia() {
            return $this->agencia;
        }

        function setNumero($numero) {
            $this->numero = $numero;
        }
        
        function getNumero() {
            return $this->numero;
        }

        function setSaldo($saldo) {
            $this->saldo = $saldo;
        }
        
        function getSaldo() {
            return $this->saldo;
        }

        // function __toString() {
        //     return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}";
        // }
    }

?>