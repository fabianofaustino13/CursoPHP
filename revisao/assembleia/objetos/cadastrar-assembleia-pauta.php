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
		<form method="get" action="testePauta.php">

			<!-- Div1 -->
			<div class="form-row">

				<div class="col-md-10 mb-3">
					<label><h2>Cadastro das Pautas da Assembléia</h2></label>
				</div>
				<!-- Nome da assembléia -->
				<div class="col-md-10 mb-3">
					<label for="nome-assembleia" class="required">Nome da Assembléia - USAR UM SELECT</label>
					<input type="text" class="form-control" id="nome-assembleia" name="nome-assembleia" placeholder="Assembléia Ordinária" required />
				</div>
				<!-- Fim da assembléia  -->

                <!-- Nome da pauta -->
                <div class="col-md-10 mb-3">
					<label for="nome-pauta" class="required">Pauta</label>
					<input type="text" class="form-control" id="nome-pauta" name="nome-pauta" placeholder="Texto para pauta" required />
				</div>
                <!-- Fim da pauta  -->
                
                <!-- Opções de resposta para pauta -->
                <div class="col-md-6 mb-3">
					<div>
						<label class="required">Resposta - Deixar livre para o usuário cadastrar qntas opções desejar</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="corcordo" name="opcao" value="corcordo" class="custom-control-input"   />
						<label class="custom-control-label" for="corcordo">Concordo</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="discordo" name="opcao" value="discordo" class="custom-control-input" />
						<label class="custom-control-label" for="discordo">Discordo</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="indiferente" name="opcao" value="indiferente" class="custom-control-input" />
						<label class="custom-control-label" for="indiferente">Indiferente</label>
					</div>
					
				</div>
				<!-- Fim Opções de resposta para pauta -->



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