<?php
require_once(__DIR__ . "/../classes/modelo/depMorador.class.php");
require_once(__DIR__ . "/../classes/dao/depMoradorDAO.class.php");

$dep_id = $_GET['id'];
$id = new Dependente();
$id->setId($dep_id);
$depMoradorDAO = new depMoradorDAO();
$responsaveis = $depMoradorDAO->findByDependente($id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>
    <fieldset>
        <form method="post">
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="idMorador">ID Morador</label>
                    <input type="number" class="form-control" name="idMorador" id="idMorador">
                </div>
                <div class="col-md-10 mb-3">
                    <label for="idDependente">ID Dependente</label>
                    <input type="number" class="form-control" name="idDependente" id="idDependente" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?>>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="salvarNovoDependente" value="salvarNovoDependente">Salvar</button>
            </div>
        </form>
    </fieldset>
</body>
</html>