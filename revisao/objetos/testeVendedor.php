<?php

    require_once 'classes/Pessoa.class.php';
    require_once 'classes/Vendedor.class.php';

    // $cliente = new Cliente();

    // $cliente->setNome('Faustino');
    // $cliente->setIdade(37);
    // $cliente->setCpf('123.123.123.12');
    // $cliente->setCartao('1111 2222 3333 4444');
    
    $cliente = new Vendedor('Maria Clara', 'f', '', 2222, '01/01/2017','');
    
    echo "Cliente: {$cliente->getNome()} <br> Idade: {$cliente->getIdade()} <br> Sexo: {$cliente->getSexo()} <br> Matrícula: {$cliente->getMatricula()} <br> Data de Admissao: {$cliente->getDataAdmissao()}  <br> Data de Demissao: {$cliente->getDataDemissao()}";

?>