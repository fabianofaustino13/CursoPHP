<?php
    
    require_once 'Conta.class.php';

class Corrente extends Conta {
        private $operacao;
        private $limite;
        //private $saldo;
        private $saque;
        private $deposito;

        // function __construct($agencia, $conta, $saldo) {
        //     parent::__construct($agencia, $conta, $saldo);
        //     //parent::__construct($agencia, $conta);
        //     $this->setOperacao($operacao);
        //     $this->setLimite($limite);
        //     //$this->saldo = 0;
        //     // $this->saque = 0;
        //     // $this->deposito = 0;
        // }

        function setOperacao($operacao) {
            $this->operacao = $operacao;
        }
        
        function getOperacao() {
            return $this->operacao;
        }

        function setLimite($limite) {
            $this->limite = $limite;
        }
        
        function getLimite() {
            return $this->limite;
        }

        function setSaldo($saldo) {
            $this->saldo += $saldo;
        }
        
        function getSaldo() {
            return $this->saldo;
        }
        
        function setSaque($saque) {
            //echo $this->getSaldo() . "<br>" . $this->getLimite() . "<br>" ;
            if (($this->getSaldo() + $this->getLimite()) >= $saque) {
                $this->saldo = $this->getSaldo() - $saque;
//                $this->saldo = $saldo - $this->saque;
                $this->saque = $saque;
                //echo 'Teste';
            } else {
                $this->saque = 'Você está com saldo insuficiente para o saque de '. $saque;
                //echo 'Teste23';
            }
        }
        
        function getSaque() {
            return $this->saque;
        }

        function setDeposito($deposito) {
            $this->setSaldo($deposito);
            $this->deposito = $deposito;
        }
        
        function getDeposito() {
            return $this->deposito;
        }
        function getSaldoTotal() {
            return ($this->saldo + $this->limite);
        }

        // function __toString() {
        //     return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, <br> CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}, <br> Operação: {$this->operacao}, Saldo: {$this->saldo}, Limite: {$this->limite}, Saldo Total: {$this->getSaldoTotal()}";
        // }
    }
?>