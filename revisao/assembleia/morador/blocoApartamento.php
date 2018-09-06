<?php 
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/modelo/bloco.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");

$bloId = $_GET['blocoId'];
$bloco = new Bloco();
$bloco->setId($bloId);

$apartamentoDao = new ApartamentoDAO();
$apartamentos = $apartamentoDao->findApartamentoBloco($bloco);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Apartamento</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/base.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/botoes.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>    
        <label for="apartamentoId">Apartamento</label>
        <select class="form-control" name="apartamentoId">
            <option value="0" selected disabled>--SELECIONE--</option>
            <?php foreach ($apartamentos as $apartamento): ?>                                                    
                    <option id="<?=$apartamento->getId();?>" value="<?=$apartamento->getId();?>"><?=$apartamento->getNome();?></option> 
                <?php endforeach; 
            ?>                                    
        </select> 

</body>
</html>