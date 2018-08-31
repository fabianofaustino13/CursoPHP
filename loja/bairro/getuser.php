<?php
require_once(__DIR__ . "/../classes/modelo/Estado.class.php");
require_once(__DIR__ . "/../classes/dao/EstadoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/../classes/dao/CidadeDAO.class.php");
 

$cidade = new Cidade();
$cidadeDao = new CidadeDAO();
$cidades = $cidadeDao->findCidadeEstado($_GET['q']);
// $cidades = $cidadeDao->findAll();
// return $cidade;
    echo "<label for='cidadeId'>Cidade</label>";
    echo "<select class='form-control' name='txtHint' id='txtHint'>";
    echo "<option value='0' disabled selected>Selecione uma cidade...</option>";
    foreach($cidades as $cidade) {
        echo "<option value='{$cidade->getNome()}'> {$cidade->getNome()}</option>";
    }
    echo "</select>";