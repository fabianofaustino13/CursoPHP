<?php
    require_once 'classes/Pessoa.class.php';
    class Cliente extends Pessoa {

        private $cpf;
        private $cartao;

        function __construct($nome, $cpf, $idade, $sexo, $cartao) {
            parent::__construct($nome, $sexo, $idade);
            $this->setCPF($cpf);
            $this->setCartao($cartao);
        }

        function setCPF($cpf) {
            $this->cpf = $cpf;
        }

        function getCpf() {
            return $this->cpf;
        }

        function setCartao($cartao) {
            $this->cartao = $cartao;
        }

        function getCartao() {
            return $this->cartao;
        }

        function setIdade($idade) {
            if (is_numeric($idade) && $idade >= 0 && $idade <= 150) {
                $this->idade = $idade;
            } else {
                $this->idade = 0;
            }
        }
        
        function getIdade() {
            return $this->idade;
        }

        function __toString() {
            return "Nome: {$this->nome}, Idade: {$this->idade}";
        }

    }

?>