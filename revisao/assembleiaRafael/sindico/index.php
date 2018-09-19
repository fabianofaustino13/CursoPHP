<?php 
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Sindico.class.php");
require_once(__DIR__ . "/../classes/dao/SindicoDAO.class.php");



include(__DIR__ . "/../administracao/logado.php");

$morador = new Morador();
$moradorDao = new MoradorDao();
$sindico = new Sindico();
$sindicoDao = new SindicoDAO();
$sindicoNome = '';

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $sindico->setDataInicio($_POST['dataInicio']);
    $sindico->setDataFim($_POST['dataFim']);
    $sindico->setMorador($moradorDao->findById($_POST['sindico']));
    // $sindico->setId($_POST['sindico']);
      
    if ($_POST['id'] != '') {
        $sindico->setId($_POST['id']);
    }

    $sindicoDao->save($sindico);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $sindico = $sindicoDao->findById($_POST['id']);
}


if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $sindicoDao->remove($_POST['id']);
    header('location: index.php');
}

if (!empty($_POST['pesquisarNome']) && $_POST['pesquisarNome'] == 'pesquisarNome') {
    $moradores = $sindicoDao->findById($_POST['moradorId']);
    
} else {
    $moradores = $sindicoDao->findAll();
}
$sindicos = $sindicoDao->findAll();
$moradores = $moradorDao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Síndico</title>
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
        <?php 
            //echo "<pre>";
            //echo $_SESSION['MoradorPerfil'];
            //var_dump($sindico);
            //echo "</pre>";
        ?>
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Cadastro de Síndico</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-12 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$sindico->getId();?>">
                                <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$sindico->getMorador()->getNome();?>" maxlength="100" required />
                            </div><!-- Fim Nome do Morador -->
                            
                            <div class="col-md-6 mb-3">
                                <label class="required ">Síndico?</label>
                                <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoNao" name="sindico" class="custom-control-input" value="<?=$sindico->getId();?>" checked/>
                                            <label class="custom-control-label" for="sindicoNao">Não</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoSim" name="sindico" class="custom-control-input" value="<?=$sindico->getMorador()->getId();?>" />
                                            <label class="custom-control-label" for="sindicoSim">Sim</label>
                                        </div>                           
                                </div>
                                <label for="dataInicio" class="required">Período da atividade de Síndico</label>
                                <div class="row">
                                    <div class="col-md-5 mb-3"><!-- Data Início -->
                                        <label for="dataInicio" class="required">Data Início</label>
                                        <input type="date" class="form-control" id="dataInicio" name="dataInicio" value="<?=$sindico->getDataInicio();?>" />
                                    </div>
                                    <div class="col-md-5 mb-3"><!-- Data Fim -->
                                        <label for="dataFim">Data Fim</label>
                                        <input type="date" class="form-control" id="dataFim" name="dataFim" value="<?=$sindico->getDataFim();?>" />
                                    </div><!-- Fim Nome do Morador -->
                                </div>
                            </div>                        
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-md-12 mb-3">
                <form action="index.php" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                                <div class="row" >
                                    <div class="col-md-8 mb-3" id="div_moradorId">
                                        <select class="form-control" name="moradorId">
                                        <option value="0" disabled selected>Pesquise por Morador</option>
                                            <?php foreach ($moradores as $morador): ?>
                                                <option id="<?=$morador->getId();?>" value="<?=$morador->getId();?>"> 
                                                    <?=$morador->getId() . " - " . $morador->getNome(); ?>
                                                </option> 
                                            <?php endforeach; ?>                                    
                                        </select> 
                                    </div>                                
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secodary btn-block" name="pesquisarNome" value="pesquisarNome">Pesquisar</button>
                                        </div> <!--Fim Botões -->
                                    </div>               
                            </div>
                        
                        <div class="col-12"> <!-- Tabela -->
                            <fieldset>
                                <legend>Lista dos Sindicos</legend>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Código </th>
                                        <th>Síndico</th>
                                        <th>Início</th>
                                        <th>Fim</th>
                                        <th colspan="1">Ações</th>
                                    </thead>
                                    <tbody>                        
                                        <?php 
                                        
                                            foreach ($sindicos as $sindico):?>
                                            <tr>
                                                <td><?=$sindico->getId();?></td>
                                                <td><?=$sindico->getMorador()->getId();?></td>
                                                <td><?=$sindico->getMorador()->getNome();?></td>
                                                <td><?=$sindico->getDataInicio();?></td>
                                                <td><?=$sindico->getDataFim();?></td>
                                                <td>
                                                    <form method="post" action="index.php">
                                                        <input type="hidden" name="id" value="<?=$sindico->getId();?>">
                                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                            <i class="far fa-edit"></i>
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
                </form>
            </div>
        </div> 
    </div>
    </div> <!-- Fim do container -->
</body>
</html> 