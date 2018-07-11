<?php

    //require_once 'classes/Pessoa.class.php';
    require_once 'classes/Vendedor.class.php';

    // $cliente = new Cliente();

    // $cliente->setNome('Faustino');
    // $cliente->setIdade(37);
    // $cliente->setCpf('123.123.123.12');
    // $cliente->setCartao('1111 2222 3333 4444');
    
    $vendedor = new Vendedor('Maria Clara', 'f', '15', 2222, '01/01/2017','');
    
    echo "Cliente: {$vendedor->getNome()} <br> Idade: {$vendedor->getIdade()} <br> Sexo: {$vendedor->getSexo()} <br> Matrícula: {$vendedor->getMatricula()} <br> Data de Admissao: {$vendedor->getDataAdmissao()}  <br> Data de Demissao: {$vendedor->getDataDemissao()}";
    echo "<br>", $vendedor;
?>