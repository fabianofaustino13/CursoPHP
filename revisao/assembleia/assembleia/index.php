<?php require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 
$dao = new AssembleiaDAO();
$assembleia = new Assembleia();
$dao2 = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
$tipoAssembleias = $dao2->findAll();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $assembleia->setNome(strtoupper($_POST['nome']));
    $assembleia->setData($_POST['data']);
    $assembleia->setTipoAssembleia($_POST['tipoAssembleia']);
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
            <a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a>
        </li>  
        
        <!-- <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Assembléia</span>  
            <i class="fa fa-caret-down"></i>
        </button> -->
        <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Cadastrar</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <button class="dropdown-btn"> <i class="fas fa-hotel"></i> <span>Assembléias</span>  
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="../assembleia/index.php">Assembléia</a>  
                <a href="../tipoAssembleia/index.php">Tipo de Assembléia</a>
            </div>
            <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Pautas</span>  
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="../pauta/index.php">Pauta</a>
                <a href="../opcaoResposta/index.php">Resposta</a>                 
            </div>
            <a href="../morador/index.php"><i class="fa fa-users"></i> <span>Morador</span> </a>
            <a href="../sindico/index.php"><i class="fa fa-user"></i> <span>Síndico</span> </a>
        </div>
        <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Visualizar</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <button class="dropdown-btn"> <i class="fas fa-hotel"></i> <span>Assembléias</span>  
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="../assembleia/index.php">Assembléia</a>  
                <a href="../tipoAssembleia/index.php">Tipo de Assembléia</a>
            </div>
            <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Pautas</span>  
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="../pauta/index.php">Pauta</a>
                <a href="../opcaoResposta/index.php">Resposta</a>                 
            </div>
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
                                            <input type="radio" id="<?=$tipoAssembleia->getNome();?>" name="tipoAssembleia" value=<?=$tipoAssembleia->getId();?> class="custom-control-input" <?php if ($tipoAssembleia->getId() == 1):?> checked <?php endif; ?>/>
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
                                    if ($assembleia->getTipoAssembleia() == $tipoAssembleia->getId()): ?>
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