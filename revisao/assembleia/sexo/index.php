<?php require_once(__DIR__ . "/../classes/modelo/Sexo.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/SexoDAO.class.php"); ?>
<?php 
$dao = new SexoDAO();
$sexo = new Sexo();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $sexo->setNome($_POST['sexo']);
    $sexo->setSigla($_POST['sigla']);
    if ($_POST['id'] != '') {
        $sexo->setId($_POST['id']);
    }
    $dao->save($sexo);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $sexo = $dao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$sexos = $dao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sexos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"> -->

</head>
<body>
    
    <div class="conteiner">
        <div class="row" style="margin-top: 5%;">
            <div class="col-6"> <!-- Form -->
                <fieldset>
                    <legend>Dados do Sexo</legend>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" maxlength="12" required value="<?=$sexo->getNome();?>">
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text" class="form-control" name="sigla" id="sigla" maxlength="4" required value="<?=$sexo->getSigla();?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-6"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista de Sexos</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Sexo</th>
                            <th>Sigla</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($sexos as $sexo): ?>
                                <tr>
                                    <td><?=$sexo->getId()?></td>
                                    <td><?=$sexo->getNome()?></td>
                                    <td><?=$sexo->getSigla()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
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
            <!-- Sexo -->
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="sexo2" class="required">Sexos</label>
                    <form method="post" action="index.php">
                        <select class="form-control" name="sexo2">
                            <?php
                                $sexos = $dao->findAll();
                                foreach ($sexos as $sexo): ?>
                                    <option value="<?=$sexo->getId();?>"> <?=$sexo->getNome();?></option> 
                                <?php endforeach; ?>
                        </select> 
                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                            <button type="submit" class="btn btn-success" name="editar" value="editar">
                                <i class="far fa-edit"></i>
                            </button>
                        
                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                            <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                                <i class="far fa-trash-alt"></i>
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>