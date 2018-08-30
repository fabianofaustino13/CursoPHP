<?php
require_once(__DIR__ . "/../classes/modelo/Vendedor.class.php");
require_once(__DIR__ . "/../classes/dao/VendedorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Sexo.class.php");
require_once(__DIR__ . "/../classes/dao/SexoDAO.class.php");

include(__DIR__ . "/../administracao/logado.php");

// $home = "/cursoPHP/loja/vendedor/";
$vendedor = new Vendedor();
$sexoDao = new SexoDAO();
$vendedorDao = new VendedorDAO();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $vendedor = $vendedorDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $vendedorDao->remove($_POST['id']);
    header('location: index.php');
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $vendedor->setNome($_POST['nome']);
    $vendedor->setCpf($_POST['cpf']);
    $vendedor->setMatricula($_POST['matricula']);
    $vendedor->getSexo()->setId($_POST['sexoId']);
    if ($vendedor->getSexo()->getId() == 0) {
        $vendedor->getSexo()->setId(null);
    }
    // $produto->getDepartamento()->setId($_POST['departamentoId']);
    // if ($produto->getDepartamento()->getId() == 0) {
    //     $produto->getDepartamento()->setId(null);
    // }

    if ($_POST['id'] != '') {
        $vendedor->setId($_POST['id']);
    }
    $vendedorDao->save($vendedor);
    header('location: index.php');
}

$vendedores = $vendedorDao->findAll();
$sexos = $sexoDao->findAll();
// <?=$sexo->getId() == $vendedor->getSexo()->getId() ? "checked": "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">

</head>
<body>
    <?php
        include(__DIR__ . "/../administracao/menu.php");
        
    ?>
    <div class="container-fluid">
        <div class="row" style="padding: 2% 2% 0 2%;">
            <div class="col-4"><!-- form -->
                <fieldset>
                    <legend>Dados do Vendedor</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <input type="hidden" name="id" value="<?=$vendedor->getId();?>">
                        <div class="form-group"> <!-- input Vendedor -->
                            <label for="nome" class="required">Nome</label >
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="25" required value="<?=$vendedor->getNome();?>" placeholder="Nome completo">
                        </div>
                        <div class="form-group"> <!-- input CPF -->
                            <label for="cpf">CPF</label >
                            <input type="text" class="form-control" name="cpf" id="cpf" maxlength="11" value="<?=$vendedor->getCpf();?>" placeholder="Somente números">
                        </div>
                        <div class="form-group"> <!-- input Matrícula -->
                            <label for="matricula">Matrícula</label >
                            <input type="text" class="form-control" name="matricula" id="matricula" maxlength="10" value="<?=$vendedor->getMatricula();?>" placeholder="Somente números">
                        </div>                       
                         <label for="sexoId" class="required">Sexo</label><br><!-- input Sexo -->
                        <div class="col-12">
                            <div class="form-group">
                                <?php foreach ($sexos as $sexo): ?>
                                    <div class="custom-control custom-radio custom-control-inline">                                    
                                        <input type="radio" id="<?=$sexo->getNome();?>" name="sexoId" value="<?=$sexo->getId();?>" class="custom-control-input" <?php if ($sexo->getId() == 1):?> checked <?php endif; ?>/>
                                        <label class="custom-control-label" for="<?=$sexo->getNome();?>"><?=$sexo->getNome();?></label>
                                    </div>
                                <?php endforeach; ?>                                    
                            </div>
                        </div>  
                        <div class="form-group"> <!-- Botão -->
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-8"><!-- table -->
                <fieldset>
                    <legend>Lista de Vendedores</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>MATRÍCULA</th>
                                <th>SEXO</th>                                
                                <th colspan="2">ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vendedores as $vendedor): ?>
                                <tr>
                                    <td><?=$vendedor->getId();?></td>
                                    <td><?=$vendedor->getNome();?></td>
                                    <td><?=$vendedor->getCpf();?></td>
                                    <td><?=$vendedor->getMatricula();?></td>
                                    <td><?=$vendedor->getSexo()->getNome();?></td>
                                    <td>
                                        <form action="index.php" method="post" id="form-editar">
                                            <input type="hidden" name="id" value="<?=$vendedor->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post" id="form-remover">
                                            <input type="hidden" name="id" value="<?=$vendedor->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir" onclick="return confirmaRemover();"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
    <script src="../assets/js/produto.js"></script>
</body>
</html>