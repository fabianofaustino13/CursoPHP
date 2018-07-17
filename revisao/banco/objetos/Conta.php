<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Cliente</title>
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
	<!-- Início do container -->
	<div class="container" >

	<!-- Form -->
	<form method="get" action="CadastrarCliente.php">

		<!-- Div1 -->
		<div class="form-row">
			<div class="col-md-10 mb-3">
				<label><h2>Dados do Cliente</h2></label>
			</div>
			<!-- Nome -->
			<div class="col-md-10 mb-3">
				<label for="nome" class="required">Nome</label>
				<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" />
			</div>
			<!-- Fim nome -->

			<!-- Agência -->
			<div class="col-md-5 mb-3">
				<label for="agencia" class="required">Agência</label>
				<input type="text" class="form-control" id="agencia" name="agencia" placeholder="Agência" />
			</div>
			<!-- Fim Agência -->

			<!-- Conta -->
			<div class="col-md-5 mb-3">
				<label for="conta" class="required">Conta</label>
				<input type="text" class="form-control" id="conta" name="conta" maxlength="11" placeholder="Conta" />
			</div>
			<!-- Fim Conta -->

			<!-- Saldo -->
			<div class="col-md-3 mb-3">
				<label for="saldo" class="required">Saldo</label>
				<input type="email" class="form-control" id="saldo" name="saldo" placeholder="Saldo" />
			</div>
			<!-- Fim Saldo -->

		</div>
		<!-- Fim Div1 -->

		<!-- Botões -->
		<div class="submit-row">
			<button type="submit" value="cadastrar" class="btn btn-success">Cadastrar</button>
			<button type="reset" class="btn btn-warning">Limpar</button>
		</div>
		<!-- Fim Botões -->

	</form>
	<!-- Fim Form -->
	</div>  
<!-- Fim do container -->
</body>
</html> 