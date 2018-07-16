<?php

    require_once 'SecaoProdutos.class.php';

class Produtos {

    private $nomeProduto;
    private $precoProduto;
    private $secaoProduto;

    public function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    public function getNomeProduto() {
        return $this->nomeProduto;
    }

    public function setPrecoProduto($precoProduto) {
        $this->precoProduto = $precoProduto;
    }

    public function getPrecoProduto() {
        return $this->precoProduto;
    }

    public function setSecaoProduto(SecaoProdutos $secaoProduto) {
        $this->secaoProduto = $secaoProduto;
    }

    public function getSecaoProduto() {
        return $this->secaoProduto;
    }
}

?>