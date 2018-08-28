<?php

    require_once __DIR__ . "/../classes/modelo/Produto.class.php";
    require_once __DIR__ . "/../classes/modelo/Marca.class.php";
    require_once __DIR__ . "/../classes/modelo/Departamento.class.php";
    require_once __DIR__ . "/../classes/dao/ProdutoDAO.class.php";
    
    $dao = new ProdutoDAO();

    echo("<pre>");
    var_dump($dao->findById(2));
    echo("<pre>");
