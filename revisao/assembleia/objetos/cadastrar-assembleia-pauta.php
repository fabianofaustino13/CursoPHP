<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Pauta</title>
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
        <button type="submit" value="Salvar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </div>
    <!-- Fim Botões -->

</form>
<!-- Fim Form -->

                <table id="playlistTable">
					<caption>Top</caption>
                    <thead>
                        <tr>
                                <th class="celula1">Item</th>
                                <th class="celula2">Pauta</th>
                                <th class="celula3 coluna-editar">Editar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="coluna-editar">1</td>
                            <td>AAAAAAAAA</td>
                            <td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-edit fa-2x icon-ativado"></i></a></td>
                        </tr>

                        <tr>
                            <td class="coluna-editar">2</td>
                            <td>BBBBBBBBBB</td>
                            <td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-pencil-square fa-2x icon-desativado"></i></a></td>
                        </tr>

                        <tr>
                            <td class="coluna-editar">3</td>
                            <td>Fix You</td>
                            <td class="coluna-editar"><i class="fa fa-pencil-square-o fa-2x icon-ativado"></i><a href="cadastrar-assembleia-pauta.php"></a></td>
                        </tr>

                        <tr>
                            <td class="coluna-editar">4</td>
                            <td>Maps</td>
                            <td class="coluna-editar"><a href="cadastrar-assembleia-pauta.php"><i class="fa fa-pencil fa-2x icon-ativado"></i></a></td>
                        </tr>

                        <tr>
                            <td class="coluna-editar">5</td>
                            <td>Ask me how I am</td>
                            <td class="coluna-editar"><i class="fa fa-pencil fa-2x icon-ativado"></i></td>
                        </tr>

                        
                    </tbody>
			    </table>

</div>  
<!-- Fim do container -->
</body>
</html>