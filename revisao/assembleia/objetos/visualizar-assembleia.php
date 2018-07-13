<!DOCTYPE html>
<html>
<head>
	<title>Assembléias</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resources/css/base.css">
	<link rel="stylesheet" type="text/css" href="resources/css/tabela.css">
	<!-- <link rel="stylesheet" type="text/css" href="resources/css/login.css"> -->
	<link rel="stylesheet" type="text/css" href="resources/css/botoes.css">
	<link rel="stylesheet" type="text/css" href="resources/css/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="resources/css/home.css">
</head>
<body>
		<div class="sidenav">
                <li>
                    <a href="home.html"><i class="fa fa-home"></i> <span>Home</span></a>
                </li>  
                
                <button class="dropdown-btn"><i class="fa fa-bars"></i> <span>Assembléia</span>  
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="cadastrar-assembleia.php">Criar Assembleia</a>
                    <a href="cadastrar-assembleia-pauta.php">Criar Pauta</a>
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
	

	<!-- Início do container -->
	<div class="container" >

		<!-- Form -->
		<form method="get" action="testeAssembleia.php">

			<!-- Div1 -->
			<div class="form-row">

				<div class="col-md-10 mb-3">
					<!-- <label><h2>Assembbléias</h2></label> -->
                </div>
				<table id="playlistTable">
					<caption>Top</caption>
						<thead>
							<tr>
								<th class="celula1"></th>
								<th class="celula2">Assembléias</th>
								<th class="celula3">Data</th>
								<th class="celula4">Cadastrar Pauta</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td class="coluna-editar">5</td>
								<td >Hide You</td>
								<td class="coluna-editar">15/07/2018</td>
								<td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-edit fa-2x icon-ativado"></i></a></td>
							</tr>

							<tr>
								<td class="coluna-editar">4</td>
								<td>Teste array_diff_assoc</td>
								<td class="coluna-editar">15/07/2017</td>
								<td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-pencil-square fa-2x icon-ativado"></i></a></td>
							</tr>

							<tr>
								<td class="coluna-editar">3</td>
								<td>Fix You</td>
								<td class="coluna-editar">15/07/2016</td>
								<td class="coluna-editar"><i class="fa fa-pencil-square-o fa-2x icon-desativado"></i><a href="cadastrar-assembleia-pauta.php"></a></td>
							</tr>

							<tr>
								<td class="coluna-editar">2</td>
								<td>Maps</td>
								<td class="coluna-editar">15/07/2015</td>
								<td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-pencil fa-2x icon-ativado"></i></a></td>
							</tr>

							<tr>
								<td class="coluna-editar">1</td>
								<td>Ask me how I am</td>
								<td class="coluna-editar">15/07/2014</td>
								<td class="coluna-editar"><i class="fa fa-pencil fa-2x icon-desativado"></i></td>
							</tr>

							
						</tbody>
			</table>

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