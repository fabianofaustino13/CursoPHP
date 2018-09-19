<?php
require_once(__DIR__ . "/../classes/modelo/FoneMorador.class.php");
require_once(__DIR__ . "/../classes/dao/FoneMoradorDAO.class.php");
include(__DIR__ . "/../administracao/logado.php");

$mor_id = $_GET['id'];
$id = new Morador();
$id->setId($mor_id);
$fone = new FoneMorador();
$foneDao = new FoneMoradorDAO();

$fones = $foneDao->findByMorador($id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Fone Morador - Assembléia</title>
</head>
<body>
    <fieldset>
        <form method="post">
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="idMorador">Id Morador</label>
                    <input type="text" class="form-control" name="idMorador" id="idMorador" <?php foreach($fones as $fone): ?>value="<?=$fone->getMorador()->getId()?>"<?php endforeach; ?> placeholder="Digite o id morador">
                </div>
                <div class="col-md-10 mb-3">
                    <label for="fone">Telefone</label>
                    <input type="tel" class="form-control" name="newFone" id="newFone" placeholder="Digite o novo telefone" maxlength="11">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="salvarNovoTelefone" value="salvarNovoTelefone">Salvar</button>
            </div>
        </form>
    </fieldset>
</body>
</html>