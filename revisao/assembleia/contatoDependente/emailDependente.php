<?php
include(__DIR__ . "/../administracao/logado.php");
require_once(__DIR__ . "/../classes/modelo/EmailDependente.class.php");
require_once(__DIR__ . "/../classes/dao/EmailDependenteDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/depMorador.class.php");
require_once(__DIR__ . "/../classes/dao/depMoradorDAO.class.php");

$dep_id = $_GET['id'];
$id = new Dependente();
$id->setId($dep_id);
$emailDao = new EmailDependenteDAO();
$email = new EmailDependente();
$emails = $emailDao->findByDependente($id);

$depMoradorDAO = new depMoradorDAO();
$responsaveis = $depMoradorDAO->findByDependente($id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Email Dependente - Assembléia</title>
</head>
<body>
    <fieldset>
        <form method="post">
            <div class="form-row">
                <div class="col-2 mb-2">
                    <label for="newEmail">ID Dependente</label>
                    <input type="number" class="form-control" name="idDependente" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?>>
                </div>
                <div class="col-md-10 mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="newEmail" id="newEmail" placeholder="Digite o novo email">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="salvarNovoEmail" value="salvarNovoEmail"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </form>
    </fieldset>
</body>
</html>