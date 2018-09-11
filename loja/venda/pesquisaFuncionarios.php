<?php 

require_once(__DIR__ . "/../classes/modelo/Funcionario.class.php");
require_once(__DIR__ . "/../classes/dao/FuncionarioDAO.class.php");

$pesquisaFuncionario = $_GET['matricula'];
$funcionario = new Funcionario();
$funcionario->setMatricula($pesquisaFuncionario);

$funcionarioDao = new FuncionarioDAO();

$funcionarios = $funcionarioDao->findByFuncionario($funcionario);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Funcionarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>    

            <!-- <input type="hidden" name="id" value="<//?=$sexo->getId();?>"> -->
            <label for="nomeFuncionario">Nome do Funcionário</label>
            <?php foreach($funcionarios as $funcionario): ?>
                <input type="text" class="form-control" name="nomeFuncionario" id="nomeFuncionario" maxlength="50" required value="<?=$funcionario->getNome();?>">
            <?php endforeach;?>
             <!-- Fim Tabela -->

</body>
</html>