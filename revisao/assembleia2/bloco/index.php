<?php require_once(__DIR__ . "/../classes/modelo/Bloco.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new BlocoDAO();
$bloco = new Bloco();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $bloco->setNome(strtoupper($_POST['nome']));
    $bloco->setApelido(strtoupper($_POST['apelido']));
    if ($_POST['id'] != '') {
        $bloco->setId($_POST['id']);
    }
    $dao->save($bloco);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $bloco = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$blocos = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Bloco</title>
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
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Bloco</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-6 mb-3"><!-- Nome do Bloco -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$bloco->getId();?>">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$bloco->getNome();?>" maxlength="25" placeholder="Torre 1" required />
                            </div><!-- Fim Nome do Bloco -->
                            <div class="col-md-6 mb-3">
                                <label for="apelido">Apelido</label>
                                <input type="text" class="form-control" id="apelido" name="apelido" value="<?=$bloco->getApelido();?>" maxlength="25" placeholder="Nice" />
                            </div>
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Blocos</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Apelido</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($blocos as $bloco):?>
                                <tr>
                                    <td><?=$bloco->getId()?></td>
                                    <td><?=$bloco->getNome()?></td>
                                    <td><?=$bloco->getApelido()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$bloco->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$bloco->getId();?>">
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
    </div> <!-- Fim do container -->
</body>
</html> 