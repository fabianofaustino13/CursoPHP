<?php
    require_once 'classes/Pessoa.class.php';
    class Conta {
        private $cliente;
        protected $agencia;
        protected $conta;

        function __construct($agencia, $conta) {
            $this->setAgencia($agencia);
            $this->setConta($conta);
            //$this->setCliente($cliente);
        }

        function setCliente(Pessoa $cliente) {
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

        function setConta($conta) {
            $this->conta = $conta;
        }
        
        function getConta() {
            return $this->conta;
        }

        function __toString() {
            return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}";
        }
    }

?>