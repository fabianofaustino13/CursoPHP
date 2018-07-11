<?php

    //require_once 'classes/Pessoa.class.php';
    require_once 'classes/Cliente.class.php';

    // $cliente = new Cliente();

    // $cliente->setNome('Faustino');
    // $cliente->setIdade(37);
    // $cliente->setCpf('123.123.123.12');
    // $cliente->setCartao('1111 2222 3333 4444');
    
    $cliente = new Cliente('Maria Clara', 12345678900, '15', 'f', '1111 2222 3333 4444');
    
    echo "Cliente: {$cliente->getNome()} <br> Idade: {$cliente->getIdade()} <br> CPF: {$cliente->getCpf()} <br> Número do cartão: {$cliente->getCartao()} <br> Sexo: {$cliente->getSexo()}";
    echo "<br>", $cliente;
?>