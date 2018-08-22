<?php

require_once __DIR__ . "/classes/modelo/TipoAssembleia.class.php";
require_once __DIR__ . "/classes/dao/TipoAssembleiaDAO.class.php";

//$nomeTipoAssembleia = $_REQUEST["tipo-nome-assembleia"];

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
$dao = new TipoAssembleiaDAO();

//$tipoAssembleia = new TipoAssembleia();
//$tipoAssembleia->setNome($nomeTipoAssembleia);

//$tipoAssembleia = $dao->save($tipoAssembleia);

//header('location: cadastrar-tipo-assembleia.php');
//$dao = new AssembleiaDAO();
$tipoAssembleias = $dao->findAll();

 foreach ($tipoAssembleias as $tipoAssembleia) {
     echo("{$tipoAssembleia->getId()} - {$tipoAssembleia->getNome()} <br>");
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