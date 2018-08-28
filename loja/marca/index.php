<?php
    require_once __DIR__ . "/../classes/modelo/Marca.class.php";
    require_once __DIR__ . "/../classes/dao/MarcaDAO.class.php";

    $dao = new MarcaDAO();
    echo("<pre>");
    var_dump($dao->findAll());
    echo("<pre>");