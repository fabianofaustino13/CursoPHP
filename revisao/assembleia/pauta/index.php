<?php require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Pauta.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/PautaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 
$dao = new PautaDAO();
$pauta = new Pauta();

$dao2 = new AssembleiaDAO();
$assembleia = new Assembleia();
$assembleias = $dao2->findAll();

$dao3 = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
$tipoAssembleias = $dao3->findAll();
if (isset($_POST['atualizar']) && $_POST['atualizar'] == 'atualizar') {
    $pautas2 = $dao->findAllAssembleia($_POST['idAss']);
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $pauta->setNome(strtoupper($_POST['nome']));
    $pauta->setDescricao(strtoupper($_POST['descricao']));
    $pauta->setFkPauAss($_POST['assembleia']);
    $teste = $_POST['assembleia'];
    $pautas2 = $dao->findAllAssembleia($teste);

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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Pauta</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/base.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/botoes.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/home.css">  
</head>
<body>
    <!-- Menu lateral -->
    <div class="sidenav">
        <li>
            <a href="../index.php"><i class="fa fa-home"></i> <span>Home</span></a>
        </li>  
        <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Assembléia</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Cadastrar</span>  
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="../adimplente/index.php">Adimplente</a>  
                <a href="../assembleia/index.php">Assembleia</a>  
                <a href="../bloco/index.php">Bloco</a>                
                <a href="../pauta/index.php">Pauta</a>
                <a href="../opcaoResposta/index.php">Resposta</a>                 
                <a href="../tipoAssembleia/index.php">Tipo de Assembleia</a>
            </div>
            <a href="visualizar-assembleia.php">Visualizar</a>
        </div>
        <button class="dropdown-btn"><i class="fa fa-users"></i> <span>Morador</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="cadastrar-morador.php">Cadastrar</a>
            <a href="#">Visualizar</a>
        </div>
    </div>  
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
    <!-- Fim menu lateral -->

	<!-- Início do container -->
	<div class="container">
        <?php $idAssembleia ?>
        <div class="row" style="margin-top: 50px; margin-left:100px;">
            <fieldset>
                <legend>Cadastro de Pautas</legend>
                <form method="post" action="index.php"><!-- Form Geral -->
                    <div class="form-row"><!-- Div1 -->
                        <label for="assembleia" class="required">Selecione uma Assembléia vigente</label>
                        <div class="col-md-12 mb-3"><!-- Tipo de Assembleia -->
                            <div class="form-group">
                                <select class="form-control" id="assembleia" name="assembleia">
                                    <?php
                                        $data = date ("Y-m-d"); //Data de hoje no formato do banco
                                        $data2 = date ("d-m-Y"); //Data de hoje no formato BR
                                        //echo"<input type='date' value='$data' name='date'";
                                        foreach ($assembleias as $assembleia): ?>
                                        <?php if ($assembleia->getData() >= $data): ?> 
                                        <option id="<?=$assembleia->getId();?>" value="<?=$assembleia->getId();?>"> 
                                            <?=$assembleia->getId() . " - " . $assembleia->getNome() . " - " . $data2; ?> <?php endif;?>
                                        </option> 
                                        <?php endforeach; 
                                    ?>                                    
                                </select> 
                            </div>                            
                        </div>  
                                           
                        <div class="col-md-12 mb-3"><!-- Nome da pauta -->
                            <label for="nome" class="required">Pauta</label>
                            <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                            <input type="text" class="form-control" id="nome" name="nome" value="<?=$pauta->getNome();?>" maxlength="100" placeholder="Nome breve para pauta" required />
                        </div><!-- Fim Nome da pauta -->

                        <div class="col-md-12 mb-3">
                        <label for="descricao">Descrição</label>
                            <input type="textarea" class="form-control" id="descricao" name="descricao" value="<?=$pauta->getDescricao();?>" maxlength="1000" placeholder="Descrição..."/>
                        </div>
                        <!-- <div class="col-md-12 mb-3"> 
                            <label for="descricao">Descrição</label>
                            <br/>
                            <textarea placeholder="Descrição...." cols="124" rows="2" id="descricao" name="descricao" value="<?=$pauta->getDescricao();?>"></textarea>
                            <br/>
                        </div> -->


                    </div><!-- Fim Div1 -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                    </div>
                    <!-- Fim Botões -->
                </form> <!-- Fim Form Geral-->
            </fieldset>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Pautas da Assembléia Selecionada</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Pauta</th>
                            <th>Descrição</th>
                            <th>Id Assembleia</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>

                <form method="post" action="index.php"><!-- Form Geral -->
                    <div class="form-row"><!-- Div1 -->
                        <label for="assembleia" class="required">Escolha a Assembléia vigente</label>
                        <div class="col-md-12 mb-3"><!-- Tipo de Assembleia -->
                            <div class="form-group">
                                <select class="form-control" id="idAss" name="idAss">
                                    <?php
                                        $data = date ("Y-m-d"); //Data de hoje no formato do banco
                                        $data2 = date ("d-m-Y"); //Data de hoje no formato BR
                                        //echo"<input type='date' value='$data' name='date'";
                                        foreach ($assembleias as $assembleia): ?>
                                        <?php if ($assembleia->getData() >= $data): ?> 
                                        <option id="<?=$assembleia->getId();?>" value="<?=$assembleia->getId();?>"> 
                                            <?=$assembleia->getId() . " - " . $assembleia->getNome() . " - " . $data2; ?> <?php endif;?>
                                        </option> 
                                        <?php endforeach; 
                                    ?>                                    
                                </select> 
                            </div>                            
                        </div>                  
                        
                    </div><!-- Fim Div1 -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="atualizar" value="atualizar">atualizar</button>
                    </div>
                    <!-- Fim Botões -->
                            <?php foreach ($pautas2 as $pauta): ?>
                                <tr>
                                    <td><?=$pauta->getId()?></td>
                                    <td><?=$pauta->getNome()?></td>
                                    <td><?=$pauta->getDescricao()?></td>
                                    <td><?=$pauta->getFkPauAss()?></td>
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
                            <?php endforeach; ?>
                </form> <!-- Fim Form Geral-->






                        </tbody>
                    </table>
                </fieldset>
            </div> <!-- Fim Tabela -->
        </div> 
    </div> <!-- Fim do container -->
</body>
</html> 