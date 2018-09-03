<?php require_once(__DIR__ . "/../classes/modelo/Morador.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new MoradorDAO();
$morador = new Morador();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $morador->setNome($_POST['nome']);
    $morador->setLogin($_POST['login']);

    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    if ($senha == $senha2) {
        $morador->setSenha($_POST['senha']);
    } else {
        echo("senha não confere.");
    }
    $morador->setUltimoAcesso($_POST['ultimoAcesso']);
    $morador->setFoto($_POST['foto']);
    $morador->setFkMorSin($_POST['fkSindico']);
    if ($_POST['id'] != '') {
        $morador->setId($_POST['id']);
    }
    $dao->save($morador);
    //header('location: index.php');

        // $moradores = $dao->findAll();
        // foreach ($moradores as $morador) {
        //         $morador->setFkMorSin($_POST['fkSindico']);
        //         header('location: index.php');
        //         $dao->save($morador);
    
        //     }
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $morador = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}

$moradores = $dao->findAll();
$sindicos = $dao->findSindico();
date_default_timezone_set('America/Sao_Paulo');
// $dataLocal = date('d/m/Y H:i:s', time());
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Morador</title>
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
                    <legend>Cadastro de Moradores</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-12 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" required />
                            </div><!-- Fim Nome do Morador -->
                            <div class="col-md-4 mb-3">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?=$morador->getLogin();?>" maxlength="25" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="senha">Senha</label>
                                <input type="text" class="form-control" id="senha" name="senha" maxlength="25" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="senha2">Confirme a Senha</label>
                                <input type="text" class="form-control" id="senha2" name="senha2" maxlength="25" />
                            </div>            
                            <!-- <div class="col-md-6 mb-3">
                                <label class="required ">Síndico?</label>
                                <div class="form-group">                           
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoNao" name="sindico" value="<//?=$morador->getFkMorSin();?>" class="custom-control-input" checked/>
                                            <label class="custom-control-label" for="sindicoNao">Não</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoSim" name="sindico" value="<//?=$morador->getId();?>" class="custom-control-input" />
                                            <label class="custom-control-label" for="sindicoSim">Sim</label>
                                        </div>                           
                                </div>
                            </div> -->
                            <div class="col-md-3 mb-3">
                                <?php  $data = date("Y-m-d H:i:s"); //Data de hoje no formato do banco
                                        $data2 = date("d-m-Y H:i:s"); //Data de hoje no formato BR?>
                                <input type="hidden" class="form-control" id="ultimoAcesso" name="ultimoAcesso" value="<?=$data;?>" />
                            </div>   
                            <div class="col-md-12 mb-3"><!-- Nome do Morador -->
                                <!-- Pegar os dados do síndico ja cadastrado e adicionar no novo usuário -->                               
                                <!-- <//?php foreach ($sindicos as $morador) { -->
                                    <!-- $morador->getFkMorSin(); -->
                                <!-- } ?>                                                             -->
                                <!-- <input type="hidden" name="fkSindico" value="<//?=$morador->getFkMorSin();?>"> -->
                                <!-- <input type="text" class="form-control" id="nome" name="nome" value="<//?=$morador->getNome();?>" maxlength="100" required /> -->
                            </div><!-- Fim Nome do Morador -->
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Moradores</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Cadastrado em</th>
                            <th>Sindico</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($moradores as $morador):?>
                                <tr>
                                    <td><?=$morador->getId()?></td>
                                    <td><?=$morador->getNome()?></td>
                                    <td><?=$morador->getLogin()?></td>
                                    <td><?=$morador->getUltimoAcesso()?></td>
                                    <td><?=$morador->getFkMorSin()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
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