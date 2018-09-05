<?php 
require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php");
require_once(__DIR__ . "/../classes/modelo/Pauta.class.php");
require_once(__DIR__ . "/../classes/dao/PautaDAO.class.php");

$assId = $_GET['assembleia'];
$assembleia = new Assembleia();
$assembleia->setId($assId);

$pautaDao = new PautaDAO();
$pautas = $pautaDao->findPautaAssembleia($assembleia);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pautas</title>
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
    <div class="col-12" id="div_pautas"> <!-- Tabela -->        
        <table class="table table-striped table-hover">
            <thead>
                <!-- <th>#</th> -->
                <th>Item</th>
                <th>Pauta</th>
                <th>Descrição</th>
                <th>Assembleia</th>
                <th colspan="2">Ações</th>
            </thead>
            <tbody>
                <?php 
                $i = count($pautas);
                foreach ($pautas as $pauta): ?>
                    <tr>
                        <!-- <td><//?=$pauta->getId();?></td> -->
                        <td><?=$i--;?></td>
                        <td><?=$pauta->getNome();?></td>
                        <td><?=$pauta->getDescricao();?></td>
                        <td><?=$pauta->getAssembleia()->getNome();?></td>
                        <td>
                            <form method="post" action="index.php">
                                <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                                <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                    <i class="far fa-edit"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="index.php"> 
                                <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                                <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div> <!-- Fim Tabela -->
</body>
</html>