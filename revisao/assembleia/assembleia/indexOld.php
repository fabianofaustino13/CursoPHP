<?php require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 

include(__DIR__ . "/../administracao/logado.php");

$dao = new AssembleiaDAO();
$assembleia = new Assembleia();
$dao2 = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
$tipoAssembleias = $dao2->findAll();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $assembleia->setNome(strtoupper($_POST['nome']));
    $assembleia->setData($_POST['data']);
    $assembleia->getTipoAssembleia()->setId($_POST['tipoAssembleia']);
    if ($_POST['id'] != '') {
        $assembleia->setId($_POST['id']);
    }
    $dao->save($assembleia);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $assembleia = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$assembleias = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Assembléia</title>
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
                    <legend>Cadastro das Assembléias</legend>
                    <form method="post" action="index.php"><!-- Form -->                    
                        <div class="form-row"><!-- Div1 -->                        
                            <label for="tipoAssembleia" class="required">Tipo de Assembléia</label><br><!-- Tipo de Assembleia -->
                            <div class="col-12">
                                <div class="form-group">
                                    <?php foreach ($tipoAssembleias as $tipoAssembleia): ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?=$tipoAssembleia->getNome();?>" name="tipoAssembleia" value=<?=$tipoAssembleia->getId();?> <?=$tipoAssembleia->getId() == $assembleia->getTipoAssembleia()->getId() ? 'checked': "";?> class="custom-control-input" <?php if ($tipoAssembleia->getId() == 1):?> checked <?php endif; ?> required/>
                                            <label class="custom-control-label" for="<?=$tipoAssembleia->getNome();?>"><?=$tipoAssembleia->getNome();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>
                            <div class="col-9"><!-- Nome da assembléia -->
                                <label for="nome" class="required">Nome da Assembléia</label>
                                <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
                            </div>
                            <div class="col-3">
                                <label for="data" class="required">Data da Assembléia</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$assembleia->getNome();?>" maxlength="100" placeholder="Assembléia Ordinária" required />
                            </div><!-- Fim da assembléia  -->                         
                            <div class="col-md-3 mb-3"><!-- Data da assembléia -->
                                <input type="date" class="form-control" id="data" name="data" value="<?=$assembleia->getData();?>" required />
                            </div><!-- Fim data da assembléia -->
                        </div> <!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form><!-- Fim Form -->
                </fieldset>  
            </div>
        </div>      
        
        <div class="col-12"> <!-- Tabela -->
            <fieldset>
                <legend>Lista de Assembléias</legend>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Assembleia</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th colspan="2">Ações</th>
                    </thead>
                    <tbody>
                        <?php foreach ($assembleias as $assembleia): ?>
                            <tr>
                                <td><?=$assembleia->getId()?></td>
                                <td><?=$assembleia->getNome()?></td>
                                <td><?=$assembleia->getData()?></td>
                                <?php foreach ($tipoAssembleias as $tipoAssembleia):
                                    if ($assembleia->getTipoAssembleia()->getId() == $tipoAssembleia->getId()): ?>
                                        <td><?=$tipoAssembleia->getNome()?></td> 
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td>
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="index.php"> 
                                        <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
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
    </div><!-- Fim do container -->
</body>
</html> 