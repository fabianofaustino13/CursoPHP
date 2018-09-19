<?php
include(__DIR__ . "/../administracao/logado.php");
require_once(__DIR__ . "/../classes/modelo/FoneDependente.class.php");
require_once(__DIR__ . "/../classes/dao/FoneDependenteDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/depMorador.class.php");
require_once(__DIR__ . "/../classes/dao/depMoradorDAO.class.php");

$dep_id = $_GET['id'];
$id = new Dependente();
$id->setId($dep_id);
$foneDao = new FoneDependenteDAO();
$fone = new FoneDependente();
$fones = $foneDao->findByDependente($id);

$depMoradorDAO = new depMoradorDAO();
$responsaveis = $depMoradorDAO->findByDependente($id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Fone Dependente - Assembléia</title>
</head>
<body>
    <fieldset>
        <form method="post">
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="idMorador">Id Dependente</label>
                    <input type="text" class="form-control" name="idDependente" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?>>
                </div>
                <div class="col-md-10 mb-3">
                    <label for="fone">Telefone</label>
                    <input type="tel" class="form-control" name="newFone" id="newFone" placeholder="Digite o novo telefone">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="salvarNovoTelefone" value="salvarNovoTelefone">Salvar</button>
            </div>
        </form>
    </fieldset>
</body>
</html>