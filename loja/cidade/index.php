<?php 
require_once(__DIR__ . "/../classes/modelo/UnidadeFederativa.class.php");
require_once(__DIR__ . "/../classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/../classes/dao/CidadeDAO.class.php");

$uf_id = $_GET['uf'];
$uf = new UnidadeFederativa();
$uf->setId($uf_id);

$cidadeDao = new CidadeDAO();
$cidades = $cidadeDao->findByUnidadeFederativa($uf);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cidades</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>    
    <label for="cidade">Cidade</label>
    <select class="form-control" name="cidade" id="cidade" onchange="show_bairros(this.value);">
        <option value="0">--SELECIONE--</option>
            <?php foreach ($cidades as $cidade): ?>
                <option value="<?=$cidade->getId();?>"><?=$cidade->getNome();?></option>
            <?php endforeach; ?>
    </select>
</body>
</html>