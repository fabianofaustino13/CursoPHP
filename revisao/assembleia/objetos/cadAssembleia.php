<?php

require_once __DIR__ . "/classes/modelo/Assembleia.class.php";
require_once __DIR__ . "/classes/dao/AssembleiaDAO.class.php";

$nomeAssembleia = $_REQUEST["nome-assembleia"];
$dataAssembleia = $_REQUEST["data-assembleia"];
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
$dao = new AssembleiaDAO();

$assembleia = new Assembleia();
$assembleia->setNome('$nomeAssembleia');
$assembleia->setData('$dataAssembleia');

$assembleia = $dao->save($assembleia);

//$dao = new AssembleiaDAO();
$assembleias = $dao->findAll();

foreach ($assembleias as $assembleia) {
    echo("{$assembleia->getId()} - {$assembleia->getNome()} - {$sassembleiaexo->getData()} <br>");
}
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