<?php require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Pauta.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/PautaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

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
    <title>Cadastrar Pauta</title> 
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
                    <legend>Cadastro de Pautas</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <label for="assembleia" class="required">Selecione uma Assembléia vigente</label>
                                <div class="col-md-12 mb-3" id="div_assembleias"><!-- Tipo de Assembleia -->
                                    <div >
                                        <select class="form-control" name="assembleia" onchange="show_pautas(this.value);">
                                            <?php
                                                $data = date ("Y-m-d"); //Data de hoje no formato do banco
                                                foreach ($assembleias as $assembleia): ?>
                                                    <?php if ($assembleia->getData() >= $data):  ?> 
                                                            <option id="<?=$assembleia->getId();?>" value="<?=$assembleia->getId();?>"> 
                                                            <?=$assembleia->getId() . " - " . $assembleia->getNome() . " - " . $assembleia->getData(); ?> <?php endif;?>
                                                        </option> 
                                                <?php endforeach; 
                                            ?>                                    
                                        </select> 
                                    </div>                            
                                </div>  
                                <div class="col-md-12 mb-3"><!-- Nome da pauta -->
                                    <label for="nome" class="required">Pauta</label>
                                    <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                                    <!-- <//?php echo "<script>alert('Id da pauta: ' + {$pauta->getId()})</script>"; ?> -->
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$pauta->getNome();?>" maxlength="100" placeholder="Nome breve para pauta" required />
                                </div><!-- Fim Nome da pauta -->

                            <div class="col-md-12 mb-3"> 
                                <label for="descricao">Descrição</label>
                                <br/>
                                <textarea placeholder="Descrição...." cols="135" rows="3" id="descricao" name="descricao"><?=$pauta->getDescricao();?></textarea>
                                <br/>
                            </div>

                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div>
                        <!-- Fim Botões -->
                    </form> <!-- Fim Form Geral-->
                </fieldset>
            </div>
           
            <div class="col-12" id="div_pautas"> <!-- Tabela -->  
                <table class="table table-striped table-hover">
                    <thead>
                        <!-- <th>#</th> -->
                        <th>Item</th>
                        <th>Pauta</th>
                        <th>Descrição</th>
                        <th>Assembleia</th>
                        <th colspan="2">Ações</th>
                    </thead>
                    <tbody>                
                        <!-- Fim Botões -->
                        <?php 
                        $i = count($pautas);
                        // echo "<script>alert('número de pautas: ' + $i)</script>";
                        $j = count($assembleias);
                        // echo "<script>alert('número de assembléias: ' + ($j-1))</script>";
                        // $ultimaAssembleia = end($pautas);
                        $num = 0;
                        foreach ($pautas as $pauta) {
                            if ($pauta->getAssembleia()->getId() == ($j-1)){
                                $num++;
                            }
                        }
                        foreach ($pautas as $pauta): ?>
                            <!-- <//?php $numAssembleia = $pauta->getAssembleia()->getId(); -->
                            <!-- echo "<script>alert('Pautas '+{$pauta->getId()})</script>"; -->
                             <!-- echo "<script>alert('Assembleias '+{$pauta->getAssembleia()->getId()})</script>"; ?> -->
                            <?php if ($pauta->getAssembleia()->getId() == ($j)): ?> <!--comparando se as pautas fazem parte da última assembleia cadastrada -->
                                <!-- //echo "<script>alert('Pautas '+{$pauta->getId()})</script>"; -->
                                <tr>
                                    <!-- <td><//?=$pauta->getId();?></td> -->
                                    <td><?=$num--;?></td>
                                    <td><?=$pauta->getNome();?></td>
                                    <td><?=$pauta->getDescricao();?></td>
                                    <td><?=$pauta->getAssembleia()->getNome();?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                                            <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>                                
                        <?php endif; endforeach; ?>
                        <!-- </form> Fim Form Geral -->
                    </tbody>
                </table>
            </div> <!-- Fim Tabela -->
        </div> 
    </div> <!-- Fim do container -->
    <script src="../assets/js/ajax_funcoes.js"></script>
</body>
</html> 