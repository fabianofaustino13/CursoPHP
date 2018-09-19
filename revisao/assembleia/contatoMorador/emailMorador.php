<?php
require_once(__DIR__ . "/../classes/modelo/EmailMorador.class.php");
require_once(__DIR__ . "/../classes/dao/EmailMoradorDAO.class.php");
include(__DIR__ . "/../administracao/logado.php");

$mor_id = $_GET['id'];
$id = new Morador();
$id->setId($mor_id);
$email = new EmailMorador();
$emailDao = new EmailMoradorDAO();

$emails = $emailDao->findByMorador($id);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Email Morador - Assembléia</title>
</head>
<body>
    <fieldset>
        <form method="post">
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="idMorador">Id Morador</label>
                    <input type="text" class="form-control" name="idMorador" id="idMorador" <?php foreach($emails as $email): ?>value="<?=$email->getMorador()->getId()?>"<?php endforeach ?> placeholder="Digite o id morador">
                </div>
                <div class="col-md-10 mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="newEmail" id="newEmail" placeholder="Digite o novo email">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="salvarNovoEmail" value="salvarNovoEmail">Salvar</button>
            </div>
        </form>
    </fieldset>
</body>
</html>