
<?php require_once(__DIR__ . "/../classes/modelo/Departamento.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/DepartamentoDAO.class.php"); ?>
<?php 
$dao = new DepartamentoDAO();
$departamento = new Departamento();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $departamento->setNome($_POST['departamento']);
    if ($_POST['id'] != '') {
        $departamento->setId($_POST['id']);
    }
    $dao->save($departamento);
    header('location: index.php');
}
if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $departamento = $dao->findById($_POST['id']);
}
if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$departamentos = $dao->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
</head>
<body>
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><!-- form -->
                <fieldset>
                    <legend>Dados da Departamento</legend>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?=$departamento->getId();?>">
                        <div class="form-group">
                            <label for="departamento" class="required">Nome do Departamento</label>
                            <input type="text" class="form-control" name="departamento" id="departamento" maxlength="12" required value="<?=$departamento->getNome();?>">
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
                    <legend>Lista de Departamentos</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Departamento</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($departamentos as $departamento): ?>
                                <tr>
                                    <td><?=$departamento->getId();?></td>
                                    <td><?=$departamento->getNome();?></td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$departamento->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$departamento->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="remover" value="remover"><i class="fas fa-trash-alt"></i></button>
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