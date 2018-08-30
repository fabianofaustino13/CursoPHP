
<?php require_once(__DIR__ . "/../classes/modelo/Marca.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MarcaDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new MarcaDAO();
$marca = new Marca();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $marca->setNome($_POST['marca']);
    if ($_POST['id'] != '') {
        $marca->setId($_POST['id']);
    }
    $dao->save($marca);
    header('location: index.php');
}
if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $marca = $dao->findById($_POST['id']);
}
if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$marcas = $dao->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
</head>
<body>
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    <div class="container">
        <div class="row" style="margin-top: 5%;">
            <div class="col-6"><!-- form -->
                <fieldset>
                    <legend>Dados da Marca</legend>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?=$marca->getId();?>">
                        <div class="form-group">
                            <label for="marca" class="required">Nome da Marca</label>
                            <input type="text" class="form-control" name="marca" id="marca" maxlength="12" required value="<?=$marca->getNome();?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-6"><!-- table -->
                <fieldset>
                    <legend>Lista de Marcas</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Marca</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($marcas as $marca): ?>
                                <tr>
                                    <td><?=$marca->getId();?></td>
                                    <td><?=$marca->getNome();?></td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$marca->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$marca->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>