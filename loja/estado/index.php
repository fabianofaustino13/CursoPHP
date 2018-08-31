<?php require_once(__DIR__ . "/../classes/modelo/Estado.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/EstadoDAO.class.php"); ?>
<?php 
include(__DIR__ . "/../administracao/logado.php");

$estado = new Estado();
$estadoDao = new EstadoDAO();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $estado->setNome($_POST['nome']);
    $estado->setSigla($_POST['sigla']);
    if ($_POST['id'] != '') {
        $estado->setId($_POST['id']);
    }
    $estadoDao->save($estado);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $estado = $estadoDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $estadoDao->remove($_POST['id']);
    header('location: index.php');
}
$estados = $estadoDao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Estados</title>
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
            <div class="col-md-6 mb-3"> <!-- Form -->
                <fieldset>
                    <legend>Dados do Estado</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$estado->getId();?>">
                            <label for="nome" class="required">Estado</label>
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="25" required value="<?=$estado->getNome();?>">
                        </div>
                        <div class="form-group">
                            <label for="sigla" class="required">Sigla</label>
                            <input type="text" class="form-control" name="sigla" id="sigla" maxlength="4" required value="<?=$estado->getSigla();?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-6 mb-3 "> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Estados</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Sigla</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($estados as $estado): ?>
                                <tr>
                                    <td><?=$estado->getId()?></td>
                                    <td><?=$estado->getNome()?></td>
                                    <td><?=$estado->getSigla()?></td>
                                    <td>
                                        <form action="index.php" method="post" >
                                            <input type="hidden" name="id" value="<?=$estado->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$estado->getId();?>">
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