<?php require_once(__DIR__ . "/../classes/modelo/OpcaoResposta.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/OpcaoRespostaDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new OpcaoRespostaDAO();
$opcaoResposta = new OpcaoResposta();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $opcaoResposta->setNome(strtoupper($_POST['nome']));
    $opcaoResposta->setImagem($_POST['imagem']);
    if ($_POST['id'] != '') {
        $opcaoResposta->setId($_POST['id']);
    }
    $dao->save($opcaoResposta);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $opcaoResposta = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$opcaoRespostas = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Opção de Resposta</title>
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
                    <legend>Opções de Respostas</legend>
                    <form method="post" action="index.php"><!-- Form Geral Opção Resposta -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-6 mb-3"><!-- Nome da Opção -->
                                <label for="nome" class="required">Resposta</label>
                                <input type="hidden" name="id" value="<?=$opcaoResposta->getId();?>">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$opcaoResposta->getNome();?>" maxlength="25" placeholder="Nome breve para resposta" required />
                            </div><!-- Fim Nome da Opção -->
                            <div class="col-md-6 mb-3">
                                <label for="imagem">Imagem</label>
                                <input type="text" class="form-control" id="imagem" name="imagem" value="<?=$opcaoResposta->getImagem();?>" />
                            </div>
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Opção Resposta-->
                </fieldset>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Opções de Respostas</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Opção</th>
                            <th>Imagem</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($opcaoRespostas as $opcaoResposta):?>
                                <tr>
                                    <td><?=$opcaoResposta->getId()?></td>
                                    <td><?=$opcaoResposta->getNome()?></td>
                                    <td><?=$opcaoResposta->getImagem()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$opcaoResposta->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$opcaoResposta->getId();?>">
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