<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Assembléia</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resources/css/base.css">
	<link rel="stylesheet" type="text/css" href="resources/css/login.css">
	<link rel="stylesheet" type="text/css" href="resources/css/botoes.css">
	<link rel="stylesheet" type="text/css" href="resources/css/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="resources/css/home.css">
</head>
<body>
    <!-- Menu lateral -->
    <div class="sidenav">
        <li>
            <a href="home.html"><i class="fa fa-home"></i> <span>Home</span></a>
        </li>  
        
        <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Assembléia</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
                <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Cadastrar</span>  
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="cadastrar-assembleia.php">Assembleia</a>
                    <a href="cadastrar-assembleia-pauta.php">Pauta</a>
                    <a href="cadastrar-tipo-assembleia.php">Tipo de Assembleia</a>
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
		<form method="get" action="cadTipoAssembleia.php">

			<!-- Div1 -->
			<div class="form-row">

				<div class="col-md-10 mb-3">
					<label><h2>Cadastro do Tipo de Assembléia</h2></label>
				</div>
				<!-- Nome do tipo da assembléia -->
				<div class="col-md-10 mb-3">
					<label for="tipo-nome-assembleia" class="required">Tipo de Assembleia</label>
					<input type="text" class="form-control" id="tipo-nome-assembleia" name="tipo-nome-assembleia" placeholder="Assembléia Ordinária" required />
				</div>
				<!-- Fim Nome do tipo da assembléia  -->
				
			</div>
			<!-- Fim Div1 -->

			<!-- Botões -->
			<div class="submit-row">
				<button type="submit" value="Salvar" class="btn btn-success">Salvar</button>
				<button type="reset" class="btn btn-warning">Limpar</button>
			</div>
			<!-- Fim Botões -->

		</form>
<!-- Fim Form -->
</div>  
<!-- Fim do container -->
</body>
</html> 