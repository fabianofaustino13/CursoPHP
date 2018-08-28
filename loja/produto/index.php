<?php

    require_once __DIR__ . "/../classes/modelo/Produto.class.php";
    require_once __DIR__ . "/../classes/modelo/Marca.class.php";
    require_once __DIR__ . "/../classes/modelo/Departamento.class.php";
    require_once __DIR__ . "/../classes/dao/ProdutoDAO.class.php";
    require_once __DIR__ . "/../classes/dao/MarcaDAO.class.php";
    require_once __DIR__ . "/../classes/dao/DepartamentoDAO.class.php";
    
    $dao = new ProdutoDAO();
    $produto = new Produto();
    $departamento = new Departamento();
    $departamento->setId(2);
    $marca = new Marca();
    $marca->setId(1);
    echo("<pre>");
    
    $produto->setNome('CHINELA');
    $produto->setPreco(199.99);
    $produto->setDescricao('DE DEDO');
    $produto->setQntMinima(5);
    $produto->setQntEstoque(50); 
    $produto->setMarca($marca);
    $produto->setDepartamento($departamento);

    $dao->save($produto);
    var_dump($dao->findAll());

    // PRO_NOME, PRO_PRECO, PRO_DESCRICAO, PRO_QUANTIDADE_MINIMA, PRO_QUANTIDADE_ESTOQUE, FK_PRO_MAR, FK_PRO_DEP
    echo("<pre>");
