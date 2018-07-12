<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastrar Assembléia</title>
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="resources/css/base.css">
	<link rel="stylesheet" type="text/css" href="resources/css/login.css">
	<link rel="stylesheet" type="text/css" href="resources/css/botoes.css">
	<link rel="stylesheet" type="text/css" href="resources/css/responsive.css">
</head>
<body>
	<!-- Início do container -->
	<div class="container" >

		<!-- Form -->
		<form method="get" action="testeAssembleia.php">

			<!-- Div1 -->
			<div class="form-row">

				<div class="col-md-10 mb-3">
					<label><h2>Cadastro das Assembléias</h2></label>
				</div>
				<!-- Nome da assembléia -->
				<div class="col-md-10 mb-3">
					<label for="nome-assembleia" class="required">Nome da Assembléia</label>
					<input type="text" class="form-control" id="nome-assembleia" name="nome-assembleia" placeholder="Assembléia Ordinária" required />
				</div>
				<!-- Fim da assembléia  -->

				<!-- Descrição da assembléia -->
				<div class="col-md-10 mb-3">
					<label for="descricao-assembleia">Descrição</label>
					<input type="text" class="form-control" id="descricao-assembleia" name="descricao-assembleia" placeholder="Descrição para assembléia" />
				</div>
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

		</form>
<!-- Fim Form -->
</div>  
<!-- Fim do container -->
  
</body>
</html>