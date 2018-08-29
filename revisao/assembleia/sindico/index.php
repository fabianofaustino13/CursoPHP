<?php require_once(__DIR__ . "/../classes/modelo/Morador.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Sindico.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/SindicoDAO.class.php"); ?>

<?php 
$morador = new Sindico();
$dao = new SindicoDAO();
$sindicoNome = '';

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $morador->setNome(strtoupper($_POST['nome']));
    $morador->setFkMorSin($_POST['sindico']);
    // if ($_POST['id'] != '') {
    //     $morador->setId($_POST['id']);
    // }
    
    if ($_POST['id'] != null) {
    $moradores = $dao->findAll();
    foreach ($moradores as $morador) {
            $morador->setFkMorSin($_POST['sindico']);
            header('location: index.php');
            $dao->save($morador);

        }
    }
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $morador = $dao->findById($_POST['id']);
}


if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}

if (!empty($_POST['pesquisarNome']) && $_POST['pesquisarNome'] == 'pesquisarNome') {
    // $morador->setFkMorSin($_POST['fk']);
    $moradores = $dao->findByNome($_POST['nome']);

} else {
    $moradores = $dao->findAll();
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Síndico</title>
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
                    <legend>Cadastro de Síndico</legend>
                    <form method="post" action="index.php"><!-- Form Geral -->
                        <div class="form-row"><!-- Div1 -->
                            <div class="col-md-12 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" required />
                            </div><!-- Fim Nome do Morador -->
                            
                            <div class="col-md-6 mb-3">
                                <label class="required ">Síndico?</label>
                                <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoNao" name="sindico" class="custom-control-input" value="<?=$morador->getFkMorSin();?>" checked/>
                                            <label class="custom-control-label" for="sindicoNao">Não</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sindicoSim" name="sindico" class="custom-control-input" value="<?=$morador->getId();?>" />
                                            <label class="custom-control-label" for="sindicoSim">Sim</label>
                                        </div>                           
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
                        <div class="col-md-5 mb-3">
                            <!-- <label for="nome" class="required">Nome do Morador</label> -->
                            <!-- <input type="hidden" name="id" value="<?=$morador->getNome();?>"> -->
                            <!-- <input type="hidden" name="fk" value="<?=$morador->getFkMorSin();?>"> -->
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="35" placeholder="Informe o nome do morador..." />
                            </div>
                            <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-secodary btn-block" name="pesquisarNome" value="pesquisarNome">Pesquisar</button>
                            </div> <!--Fim Botões -->
                        </div>
                        
                        <div class="col-12"> <!-- Tabela -->
                            <fieldset>
                                <legend>Lista dos Moradores</legend>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Nome do Morador</th>
                                        <th>Síndico</th>
                                        <th colspan="1">Ações</th>
                                    </thead>
                                    <tbody>                        
                                        <?php 
                                        
                                            foreach ($moradores as $morador) {
                                                $sindicoId = $morador->getFkMorSin();
                                                // echo "<script>alert('$sindicoId');</script>";
                                            }
                                            $moradores2 = $dao->findAll();
                                            foreach ($moradores2 as $morador) {
                                                $moradorId = $morador->getId();
                                                // $sindico = $morador->getId();
                                                // $sindicoId = $morador->getFkMorSin(); 
                                                // $sindicoNome = $morador->getNome();
                                                // echo "<script>alert($sindicoId);</script>";
                                                // echo "<script>alert($moradorId);</script>";
                                                // echo "<script>alert('$sindicoId');</script>";
                                                if ($sindicoId == $moradorId) {
                                                    $sindicoNome = $morador->getNome();
                                                    // echo "<script>alert($sindico);</script>";
                                                } 
                                            }
                                        
                                            foreach ($moradores as $morador):?>
                                            <tr>
                                                <td><?=$morador->getId()?></td>
                                                <td><?=$morador->getNome()?></td>
                                                <td><?=$sindicoNome?></td>
                                                <td>
                                                    <form method="post" action="index.php">
                                                        <input type="hidden" name="id" value="<?=$morador->getId();?>">
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
    </div> <!-- Fim do container -->
</body>
</html> 