<?php

    require_once 'Clientes.class.php';
    require_once 'Produtos.class.php';

class Compra {

    private $clienteCompra;
    private $protutoCompra;

    public function setClienteCompra(Clientes $clienteCompra) {
        $this->clienteCompra = $clienteCompra;
    }

    public function getClienteCompra() {
        return $this->clienteCompra;
    }

    public function setProdutoCompra(Produtos $produtoCompra) {
        $this->produtoCompra = $produtoCompra;
    }

    public function getProdutoCompra() {
        return $this->produtoCompra;
    }

    // public function compra($cliente, $produto) {
    //     getClienteCompra();

    // }
}
?>