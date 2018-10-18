<?php 
session_start();
// if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == 2) {
//     header('location: ../assembleia/aguardando.php');
// }

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php");
require_once(__DIR__ . "/../classes/modelo/Pauta.class.php");
require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php");
require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/dao/PautaDAO.class.php");
require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/PautaOpcaoResposta.class.php");
require_once(__DIR__ . "/../classes/dao/PautaOpcaoRespostaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/OpcaoResposta.class.php");
require_once(__DIR__ . "/../classes/dao/OpcaoRespostaDAO.class.php");


$dao = new PautaDAO();
$pauta = new Pauta();
// $pautasAssembleias = new Pauta();

$dao2 = new AssembleiaDAO();
$assembleia = new Assembleia();

$dao3 = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();

$assembleiaId = '';

$pautaDao = new PautaDAO();
$pautas2 = $pautaDao->findPautaAssembleia($assembleia);

$pautaOpcaoResposta = new PautaOpcaoResposta();
$pautaOpcaoRespostaDao = new PautaOpcaoRespostaDAO();

if (isset($_POST['atualizar']) && $_POST['atualizar'] == 'atualizar') {
    $pautas2 = $dao->findAllAssembleia($_POST['idAss']);
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $pauta->setNome($_POST['nome']);
    $pauta->setDescricao($_POST['descricao']);
    $pauta->getAssembleia()->setId($_POST['assembleia']);
    if ($_POST['id'] != '') {
        $pauta->setId($_POST['id']);
    }
    $dao->save($pauta);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $pauta = $dao->findById($_POST['id']);
} 

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}

$pautas = $dao->findAll();
$assembleias = $dao2->findAll();
$tipoAssembleias = $dao3->findAll();
$pautaOpcaoRespostas = $pautaOpcaoRespostaDao->findPorPauta();


if (!empty($_POST['pesquisarAssembleia']) && $_POST['pesquisarAssembleia'] == 'pesquisarAssembleia') {
    // $morador->setFkMorSin($_POST['fk']);
    $pautasAssembleias = $dao->findPautaAssembleia($_POST['assembleia']);

} else {
    $pautasAssembleias = $dao->findAll();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Resultado Votos Pauta</title> 
</head>
<body>
    <!-- Início do container -->
    <div class="container-fluid">
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    </div>
    <div class="containerMenuDireita">
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Resultado Votos Pauta</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->                    
                </fieldset>
            </div>
                       
            <div class="col-12" id="div_pautas"> <!-- Tabela -->  
                <table class="table table-striped table-hover">
                    <thead>
                        <!-- <th>#</th> -->
                        <th>Pauta</th>
                        <th>SIM</th>
                        <th>NÃO</th>
                        <th>ABSTENÇÃO</th>
                        <th colspan="2">Ações</th>
                    </thead>
                    <tbody>                
                        <!-- Fim Botões -->
                        <?php                        
                      
                        $sim = $pautaOpcaoRespostaDao->somaSim(1);
                        $nao = $pautaOpcaoRespostaDao->somaNao(1);
                        $abstencao = $pautaOpcaoRespostaDao->somaAbstencao(1);
                        echo "Sim = {$sim} ";
                        echo "Não = {$nao} ";
                        echo "Abstenção = {$abstencao} ";
                        ?>

                        <?php foreach ($pautaOpcaoRespostas as $pautaOpcaoResposta): ?>                          
                            <tr>    
                                <td><?=$pautaOpcaoResposta->getPauta()->getNome();?></td>
                                <td><?=$pautaOpcaoRespostaDao->somaSim($pautaOpcaoResposta->getPauta()->getId());?></td>
                                <td><?=$pautaOpcaoRespostaDao->somaNao($pautaOpcaoResposta->getPauta()->getId());?></td>
                                <td><?=$pautaOpcaoRespostaDao->somaAbstencao($pautaOpcaoResposta->getPauta()->getId());?></td>                               
                                <td>
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="id" value="<?=$pautaOpcaoResposta->getPauta()->getNome();?>">
                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="index.php"> 
                                        <input type="hidden" name="id" value="<?=$pautaOpcaoResposta->getPauta()->getNome();?>">
                                        <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                        <?php endforeach; ?>
                        <!-- </form> Fim Form Geral -->
                    </tbody>
                </table>
            </div> <!-- Fim Tabela -->
        </div> 
    </div> <!-- Fim do container -->
    <script src="../assets/js/ajax_funcoes.js"></script>
</body>
</html> 