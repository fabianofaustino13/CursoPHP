<?php
    require_once __DIR__ . "/../classes/modelo/Departamento.class.php";
    require_once __DIR__ . "/../classes/dao/DepartamentoDAO.class.php";

    $dao = new DepartamentoDAO();
    echo("<pre>");
    var_dump($dao->findAll());
    echo("<pre>");