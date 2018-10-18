<?php 
session_start();
// if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == 2) {
//     header('location: ../assembleia/aguardando.php');
// }

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php");
require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Pauta.class.php");
require_once(__DIR__ . "/../classes/dao/PautaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php");
require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/PautaOpcaoResposta.class.php");
require_once(__DIR__ . "/../classes/dao/PautaOpcaoRespostaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/OpcaoResposta.class.php");
require_once(__DIR__ . "/../classes/dao/OpcaoRespostaDAO.class.php");

$morador = new Morador();
$moradorDao = new MoradorDAO();

$pauta = new Pauta();
$pautaDao = new PautaDAO();
// $pautasAssembleias = new Pauta();

$assembleiaDao = new AssembleiaDAO();
$assembleia = new Assembleia();

$tipoAssembleiaDao = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();

$assembleiaId = '';

$pautas2 = $pautaDao->findPautaAssembleia($assembleia);

$pautaOpcaoResposta = new PautaOpcaoResposta();
$pautaOpcaoRespostaDao = new PautaOpcaoRespostaDAO();
$opcaoResposta = new OpcaoResposta();
$opcaoRespostaDao = new OpcaoRespostaDAO();

if (isset($_POST['atualizar']) && $_POST['atualizar'] == 'atualizar') {
    //$pautas2 = $dao->findAllAssembleia($_POST['idAss']);
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    
    $pautaOpcaoResposta->setMorador($moradorDao->findById($_SESSION['MoradorID']));
    $pautaOpcaoResposta->setPauta($pautaDao->findById($_POST['pauta_id']));
    $pautaOpcaoResposta->setOpcaoResposta($opcaoRespostaDao->findById($_POST['opcao_resposta']));
    // $pauta->setDescricao($_POST['descricao']);
    // $pauta->getAssembleia()->setId($_POST['assembleia']);
    // if ($_POST['id'] != '') {
    //     $pauta->setId($_POST['id']);
    // }
    $teste = $pautaOpcaoRespostaDao->save($pautaOpcaoResposta);
    // echo "<pre>";    
    // var_dump($pautaOpcaoResposta);
    // var_dump($teste);
    // echo "</pre>";
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $pauta = $pautaDao->findById($_POST['id']);
} 

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $pautaDao->remove($_POST['id']);
    header('location: index.php');
}

$pautas = $pautaDao->findAll();
$assembleias = $assembleiaDao->findAll();
$tipoAssembleias = $tipoAssembleiaDao->findAll();
$pautaOpcaoRespostas = $pautaOpcaoRespostaDao->findPorPauta();
$opcaoRespostas = $opcaoRespostaDao->findAll();


if (!empty($_POST['pesquisarAssembleia']) && $_POST['pesquisarAssembleia'] == 'pesquisarAssembleia') {
    // $morador->setFkMorSin($_POST['fk']);
    $pautasAssembleias = $assembleiaDao->findPautaAssembleia($_POST['assembleia']);

} else {
    $pautasAssembleias = $assembleiaDao->findAll();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Votação</title> 
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
                    <legend>Votação</legend>
                    <form method="post" action="index.php"><!-- Form -->                    
                        <div class="form-row"><!-- Div1 -->                        
                            <label for="votacao" class="required">Escolha uma opção por pauta</label><br><!-- Tipo de Assembleia -->
                            <div class="col-12">
                                <div class="form-group">
                                    <?php foreach ($pautaOpcaoRespostas as $pautaOpcaoResposta): ?>
                                        <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$pautaOpcaoResposta->getPauta()->getNome();?>" />
                                        <?php foreach ($opcaoRespostas as $opcaoResposta): ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="<?=$opcaoResposta->getNome();?>" name="opcao_resposta" value=<?=$opcaoResposta->getId();?> class="custom-control-input" required/>
                                                <label class="custom-control-label" for="<?=$opcaoResposta->getNome();?>"><?=$opcaoResposta->getNome();?></label>
                                            </div>
                                        <?php endforeach; ?> 
                                    <?php endforeach; ?>                                    
                                        <input type="hidden" name="pauta_id" value="<?=$pautaOpcaoResposta->getPauta()->getId();?>">
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" >Salvar</button>
                            <!-- onclick="return confirmaSalvar();" -->
                        </div><!-- Fim Botões -->
                    </form><!-- Fim Form -->                
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