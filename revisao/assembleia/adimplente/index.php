<?php require_once(__DIR__ . "/../classes/modelo/Adimplente.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AdimplenteDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new AdimplenteDAO();
$adimplente = new Adimplente();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $adimplente->setNome($_POST['nome']);
    $adimplente->setImagem($_POST['imagem']);
    // $adimplente->setImagem($_FILES['imagem']['nome']);
    if ($_POST['id'] != '') {
        $adimplente->setId($_POST['id']);
    }
    $dao->save($adimplente);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $adimplente = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$adimplentes = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Situação Financeira</title>
</head>
<body>
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>

	<!-- Início do container -->
	<div class="container">
        <div class="row" style="margin-top: 5%;">   
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Situação Financeira</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-6 mb-3"><!-- Nome -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$adimplente->getNome();?>" maxlength="25" placeholder="Adimplente" required />
                            </div><!-- Fim Nome -->     
                            <div class="col-md-6 mb-3"><!-- Imagem -->
                                <label for="imagem">Imagem</label>
                                <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
                                <div><input type="file" name="imagem"></div> -->

                                <input type="text" class="form-control" id="imagem" name="imagem" value="<?=$adimplente->getImagem();?>" />
                            </div><!-- Fim Nome -->                     
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Situações Financeiras</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Imagem</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($adimplentes as $adimplente):?>
                                <tr>
                                    <td><?=$adimplente->getId()?></td>
                                    <td><?=$adimplente->getNome()?></td>
                                    <td><?=$adimplente->getImagem()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
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
    </div> <!-- Fim do container -->
</body>
</html> 