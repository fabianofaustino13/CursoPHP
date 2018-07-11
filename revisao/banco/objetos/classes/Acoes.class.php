<?php
    require_once 'classes/Investimento.class.php';
    class Acoes extends Investimento {

        function __construct($nome, $idade, $sexo, $cpf, $agencia, $conta, $operacao, $rendimento) {
            parent::__construct($nome, $idade, $sexo, $cpf);
            parent::__construct($agencia, $conta);
            parent::__construct($operacao, $rendimento);
        }

        function setOperacao($operacao) {
            $this->operacao = $operacao;
        }
        
        function getOperacao() {
            return $this->operacao;
        }

        function setRendimento($rendimento) {
            $this->rendimento = $rendimento;
        }
        
        function getRendimento() {
            return $this->rendimento;
        }

        function __toString() {
            return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, <br> CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}, <br> Operação: {$this->operacao}, Rendimento: {$this->rendimento}";
        }
    }
?>