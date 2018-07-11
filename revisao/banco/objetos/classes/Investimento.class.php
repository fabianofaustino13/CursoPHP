<?php
    require_once 'classes/Conta.class.php';
    abstract class Investimento extends Conta {
        protected $operacao;
        protected $rendimento;

        function __construct($nome, $idade, $sexo, $cpf, $agencia, $conta, $operacao, $rendimento) {
            parent::__construct($nome, $idade, $sexo, $cpf);
            parent::__construct($agencia, $conta);
            $this->setOperacao($operacao);
            $this->setRendimento($rendimento);
        }

        abstract function setOperacao($operacao);
        
        abstract function getOperacao();

        abstract function setRendimento($rendimento);
        
        abstract function getRendimento();
    }
?>