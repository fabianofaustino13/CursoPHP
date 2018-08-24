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

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $pauta->setNome($_POST['nome']);
    $pauta->setDescricao($_POST['descricao']);
    $pauta->setFkPauAss($_POST['assembleia']);
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
                    <a href="../assembleia/index.php">Assembleia</a>
                    <a href="../pauta/index.php">Pauta</a>
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
        
    <div class="main">
    <!-- <h2>Sidebar Dropdown</h2>
    <p>Click on the dropdown button to open the dropdown menu inside the side navigation.</p>
    <p>This sidebar is of full height (100%) and always shown.</p>
    <p>Some random text..</p> -->

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
	<div class="container" style="margin-top: 50px;">
        <fieldset>
            <legend>Cadastro de Pautas</legend>
            <!-- Form -->
            <form method="post" action="index.php">
                <!-- Div1 -->
                <div class="form-row">

                    <!-- Tipo de Assembleia -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            
                                <label for="assembleia" class="required">Selecione uma Assembléia vigente</label>
                                <select class="form-control" name="assembleia">
                                    <?php
                                       $data = date ("Y-m-d");
                                       //echo"<input type='date' value='$data' name='date'";
                                        foreach ($assembleias as $assembleia): ?>
                                           <?php if ($assembleia->getData() >= $data): ?> 
                                           <option value="<?=$assembleia->getId();?> "> 
                                                <?=$assembleia->getId() . " - " . $assembleia->getNome(); ?> <?php endif;
                                    ?>
                                            </option> 
                                        <?php endforeach; ?>
                                </select> 
                            
                        </div>
                    </div>




                    <!-- Nome da pauta -->
                    <div class="col-md-12 mb-3">
                        <label for="nome" class="required">Pauta</label>
                        <input type="hidden" name="id" value="<?=$pauta->getId();?>">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$pauta->getNome();?>" maxlength="100" placeholder="Nome breve para pauta" required />
                    </div>
                    <!-- Fim da assembléia  -->
                
                    <!-- Data da assembléia -->
                    <div class="col-md-12 mb-3">
                        <label for="descricao">Descrição</label>
                        <br/>
                        <textarea placeholder="Descrição...." maxlength="1000" cols="135" rows="2" id="descricao" name="descricao" value="<?=$pauta->getDescricao();?>"></textarea>
                        <br/>
                    </div>
                    <!-- Fim data da assembléia -->

                </div>
                <!-- Fim Div1 -->

                <!-- Botões -->
                <!-- <div class="submit-row">
                    <button type="submit" name="salvar" value="salvar" class="btn btn-success">Salvar</button>
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                </div>
                <!-- Fim Botões -->
		    </form>
        </fieldset>
        <!-- Fim Form -->
        <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Assembléias Disponíveis</legend>
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
                                        if ($assembleia->getFkTda() == $tipoAssembleia->getId()): ?>
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
    </div>  
    <!-- Fim do container -->
</body>
</html> 