<?php

    require_once(__DIR__ . "/./Funcionario.class.php");
    require_once(__DIR__ . "/./Cliente.class.php");
    require_once(__DIR__ . "/./Produto.class.php");
    
    class Venda {

        private $id;
        private $funcionario;
        private $cliente;
        private $produtos;
        private $valor;

        public function __construct() {
            $this->produtos = array();
        }

        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
        }

        public function getFuncionario() {
            return $this->funcionario;
        }
        
        public function setFuncionario(Funcionario $funcionario) {
            $this->funcionario = $funcionario;
        }

        public function getCliente() {
            return $this->cliente;
        }
        
        public function setCliente(Cliente $cliente) {
            $this->cliente = $cliente;
        }

        public function getProdutos() {
            return $this->produtos;
        }

        public function setProdutos(Produtos $produto) {
            $this->produtos = $produtos;
        }
        //add elemento produto na lista produto
        public function addProduto(Produto $produto) {
            array_push($this->produtos, $produto);
        }
        //remover elemento produto na lista produto
        public function removeProduto(Produto $produto) {
            //array_push($this->produtos, $produto);

        }

        public function getValor() {
            $valor = 0;
            foreach ($produtos as $produto) {
                $valor += $produto->getPreco();
            }
            return $valor;
        }
    }