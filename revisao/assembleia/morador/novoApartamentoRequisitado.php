<?php 
//Tela de cadastro do Morador - Auto-Cadastro
session_start();
// if ($_SESSION['MoradorStatus'] == NULL) {
//     header('location: ../assembleia/aguardando.php');
// }

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
</head>
<body>    
        <label for="apartamentoId" class="required">Apartamento</label>
        <select class="form-control" name="apartamentoId" required>
            <option value=""></option>
            <?php foreach ($apartamentos as $apartamento): ?>                                                    
                    <option id="<?=$apartamento->getId();?>" value="<?=$apartamento->getId();?>"><?=$apartamento->getNome();?></option> 
                <?php endforeach; 
            ?>                                    
        </select> 

</body>
</html>