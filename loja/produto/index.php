
<?php require_once(__DIR__ . "/../classes/modelo/Marca.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MarcaDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Departamento.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/DepartamentoDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Produto.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/ProdutoDAO.class.php"); ?>
<?php 

$produto = new Produto();
$marcaDao = new MarcaDAO();
$produtoDao = new ProdutoDAO();
$departamentoDao = new DepartamentoDAO();


if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $produto->setNome($_POST['nome']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setQntMinima($_POST['qntMinima']);
    $produto->setQntEstoque($_POST['estoque']);
    $produto->setPreco($_POST['preco']);
    $produto->getMarca()->setId($_POST['marcaId']);
    $produto->getDepartamento()->setId($_POST['departamentoId']);

    if($produto->getMarca()->getId() == 0) {
        $produto->getMarca()->setId(null);
    }

    if($produto->getDepartamento()->getId() == 0) {
        $produto->getDepartamento()->setId(null);
    }
    // $produto->setMarca($marcaDao->findById($_POST['marca']));
    // $produto->SetDepartamento($departamentoDao->findById($_POST['departamento']));
    
    if ($_POST['id'] != '') {
        $produto->setId($_POST['id']);
    }
    
    $produtoDao->save($produto);
    header('location: index.php');
}
if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $produto = $produtoDao->findById($_POST['id']);
}

if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $produtoDao->remove($_POST['id']);
    header('location: index.php');
}

$produtos = $produtoDao->findAll();
$marcas = $marcaDao->findAll();
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
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><!-- form -->
                <fieldset>
                    <legend>Dados do Produto</legend>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?=$produto->getId();?>">
                        <div class="form-group"> <!-- input Produto -->
                            <label for="nome">Produto</label >
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="12" required value="<?=$produto->getNome();?>">
                        </div>
                        <div class="form-group"> <!-- input Marca -->
                            <label for="marcaId">Marca</label>
                            <select class="form-control" name="marcaId" id="marcaId">
                                <option value="0" disabled selected>Selecione uma marca...</option>
                                <?php foreach($marcas as $marca): ?>
                                    <?php 
                                        $selected = "";
                                        if ($marca->getId() == $produto->getMarca()->getId()) {
                                            $selected = "selected";
                                        }
                                    ?>
                                    <option value="<?=$marca->getId();?>" <?=$selected;?>>
                                        <?=$marca->getNome();?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"> <!-- input Marca -->
                            <label for="departamentoId">Departamento</label>
                            <select class="form-control" name="departamentoId" id="departamentoId">
                                <option value="0" disabled selected>Selecione um departamento...</option>
                                <?php foreach($departamentos as $departamento): ?>
                                    <?php 
                                        $selected = "";
                                        if ($departamento->getId() == $produto->getDepartamento()->getId()) {
                                            $selected = "selected";
                                        }
                                    ?>
                                    <option value="<?=$departamento->getId()?>" <?=$selected;?>>
                                        <?=$departamento->getNome()?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"> <!-- input Descrição -->
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" name="descricao" id="descricao" value="<?=$produto->getDescricao();?>">
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
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-6"><!-- table -->
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
                                    <td><?=$produto->getPreco();?></td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="remover" value="remover"><i class="fas fa-trash-alt"></i></button>
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
</body>
</html>