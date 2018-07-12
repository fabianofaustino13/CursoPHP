<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuário</title>
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
		<form method="get" action="testeMorador.php">

			<!-- Div1 -->
			<div class="form-row">

				<!-- Nome -->
				<div class="col-md-4 mb-3">
					<label for="nome" class="required">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required />
				</div>
				<!-- Fim nome -->

				<!-- Sobrenome -->
				<div class="col-md-8 mb-3">
					<label for="sobrenome">Sobrenome</label>
					<input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" />
				</div>
				<!-- Fim sobrenome -->

				<!-- CPF -->
				<div class="col-md-4 mb-3">
					<label for="cpf" class="required">CPF</label>
					<input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" placeholder="Somente números" required />
				</div>
				<!-- Fim CPF -->

				<!-- E-mail -->
				<div class="col-md-3 mb-3">
					<label for="email" class="required">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required />
				</div>
				<!-- Fim e-mail -->

				<!-- Telefone -->
				<div class="col-md-3 mb-3">
					<label for="fone">Telefone</label>
					<input type="text" class="form-control" id="fone" name="fone" placeholder="Telefone" />
				</div>
				<!-- Fim telefone -->

				<!-- Sexo -->
				<div class="col-md-3 mb-3">
					<div>
						<label>Sexo</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="masc" name="sexo" value="masc" class="custom-control-input" required checked />
						<label class="custom-control-label" for="masc">Masculino</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="fem" name="sexo" value="fem" class="custom-control-input" />
						<label class="custom-control-label" for="fem">Feminino</label>
					</div>
					
				</div>
				<!-- Fim sexo -->

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