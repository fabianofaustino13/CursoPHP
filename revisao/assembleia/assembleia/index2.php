<?php require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php"); ?>
<?php 
$dao = new AssembleiaDAO();
$assembleia = new Assembleia();
$dao2 = new TipoAssembleiaDAO();
$tipoAssembleia = new TipoAssembleia();
$tipoAssembleias = $dao2->findAll();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $assembleia->setNome($_POST['sexo']);
    $assembleia->setSigla($_POST['sigla']);
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
                    <a href="./assembleia/index.php">Assembleia</a>
                    <a href="./assembleiaPauta/index.php">Pauta</a>
                    <a href="./tipoAssembleia/index.php">Tipo de Assembleia</a>
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
	<div class="container" >

		<!-- Form -->
		<!-- <form method="get" action="cadAssembleia.php"> -->
			<!-- Div1 -->
			<div class="form-row">
				<div class="col-md-10 mb-3">
					<label><h2>Cadastro das Assembléias</h2></label>
				</div>
				<!-- Tipo de Assembleia -->
				<div class="col-md-6 mb-3">
					<div class="form-group">
						<form method="post" action="../tipoAssembleia/index.php">
							<label for="tipoAssembleia" class="required">Tipo de Assembléia</label>
                            <select class="form-control" name="tipoAssembleia">
								<?php
									foreach ($tipoAssembleias as $tipoAssembleia): ?>
										<option value="<?=$tipoAssembleia->getId();?>"> 
											<?=$tipoAssembleia->getNome();
								?>
										</option> 
									<?php endforeach; ?>
    						</select> 
							<input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
							<button type="submit" class="btn btn-success" name="editar" value="editar">
								<i class="far fa-edit"></i>
							</button>
                            
							<input type="hidden" name="id" value="<?=$tipoAssembleia->getId();?>">
							<button type="submit" class="btn btn-danger" name="excluir" value="excluir">
								<i class="far fa-trash-alt"></i>
							</button>
                        </form>
					</div>
				</div>

				<div class="col-md-3 mb-3">
					<div>
						<label class="required">Tipo de Assembléia</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="ordinaria" name="tipoAssembleia" value="ordinaria" class="custom-control-input" required checked />
						<label class="custom-control-label" for="ordinaria">Ordinária</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="extraordinaria" name="tipoAssembleia" value="extraordinaria" class="custom-control-input" />
						<label class="custom-control-label" for="extraordinaria">Extraordinária</label>
					</div>
				</div>
				<!-- Fim Tipo de Assembleia -->
				<!-- Nome da assembléia -->
				<div class="col-md-10 mb-3">
					<label for="nome-assembleia" class="required">Nome da Assembléia</label>
					<input type="text" class="form-control" id="nome-assembleia" name="nome-assembleia" placeholder="Assembléia Ordinária" required />
				</div>
				<!-- Fim da assembléia  -->

				<!-- Descrição da assembléia -->
				<!-- <div class="col-md-10 mb-3">
					<label for="descricao-assembleia">Descrição</label>
					<input type="text" class="form-control" id="descricao-assembleia" name="descricao-assembleia" placeholder="Descrição para assembléia" />
				</div> -->
				<!-- Fim Descrição da assembléia -->
	
				<!-- Data da assembléia -->
				<div class="col-md-3 mb-3">
					<label for="data-assembleia" class="required">Data da Assembléia</label>
					<input type="date" class="form-control" id="data-assembleia" name="data-assembleia" required />
				</div>
				<!-- Fim data da assembléia -->

			</div>
			<!-- Fim Div1 -->

			<!-- Botões -->
			<div class="submit-row">
				<button type="submit" value="Salvar" class="btn btn-success">Salvar</button>
				<button type="reset" class="btn btn-warning">Limpar</button>
			</div>
			<!-- Fim Botões -->

		<!-- </form> -->
<!-- Fim Form -->
</div>  
<!-- Fim do container -->
</body>
</html> 