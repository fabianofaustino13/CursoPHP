<?php require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Bloco.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Adimplente.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AdimplenteDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$bloco = new Bloco();
$blocoDao = new BlocoDAO();
$adimplente = new Adimplente();
$adimplenteDao = new AdimplenteDAO();
$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDao();

if (isset($_POST['atualizar']) && $_POST['atualizar'] == 'atualizar') {
    $pautas2 = $dao->findAllAssembleia($_POST['idAss']);
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $apartamento->setNome($_POST['nome']);
    $apartamento->getBloco()->setId($_POST['blocoId']);
    $apartamento->getAdimplente()->setId($_POST['adimplenteId']);
    if ($_POST['id'] != '') {
        $apartamento->setId($_POST['id']);
    }
    $apartamentoDao->save($apartamento);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $apartamento = $apartamentoDao->findById($_POST['id']);
} 

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $apartamentoDao->remove($_POST['id']);
    header('location: index.php');
}

$apartamentos = $apartamentoDao->findAll();
$blocos = $blocoDao->findAll();
$adimplentes = $adimplenteDao->findAll();


// if (!empty($_POST['pesquisarAssembleia']) && $_POST['pesquisarAssembleia'] == 'pesquisarAssembleia') {
//     // $morador->setFkMorSin($_POST['fk']);
//     $pautasAssembleias = $dao->findPautaAssembleia($_POST['assembleia']);

// } else {
//     $pautasAssembleias = $dao->findAll();
// }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Apartamento</title> 
</head>
<body>
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>

	<!-- Início do container -->
	<div class="container">
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-6 mb-3">
                <fieldset>
                    <legend>Cadastro de Apartamento</legend>
                    <form method="post" action="index.php"><!-- Form -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-12 mb-3"> <!-- Nome da Bloco -->
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
                            <div class="col-md-12 mb-3"> <!-- Nome da Bloco -->
                                <label for="">Status</label>
                                <div class="form-group">
                                    <?php foreach ($adimplentes as $adimplente): ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?=$adimplente->getNome();?>" name="adimplenteId" value=<?=$adimplente->getId();?> <?=$adimplente->getId() == $apartamento->getAdimplente()->getId() ? 'checked': "";?> class="custom-control-input" <?php if ($adimplente->getId() == 1):?> checked <?php endif; ?> required/>
                                            <label class="custom-control-label" for="<?=$adimplente->getNome();?>"><?=$adimplente->getNome();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>
                            <div class="col-md-4 mb-3"><!-- Nome da Apartamento -->
                                <label for="nome" class="required">Apartamento</label>
                                <input type="hidden" name="id" value="<?=$apartamento->getId();?>">                           
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$apartamento->getNome();?>" maxlength="10" placeholder="705" required />
                            </div><!-- Fim Nome da Apartamento -->
                            
                        </div><!-- Fim Form -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div>
                        <!-- Fim Botões -->
                    </form> <!-- Fim Form Geral-->
                </fieldset>
            </div>
            
            <div class="col-6"> <!-- Tabela -->
                
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Apartamento</th>
                            <th>Bloco</th>
                            <th>Adimplente</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                        <?php foreach ($apartamentos as $apartamento): ?>
                            <tr>
                                <td><?=$apartamento->getId();?></td>
                                <td><?=$apartamento->getNome();?></td>
                                <td><?=$apartamento->getBloco()->getApelido();?></td>
                                <td><?=$apartamento->getAdimplente()->getNome();?></td>
                                
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
    </div> <!-- Fim do container -->
</body>
</html> 