<?php
require_once(__DIR__ . "/../classes/modelo/depMorador.class.php");
require_once(__DIR__ . "/../classes/dao/depMoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/FoneDependente.class.php");
require_once(__DIR__ . "/../classes/dao/FoneDependenteDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/EmailDependente.class.php");
require_once(__DIR__ . "/../classes/dao/EmailDependenteDAO.class.php");

include(__DIR__ . "/../administracao/logado.php");

$dep_id = $_GET['id'];
$id = new Dependente();
$id->setId($dep_id);

$depMoradorDAO = new depMoradorDAO();
$responsaveis = $depMoradorDAO->findByDependente($id);
$dependente = $depMoradorDAO->findById($id);

// Fone
$foneDao = new FoneDependenteDAO();
$fones = $foneDao->findByDependente($id);

// Email
$emailDao = new EmailDependenteDAO();
$emails = $emailDao->findByDependente($id);
?>

<html>
<head>
    <meta charset="utf-8">
    <title>CONTATOS - DEPENDENTE</title>
    <style>
        div#div-contatos-dep {
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
        <legend>Dependente selecionado: <?=$dependente->getDependente()->getNome();?></legend>
    </div>
    
    <div class="col-4">
        <button type="submit" class="btn btn-primary float-right" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?> onclick="addResponsavelDependente(this.value)" title="Adicionar novo responsável">
            <i class="fas fa-plus-square"></i> Novo Responsável
        </button>

        <legend>Responsáveis</legend>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responsaveis as $responsavel): ?>
                    <tr>
                        <td><?=$responsavel->getMorador()->getNome();?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="idResponsavel" value="<?=$responsavel->getMorador()->getId();?>">
                                <input type="hidden" name="idDependente" value="<?=$responsavel->getDependente()->getId();?>">
                                <button type="submit" class="btn btn-danger" name="removerResponsavel" value="removerResponsavel" onclick="return confirmRemoveResponsavel();" title="remover responsável">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Tabela - Email do Dependente -->
    <div class="col-4">
        <button type="submit" class="btn btn-primary float-right" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?> onclick="addEmailDependente(this.value)" title="Adicionar novo email">
            <i class="fas fa-plus-square"></i> Novo Email
        </button>

        <legend>Emails</legend>
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
                                    <input type="hidden" name="emailResponsavel" value="<?=$email->getEmail();?>">
                                    <button type="submit" class="btn btn-danger" name="removerEmail" value="removerEmail" onclick="return confirmRemoveEmail();" title="remover email">
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

    <!-- Tabela - Fones do Dependente -->
    <div class="col-4">

        <!-- Botão de editar -->
        <button type="submit" class="btn btn-primary float-right" <?php foreach ($responsaveis as $responsavel): ?>value="<?=$responsavel->getDependente()->getId();?>"<?php endforeach; ?> onclick="addTelefoneDependente(this.value)" title="editar ou adicionar telefone do dependente">
            <i class="fas fa-plus-square"></i> Novo telefone
        </button>

        <legend>Telefones</legend>
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
                                    <input type="hidden" name="foneResponsavel" value="<?=$fone->getFone();?>">
                                    <button type="submit" class="btn btn-danger" name="removerFone" value="removerFone" onclick="return confirmRemoveTelefone();" title="remover telefone">
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
    <script src="../assets/js/remove.js"></script>
</body>
</html>