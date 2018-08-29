<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 
$dao = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $tipoAssembleia->setNome(strtoupper($_POST['tipoAssembleia']));
    if ($_POST['id'] != '') {
        $tipoAssembleia->setId($_POST['id']);
    }
    $dao->save($tipoAssembleia);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $tipoAssembleia = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$tipoAssembleias = $dao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tipo de Assembléia</title>
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
    <div class="container">
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3"> <!-- Form -->
                <fieldset>
                    <legend>Dados do Tipo de Assembléia</legend>
                    <form action="index.php" method="post">
                        <label for="tipoAssembleia" class="required">Tipo de Assembléia</label>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
                            <input type="text" class="form-control" id="tipoAssembleia" name="tipoAssembleia" value="<?=$tipoAssembleia->getNome();?>" maxlength="100" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-12 mb-3"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista do Tipo de Assembléia</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Tipo de Assembléia</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($tipoAssembleias as $tipoAssembleia): ?>
                                <tr>
                                    <td><?=$tipoAssembleia->getId()?></td>
                                    <td><?=$tipoAssembleia->getNome()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>"><label></label>
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
    </div>
</body>
</html>