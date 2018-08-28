<?php

    require_once __DIR__ . "/classes/modelo/Sexo.class.php";
    require_once __DIR__ . "/classes/dao/SexoDAO.class.php";

    /*
    //Mostrando todos os dados
    $dao = new SexoDAO();
    $sexos = $dao->findAll();

    foreach ($sexos as $sexo) {
        echo("{$sexo->getId()} - {$sexo->getNome()} ");
    }
    
    //Mostrando apenas 1 dado
    $dao = new SexoDAO();
    $sexo = $dao->findById(2);
    echo("<br> {$sexo->getId()} - {$sexo->getNome()} - {$sexo->getSigla()} <br>");
*/
    //Inserindo os dados
    $dao = new SexoDAO();
    echo("<pre>");
    var_dump($dao->findAll());
    echo("<pre>");
    // $sexo = new Sexo();
    // $sexo = $dao->findByNome('VIADO');
    // //echo("{$sexo->getId()} - {$sexo->getNome()} - {$sexo->getSigla()} <br>");

    // $sexo->setId($sexo->getId());
    // //echo("{$sexo->getId()}");
    // $sexo->setNome('VIADO');
    // $sexo->setSigla('VIA');
    
    // $sexo = $dao->save($sexo);
    
    // $dao = new SexoDAO();
    // $sexos = $dao->findAll();

    // foreach ($sexos as $sexo) {
    //     echo("{$sexo->getId()} - {$sexo->getNome()} - {$sexo->getSigla()} <br>");
    // }
/*
    //Atualizando os dados
    $dao = new SexoDAO();   
    $sexo = $dao->findById(3);

    $sexo->setNome('Outros');
    
    $sexo = $dao->update($sexo);
    
    $dao = new SexoDAO();
    $sexos = $dao->findAll();

    foreach ($sexos as $sexo) {
        echo("{$sexo->getId()} - {$sexo->getNome()} - {$sexo->getSigla()} <br>");
    }

    //Removendo um dado
    $dao = new SexoDAO();   
    //$sexo = $dao->findById(3);
   
    $sexo = $dao->remove(3);
    
    $dao = new SexoDAO();
    $sexos = $dao->findAll();

    foreach ($sexos as $sexo) {
        echo("{$sexo->getId()} - {$sexo->getNome()} - {$sexo->getSigla()} <br>");
    }
*/