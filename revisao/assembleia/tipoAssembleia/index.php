<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php  

include(__DIR__ . "/../administracao/logado.php");

$dao = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $tipoAssembleia->setNome(strtoupper($_POST['tipoAssembleia']));
    if ($_POST['id'] != '') {
        $tipoAssembleia->setId($_POST['id']);
    }
    $dao->save($tipoAssembleia);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $tipoAssembleia = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$tipoAssembleias = $dao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tipo de Assembléia</title>
</head>
<body>
    <!-- Início do container -->
    <div class="container-fluid">
        <!-- include Menu -->
        <?php
            include(__DIR__ . "/../administracao/menu.php");
        ?>
        
        <div class="containerMenuDireita">
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-12 mb-3"> <!-- Form -->
                    <fieldset>
                        <legend>Dados do Tipo de Assembléia</legend>
                        <form action="index.php" method="post">
                            <label for="tipoAssembleia" class="required">Tipo de Assembléia</label>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
                                <input type="text" class="form-control" id="tipoAssembleia" name="tipoAssembleia" value="<?=$tipoAssembleia->getNome();?>" maxlength="100" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                            </div>
                        </form>
                    </fieldset>
                </div> <!-- Fim Form -->
                <div class="col-md-12 mb-3"> <!-- Tabela -->
                    <fieldset>
                        <legend>Lista do Tipo de Assembléia</legend>
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>#</th>
                                <th>Tipo de Assembléia</th>
                                <th colspan="2">Ações</th>
                            </thead>
                            <tbody>
                                <?php foreach ($tipoAssembleias as $tipoAssembleia): ?>
                                    <tr>
                                        <td><?=$tipoAssembleia->getId()?></td>
                                        <td><?=$tipoAssembleia->getNome()?></td>
                                        <td>
                                            <form method="post" action="index.php">
                                                <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
                                                <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="index.php"> 
                                                <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>"><label></label>
                                                <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
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
    </div>
</body>
</html>