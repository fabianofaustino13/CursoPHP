<?php 
session_start();
if ($_SESSION['MoradorStatus'] == NULL || $_SESSION['MoradorStatus'] == 2) {
    header('location: ../assembleia/aguardando.php');
}

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Bloco.class.php");
require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Adimplente.class.php");
require_once(__DIR__ . "/../classes/dao/AdimplenteDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Ocupacao.class.php");
require_once(__DIR__ . "/../classes/dao/OcupacaoDAO.class.php");

$adimplente = new Adimplente();
$adimplenteDao = new AdimplenteDAO();

$ocupacao = new Ocupacao();
$ocupacaoDao = new OcupacaoDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDao();

$teste = "inicio";
if (isset($_POST['atualizar']) && $_POST['atualizar'] == 'atualizar') {
    $pautas2 = $dao->findAllAssembleia($_POST['idAss']);
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $apartamento->setNome($_POST['nome']);
    $apartamento->getBloco()->setId($_POST['blocoId']);
    $apartamento->getOcupacao()->setId($_POST['ocupacao']);
    $apartamento->getAdimplente()->setId($_POST['adimplenteId']);
    if ($_POST['id'] != '') {
        $apartamento->setId($_POST['id']);
    }
    $teste = $apartamentoDao->save($apartamento);
    // header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $apartamento = $apartamentoDao->findById($_POST['id']);
} 

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $apartamentoDao->remove($_POST['id']);
    header('location: index.php');
}

$apartamentos = $apartamentoDao->findAll();
$apartamentosNice = $apartamentoDao->findAllNice();
$apartamentosLyon = $apartamentoDao->findAllLyon();
$blocos = $blocoDao->findAll();
$ocupacoes = $ocupacaoDao->findAll();
$adimplentes = $adimplenteDao->findAll();


// if (!empty($_POST['pesquisarAssembleia']) && $_POST['pesquisarAssembleia'] == 'pesquisarAssembleia') {
//     // $morador->setFkMorSin($_POST['fk']);
//     $pautasAssembleias = $dao->findPautaAssembleia($_POST['assembleia']);

// } else {
//     $pautasAssembleias = $dao->findAll();
// }

?>
<?php if ($_SESSION['MoradorPerfilID'] > 3) {
    header('location: /cursoPHP/revisao/assembleia/');
}?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Apartamento</title> 
</head>
<body>
    <div class="container-fluid">
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    <!-- <div class="col-12" style="text-align: center; color:red">
        <//?=$apartamento->getId();?>
    </div> -->
    <!-- <div class="col-12" style="text-align: center; color:red">
        <//?=var_dump($teste);?>
    </div> -->
	<!-- Início do container -->
    <div class="containerMenuDireita">
        <div class="row" style="margin-top: 2%;">
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Cadastro de Apartamento</legend>
                    <form id="Form_Cad_Apartamento" name="Form_Cad_Apartamento" method="post" action="index.php" onsubmit="return checa_Cad_Apartamento(this)"><!-- Form -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-2 mb-3"> <!-- Nome da Bloco -->
                                <label for="assembleia" class="required">Selecione um Bloco</label>
                                <div class="form-group">
                                    <?php foreach ($blocos as $bloco): ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?=$bloco->getApelido();?>" name="blocoId" value=<?=$bloco->getId();?> <?=$bloco->getId() == $apartamento->getBloco()->getId() ? 'checked': "";?> class="custom-control-input" <?php if ($bloco->getId() == 1):?> checked <?php endif; ?> required/>
                                            <label class="custom-control-label" for="<?=$bloco->getApelido();?>"><?=$bloco->getApelido();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>
                            <div class="col-md-1 mb-3"><!-- Nome da Apartamento -->
                                <label for="nome" class="required">Apartamento</label>
                                <input type="hidden" name="id" value="<?=$apartamento->getId();?>">                           
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$apartamento->getNome();?>" maxlength="4" placeholder="705"  />
                            </div><!-- Fim Nome da Apartamento -->
                            <div class="col-md-1 mb-3">
                            </div>
                            <div class="col-md-3 mb-3"> <!-- Situação Financeira -->
                                <label for="" class="required">Situação Financeira</label>
                                <div class="form-group">
                                    <?php foreach ($adimplentes as $adimplente): ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?=$adimplente->getNome();?>" name="adimplenteId" value=<?=$adimplente->getId();?> <?=$adimplente->getId() == $apartamento->getAdimplente()->getId() ? 'checked': "";?> class="custom-control-input" <?php if ($adimplente->getId() == 1):?> checked <?php endif; ?> required/>
                                            <label class="custom-control-label" for="<?=$adimplente->getNome();?>"><?=$adimplente->getNome();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>
                            <div class="col-md-3 mb-3"> <!-- Ocupação -->
                                <label for="" class="required">Ocupação</label>
                                <div class="form-group">
                                    <?php foreach ($ocupacoes as $ocupacao): ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?=$ocupacao->getNome();?>" name="ocupacao" value=<?=$ocupacao->getId();?> <?=$ocupacao->getId() == $apartamento->getOcupacao()->getId() ? 'checked': "";?> class="custom-control-input" <?php if($ocupacao->getId() == 2):?> checked <?php endif; ?> required/>
                                            <label class="custom-control-label" for="<?=$ocupacao->getNome();?>"><?=$ocupacao->getNome();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>
                        </div><!-- Fim Form -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div>
                        <!-- Fim Botões -->
                    </form> <!-- Fim Form Geral-->
                </fieldset>
            </div>
            
            <div class="col-md-6 mb-3"> <!-- Tabela Nice -->                
                <table class="table table-striped table-hover">
                    <thead>
                        <!-- <th>#</th> -->
                        <th>BLOCO</th>
                        <th>APARTAMENTO</th>
                        <th>SITUAÇÃO FINANCEIRA</th>
                        <th>OCUPAÇÃO</th>
                        <th colspan="2">AÇÕES</th>
                    </thead>
                    <tbody>
                        <?php foreach ($apartamentosNice as $apartamento): ?>
                            <tr>
                                <!-- <td></?=$apartamento->getId();?></td> -->
                                <td><?=$apartamento->getBloco()->getApelido();?></td>
                                <td><?=$apartamento->getNome();?></td>
                                <td><?=$apartamento->getAdimplente()->getNome();?></td>
                                <td><?=$apartamento->getOcupacao()->getNome();?></td>
                               
                                <td>
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="index.php"> 
                                        <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                        <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!-- Fim Tabela Lyon-->
            <div class="col-md-6 mb-3"> <!-- Tabela -->                
                <table class="table table-striped table-hover">
                    <thead>
                        <!-- <th>#</th> -->
                        <th>BLOCO</th>
                        <th>APARTAMENTO</th>
                        <th>SITUAÇÃO FINANCEIRA</th>
                        <th>OCUPAÇÃO</th>
                        <th colspan="2">AÇÕES</th>
                    </thead>
                    <tbody>
                        <?php foreach ($apartamentosLyon as $apartamento): ?>
                            <tr>
                                <!-- <td></?=$apartamento->getId();?></td> -->
                                <td><?=$apartamento->getBloco()->getApelido();?></td>
                                <td><?=$apartamento->getNome();?></td>
                                <td><?=$apartamento->getAdimplente()->getNome();?></td>
                                <td><?=$apartamento->getOcupacao()->getNome();?></td>
                                
                                <td>
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="index.php"> 
                                        <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                        <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!-- Fim Tabela -->
        </div> 
    </div>
</div> <!-- Fim do container -->
<script src="../assets/js/ajax_valida_apartamentos.js"></script>
</body>
</html> 