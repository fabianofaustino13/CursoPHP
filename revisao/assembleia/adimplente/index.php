<?php require_once(__DIR__ . "/../classes/modelo/Adimplente.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/AdimplenteDAO.class.php"); ?>
<?php 
$dao = new AdimplenteDAO();
$adimplente = new Adimplente();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $adimplente->setNome(strtoupper($_POST['nome']));
    $adimplente->setImagem($_POST['imagem']);
    if ($_POST['id'] != '') {
        $adimplente->setId($_POST['id']);
    }
    $dao->save($adimplente);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $adimplente = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$adimplentes = $dao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Situação Financeira</title>
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
    <!-- Fim menu lateral -->

	<!-- Início do container -->
	<div class="container">
        <div style="margin-top: 50px; margin-left:100px;">
            <fieldset>
                <legend>Situação Financeira</legend>
                <form method="post" action="index.php"><!-- Form Geral -->
                    <div class="form-row"><!-- Div1 -->
                        <div class="col-md-6 mb-3"><!-- Nome -->
                            <label for="nome" class="required">Nome</label>
                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                            <input type="text" class="form-control" id="nome" name="nome" value="<?=$adimplente->getNome();?>" maxlength="25" placeholder="Adimplente" required />
                        </div><!-- Fim Nome -->     
                        <div class="col-md-6 mb-3"><!-- Imagem -->
                            <label for="imagem">Imagem</label>
                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                            <input type="text" class="form-control" id="imagem" name="imagem" value="<?=$adimplente->getImagem();?>" />
                        </div><!-- Fim Nome -->                     
                    </div><!-- Fim Div1 -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                    </div><!-- Fim Botões -->
                </form> <!-- Fim Form Geral -->
            </fieldset>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Situações Financeiras</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Imagem</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($adimplentes as $adimplente):?>
                                <tr>
                                    <td><?=$adimplente->getId()?></td>
                                    <td><?=$adimplente->getNome()?></td>
                                    <td><?=$adimplente->getImagem()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$adimplente->getId();?>">
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