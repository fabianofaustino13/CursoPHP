<?php require_once(__DIR__ . "/../classes/modelo/Morador.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php"); ?>
<?php 
$dao = new MoradorDAO();
$morador = new Morador();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $morador->setNome(strtoupper($_POST['nome']));
    $morador->setLogin(strtoupper($_POST['login']));

    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    if ($senha == $senha2) {
        $morador->setSenha($_POST['senha']);
    } else {
        echo("senha não confere.");
    }
    $morador->setUltimoAcesso($_POST['ultimoAcesso']);
    $morador->setFoto($_POST['foto']);
    $morador->setFkMorSin($_POST['sindico']);
    if ($_POST['id'] != '') {
        $morador->setId($_POST['id']);
    }
    $dao->save($morador);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $morador = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$moradores = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Morador</title>
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
                <a href="../adimplente/index.php">Adimplente</a>  
                <a href="../assembleia/index.php">Assembleia</a>  
                <a href="../bloco/index.php">Bloco</a>                
                <a href="../pauta/index.php">Pauta</a>
                <a href="../opcaoResposta/index.php">Resposta</a>                 
                <a href="../tipoAssembleia/index.php">Tipo de Assembleia</a>
            </div>
            <a href="visualizar-assembleia.php">Visualizar</a>
        </div>
        <button class="dropdown-btn"><i class="fa fa-users"></i> <span>Morador</span>  
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="../morador/index.php">Cadastrar</a>
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
    <!-- Fim menu lateral -->

	<!-- Início do container -->
	<div class="container">
        <div style="margin-top: 50px; margin-left:100px;">
            <fieldset>
                <legend>Cadastro de Moradores</legend>
                <form method="post" action="index.php"><!-- Form Geral -->
                    <div class="form-row"><!-- Div1 -->
                        <div class="col-md-12 mb-3"><!-- Nome do Morador -->
                            <label for="nome" class="required">Nome</label>
                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
                            <input type="text" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" required />
                        </div><!-- Fim Nome do Morador -->
                        <div class="col-md-4 mb-3">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" id="login" name="login" value="<?=$morador->getLogin();?>" maxlength="25" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="senha">Senha</label>
                            <input type="text" class="form-control" id="senha" name="senha" maxlength="25" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="senha2">Confirme a Senha</label>
                            <input type="text" class="form-control" id="senha2" name="senha2" maxlength="25" />
                        </div>            
                        <div class="col-md-6 mb-3">
                            <label class="required ">Síndico?</label>
                            <div class="form-group">                           
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="sindicoNao" name="sindico" value="<?=$morador->getFkMorSin();?>" class="custom-control-input" checked/>
                                        <label class="custom-control-label" for="sindicoNao">Não</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="sindicoSim" name="sindico" value="<?=$morador->getId();?>" class="custom-control-input" />
                                        <label class="custom-control-label" for="sindicoSim">Sim</label>
                                    </div>                           
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?php  $data = date ("Y-m-d H:i:s"); //Data de hoje no formato do banco
                                    $data2 = date ("d-m-Y H:i:s"); //Data de hoje no formato BR?>
                            <label for="ultimoAcesso">Acessado em</label>
                            <input type="text" class="form-control" id="ultimoAcesso" name="ultimoAcesso" disabled="disabled" value="<?=$data;?>" />
                        </div>   




                    </div><!-- Fim Div1 -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                    </div><!-- Fim Botões -->
                </form> <!-- Fim Form Geral -->
            </fieldset>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Moradores</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Ultimo Acesso</th>
                            <th>Sindico</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($moradores as $morador):?>
                                <tr>
                                    <td><?=$morador->getId()?></td>
                                    <td><?=$morador->getNome()?></td>
                                    <td><?=$morador->getLogin()?></td>
                                    <td><?=$morador->getUltimoAcesso()?></td>
                                    <td><?=$morador->getFkMorSin()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
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
    </div> <!-- Fim do container -->
</body>
</html> 