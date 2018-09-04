<?php 
require_once(__DIR__ . "/../classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/../classes/modelo/Bairro.class.php");
require_once(__DIR__ . "/../classes/dao/BairroDAO.class.php");

$cidade_id = $_GET['cid'];
$cidade = new Cidade();
$cidade->setId($cidade_id);

$bairroDao = new BairroDAO();
$bairros = $bairroDao->findByCidade($cidade);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Bairros</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>    
    <label for="bairro">Bairro</label>
    <select class="form-control" name="bairro" id="bairro">
        <option value="0">--SELECIONE--</option>
            <?php foreach ($bairros as $bairro): ?>
                <option value="<?=$bairro->getId();?>"><?=$bairro->getNome();?></option>
            <?php endforeach; ?>
    </select>
</body>
</html>