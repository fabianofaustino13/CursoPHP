<?php require_once(__DIR__ . "/../classes/modelo/Cep.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/CepDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Bairro.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/BairroDAO.class.php"); ?>
<?php 
include(__DIR__ . "/../administracao/logado.php");

$cep = new Cep();
$cepDao = new CepDAO();
$bairro = new Bairro();
$bairroDao = new BairroDAO();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $cep->setId($_POST['id']);
    $cep->setLogradouro($_POST['logradouro']);
    $cep->getBairro()->setId($_POST['bairroId']);
    // if ($_POST['id'] != '') {
    // }
    $cepDao->save($cep);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $cep = $cepDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $cepDao->remove($_POST['id']);
    header('location: index.php');
}
$ceps = $cepDao->findAll();
$bairros = $bairroDao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>CEP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <!-- Include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?> 
    
    <div class="container">
        <div class="row" style="margin: 5%;">
            <div class="col-md-6 mb-3"> <!-- Form -->
                <fieldset>
                    <legend>Dados do CEP</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <div class="form-group"> <!-- input Número do cep -->
                            <!-- <input type="hidden" name="id" value="<//?=$cep->getId();?>"> -->
                            <label for="id" class="required">CEP</label>
                            <input type="text" class="form-control" name="id" id="id" maxlength="8" required value="<?=$cep->getId();?>">
                        </div>
                        <div class="form-group"> <!-- input Logradouro -->
                            <label for="logradouro" class="required">Logradouro</label>
                            <input type="text" class="form-control" name="logradouro" id="logradouro" maxlength="100" required value="<?=$cep->getLogradouro();?>">
                        </div>
                        <div class="form-group"> <!-- input Bairro -->
                            <label for="bairroId">Bairro</label>
                            <select class="form-control" name="bairroId" id="bairroId">
                                <option value="0" disabled selected>Selecione um bairro...</option>
                                <?php foreach($bairros as $bairro): ?>
                                    <option value="<?=$bairro->getId();?>" <?=$bairro->getId() == $cep->getBairro()->getId() ? "selected": "";?>><?=$bairro->getNome();?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                     
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-6 mb-3 "> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Ceps</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>CEP</th>
                            <th>Logradouro</th>
                            <th>Bairro</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($ceps as $cep): ?>
                                <tr>
                                    <td><?=$cep->getId()?></td>
                                    <td><?=$cep->getLogradouro()?></td>
                                    <td><?=$cep->getBairro()->getNome()?></td>
                                    <td>
                                        <form action="index.php" method="post" >
                                            <input type="hidden" name="id" value="<?=$cep->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$cep->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div> <!-- Fim Tabela -->
        </div>
    </div>
    <script src="../assets/js/produto.js"></script>
</body>
</html>