<?php require_once(__DIR__ . "/../classes/modelo/Sexo.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/SexoDAO.class.php"); ?>
<?php 
include(__DIR__ . "/../administracao/logado.php");

$sexo = new Sexo();
$dao = new SexoDAO();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $sexo->setNome($_POST['sexo']);
    $sexo->setSigla($_POST['sigla']);
    if ($_POST['id'] != '') {
        $sexo->setId($_POST['id']);
    }
    $dao->save($sexo);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $sexo = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$sexos = $dao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Sexos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>
<body>
    <!-- Include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?> 
    
    <div class="container">
        <div class="row" style="margin: 5%;">
            <div class="col-md-12 mb-3"> <!-- Form -->
                <fieldset>
                    <legend>Dados do Sexo</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" maxlength="12" required value="<?=$sexo->getNome();?>">
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text" class="form-control" name="sigla" id="sigla" maxlength="4" required value="<?=$sexo->getSigla();?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-12 mb-3 "> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Sexos</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Sexo</th>
                            <th>Sigla</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($sexos as $sexo): ?>
                                <tr>
                                    <td><?=$sexo->getId()?></td>
                                    <td><?=$sexo->getNome()?></td>
                                    <td><?=$sexo->getSigla()?></td>
                                    <td>
                                        <form action="index.php" method="post" >
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div> <!-- Fim Tabela -->
        </div>
    </div>
    <script src="../assets/js/produto.js"></script>
</body>
</html>