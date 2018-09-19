<?php
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/FoneMorador.class.php");
require_once(__DIR__ . "/../classes/dao/FoneMoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/EmailMorador.class.php");
require_once(__DIR__ . "/../classes/dao/EmailMoradorDAO.class.php");

include(__DIR__ . "/../administracao/logado.php");

$mor_id = $_GET['id'];
$id = new Morador();
$id->setId($mor_id);

$moradorDao = new MoradorDAO();
$morador = $moradorDao->findById($id);

$foneDao = new FoneMoradorDAO();
$fones = $foneDao->findByMorador($id);

$emailDao = new EmailMoradorDAO();
$emails = $emailDao->findByMorador($id);
?>

<html>
<head>
    <meta charset="utf-8">
    <title>CONTATOS - MORADOR</title>
    <style>
        div#div-contatos-mor {
            border: 1px solid rgb(43, 43, 43);
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="col-12 mb-3">
        <form method="post">
            <button type="submit" class="btn btn-danger float-right" title="fechar"><i class="fas fa-times"></i></button>
        </form>
        <legend>Morador selecionado: <?=$morador->getNome();?></legend>
    </div>

    <!-- Tabela - Email do Morador -->
    <div class="col-6">

        <!-- Botão de editar -->
        <button type="submit" class="btn btn-primary float-right" value="<?=$morador->getId();?>" onclick="addEmailMorador(this.value)" title="adicionar email">
            <i class="fas fa-plus-square"></i> Novo email
        </button>

        <legend>Email do Morador</legend>
        <fieldset>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($emails as $email): ?>
                        <tr>
                            <td><?=$email->getEmail()?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="emailMorador" value="<?=$email->getEmail();?>">
                                    <button type="submit" class="btn btn-danger" name="removerEmail" value="removerEmail" title="remover email">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>  
                    <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
    </div>

    <!-- Tabela - Fones do Morador -->
    <div class="col-6">

        <!-- Botão de editar -->
        <button type="submit" class="btn btn-primary float-right" value="<?=$morador->getId();?>" onclick="addTelefoneMorador(this.value)" title="adicionar telefone">
            <i class="fas fa-plus-square"></i> Novo telefone
        </button>

        <legend>Telefones do Morador</legend>
        <fieldset>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fones as $fone): ?>
                        <tr>
                            <td><?=$fone->getFone()?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="foneMorador" value="<?=$fone->getFone();?>">
                                    <button type="submit" class="btn btn-danger" name="removerTelefone" value="removerTelefone" title="remover telefone">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>  
                    <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
    </div>

    <div class="col-12" id="editInfoSelecionada"></div>

    <!-- script -->
    <script src="../assets/js/ajax_funcoes.js"></script>
</body>
</html>