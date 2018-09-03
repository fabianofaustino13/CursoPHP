<?php
require_once(__DIR__ . "/../classes/modelo/Marca.class.php");
require_once(__DIR__ . "/../classes/dao/MarcaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Produto.class.php");
require_once(__DIR__ . "/../classes/dao/ProdutoDAO.class.php");
require_once(__DIR__ . "/../classes/dao/DepartamentoDAO.class.php");

include(__DIR__ . "/../administracao/logado.php");

$home = "/cursoPHP/loja/produto/";
$produto = new Produto();
$marcaDao = new MarcaDAO();
$produtoDao = new ProdutoDAO();
$departamentoDao = new DepartamentoDAO();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $produto = $produtoDao->findById($_POST['id']);
}

if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $produtoDao->remove($_POST['id']);
    header("location: $home");
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $produto->setNome($_POST['nome']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setQntMinima($_POST['qntMinima']);
    $produto->setQntEstoque($_POST['estoque']);
    $produto->setPreco($_POST['preco']);
    $produto->getMarca()->setId($_POST['marcaId']);
    if ($produto->getMarca()->getId() == 0) {
        $produto->getMarca()->setId(null);
    }
    $produto->getDepartamento()->setId($_POST['departamentoId']);
    if ($produto->getDepartamento()->getId() == 0) {
        $produto->getDepartamento()->setId(null);
    }

    if ($_POST['id'] != '') {
        $produto->setId($_POST['id']);
    }
    $produtoDao->save($produto);
    header("location: $home");
}

$marcas = $marcaDao->findAll();
$produtos = $produtoDao->findAll();
$departamentos = $departamentoDao->findAll();

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
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    <div class="container-fluid">
        <div class="row" style="padding: 2% 2% 0 2%;">
            <div class="col-4"><!-- form -->
                <fieldset>
                    <legend>Dados do Produto</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <input type="hidden" name="id" value="<?=$produto->getId();?>">
                        <div class="form-group"> <!-- input Produto -->
                            <label for="nome">Produto</label >
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="25" required value="<?=$produto->getNome();?>">
                        </div>
                        <div class="form-group"> <!-- input Marca -->
                            <label for="marcaId">Marca</label>
                            <select class="form-control" name="marcaId" id="marcaId">
                                <option value="0" disabled selected>Selecione uma marca...</option>
                                <?php foreach($marcas as $marca): ?>
                                    <option value="<?=$marca->getId();?>" <?=$marca->getId() == $produto->getMarca()->getId() ? "selected": "";?>><?=$marca->getNome();?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"> <!-- input Marca -->
                            <label for="departamentoId">Departamento</label>
                            <select class="form-control" name="departamentoId" id="departamentoId">
                                <option value="0" selected>Selecione um departamento...</option>
                                <?php foreach($departamentos as $departamento): ?>
                                    <option value="<?=$departamento->getId();?>" <?=$departamento->getId() == $produto->getDepartamento()->getId() ? "selected": "";?>><?=$departamento->getNome();?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"> <!-- input Descrição -->
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" name="descricao" id="descricao" maxlength="200" value="<?=$produto->getDescricao();?>">
                        </div>
                        <div class="form-group"> <!-- input Quantidade Mínima -->
                            <label for="qntMinima">Quantidade Mínima</label>
                            <input type="text" class="form-control" name="qntMinima" id="qntMinima" value="<?=$produto->getQntMinima();?>">
                        </div>
                        <div class="form-group"> <!-- input Estoque -->
                            <label for="estoque">Estoque</label>
                            <input type="text" class="form-control" name="estoque" id="estoque" value="<?=$produto->getQntEstoque();?>">
                        </div>
                        <div class="form-group"> <!-- input Preço -->
                            <label for="preco">Preço</label>
                            <input type="text" class="form-control" name="preco" id="preco" required value="<?=$produto->getPreco();?>">
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
                    <legend>Lista de Produtos</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Marca</th>
                                <th>Departamento</th>
                                <th>Descrição</th>
                                <th>Quantidade Mínima</th>
                                <th>Estoque</th>
                                <th>Preço</th>
                                <th colspan="2">ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos as $produto): ?>
                                <tr>
                                    <td><?=$produto->getId();?></td>
                                    <td><?=$produto->getNome();?></td>
                                    <td><?=$produto->getMarca()->getNome();?></td>
                                    <td><?=$produto->getDepartamento()->getNome();?></td>
                                    <td><?=$produto->getDescricao();?></td>
                                    <td><?=$produto->getQntMinima();?></td>
                                    <td><?=$produto->getQntEstoque();?></td>
                                    <td><?=$produto->getPrecoFormatado();?></td>
                                    <td>
                                        <form action="index.php" method="post" id="form-editar">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post" id="form-remover">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="remover" value="remover" onclick="return confirmaRemover();"><i class="fas fa-trash-alt"></i></button>
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